<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'login', 'save_last_lesson_api', 'add_api', 'add_fb_api', 'login_api', 'confirmation');
    }

    public function confirmation() {
        $this->autoLayout = false;
        $this->autoRender = false;
        if ($this->request->query('email')) {
            $user = $this->User->find('first', array(
                'fields' => array('id', 'name', 'username'),
                'conditions' => array('User.username' => $this->request->query('email'))));
            if (!empty($user)) {
                $this->User->id = $user['User']['id'];
                $this->User->saveField('is_confirmed', true);

                $this->Flash->success(__('Your account is active'));
                $this->redirect("https://echopractice.com/ep/thank-you");
            } else {
                $this->Flash->error('Não foi possível confirmar seu cadastro.');
            }
        }
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    /*     * ********************************Rest API********************************** */

    public function login_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->Auth->login();
            $user = $this->Auth->user();
            $this->set(array(
                'user' => $user,
                '_serialize' => array('user')
            ));
        }
    }

    public function index_api() {
        $this->User->recursive = 0;
        if ($this->request->is('xml')) {
            $this->set(array(
                'users' => $users = $this->User->find('all'),
                '_serialize' => array('users')));
        }
    }

    public function view_api($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('xml')) {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $user = $this->User->find('first', $options);
            $this->set(array(
                'user' => $user,
                '_serialize' => array('user')
            ));
        }
    }

    public function add_fb_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->create();

            $this->request->data['User']['last_completed_lesson'] = $this->request->data['User']['total_points'] = 0;
            $this->request->data['User']['role'] = 'student'; //only students are allowed to be added via app
            $this->request->data['User']['password'] = '00000000000000000000';
            $this->request->data['User']['is_confirmed'] = true;
            if ($this->User->save($this->request->data)) {
                //Email
                $Email = new CakeEmail('smtp');
                $Email->from(array('robot@echopractice.com' => 'Echo Practice'))
                        ->to($this->request->data['User']['username'] . '')
                        ->subject(__('Echo Practice - Account confirmation. Start improving your pronunciation'))
                        ->template('confirmation', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'activate_account' => __('Activate Account'),
                            'oneMoreStep' => __('Only one more step to start having fun.'),
                            'userName' => $this->request->data['User']['name'],
                            'instructions' => __('Please, click the button bellow to activate your access and start using Echo Practice for free'),
                            'email' => $this->request->data['User']['username']))
                        ->send();
                $this->request->data['User']['id'] = $this->User->getLastInsertID();
                $this->set(array(
                    'user' => $this->request->data['User'],
                    '_serialize' => array('user')
                ));
            } else {
                $user = $this->User->find('first', array(
                    'fields' => array('id', 'username', 'name', 'is_confirmed', 'last_completed_lesson'),
                    'conditions' => array('username' => $this->request->data['User']['username'])
                ));
                if (!empty($user['User'])) {
                    $this->set(array(
                        'user' => $user['User'],
                        '_serialize' => array('user')
                    ));
                }
            }
        }
    }

    public function save_last_lesson_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->id = $this->request->data['User']['id'];
            if ($this->User->saveField('last_completed_lesson', $this->request->data['User']['last_completed_lesson'])) {
                $this->set(array(
                    'message' => __('Your progress was updated'),
                    '_serialize' => array('message')
                ));
            }
        }
    }

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->create();

            $this->request->data['User']['last_completed_lesson'] = $this->request->data['User']['total_points'] = 0;
            $this->request->data['User']['role'] = 'student'; //only students are allowed to be added via app

            if ($this->User->save($this->request->data)) {
                //Email
                //Email
                $Email = new CakeEmail('smtp');
                $Email->from(array('robot@echopractice.com' => 'Echo Practice'))
                        ->to($this->request->data['User']['username'] . '')
                        ->subject(__('Echo Practice - Account confirmation. Start improving your pronunciation'))
                        ->template('confirmation', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'activate_account' => __('Activate Account'),
                            'oneMoreStep' => __('Only one more step to start having fun.'),
                            'userName' => $this->request->data['User']['name'],
                            'instructions' => __('Please, click the button bellow to activate your access and start using Echo Practice for free'),
                            'email' => $this->request->data['User']['username']))
                        ->send();
                $message = __('Access the link we sent to your email in order to activate your account.');
            } else {
                $message = __('The user could not be saved. Please, try again.');
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    public function edit_api($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $message = __('The user has been saved.');
            } else {
                $message = __('The user could not be saved. Please, try again.');
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    public function delete_api($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $message = __('The user has been deleted.');
        } else {
            $message = __('The user could not be deleted. Please, try again.');
        }
        $this->set(array(
            'message' => $message,
            '_serialize' => array('message')
        ));
    }

    /*     * ********************************Website********************************** */

    public function login() {
        if ($this->Auth->user() != null) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Check: credentials and confirmation email'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['last_completed_lesson'] = 0;
            if ($this->User->save($this->request->data)) {

                //Email
                $Email = new CakeEmail('smtp');
                $Email->from(array('robot@echopractice.com' => 'Echo Practice'))
                        ->to($this->request->data['User']['username'] . '')
                        ->subject(__('Echo Practice - Account confirmation. Start improving your pronunciation'))
                        ->template('confirmation', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'activate_account' => __('Activate Account'),
                            'oneMoreStep' => __('Only one more step to start having fun.'),
                            'userName' => $this->request->data['User']['name'],
                            'instructions' => __('Please, click the button bellow to activate your access and start using Echo Practice for free'),
                            'email' => $this->request->data['User']['username']))
                        ->send();
                $this->Flash->success(__('Access the link we sent to your email in order to activate your account.'));

                $this->redirect(array('action' => 'login'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->User->delete()) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('add', 'logout'))) {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            if ((int) $this->request->params['pass'][0] == (int) $user['id']) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}
