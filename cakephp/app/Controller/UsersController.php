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
        $this->Auth->allow('resetPassword', 'recover_account', 'add', 'login', 'save_last_lesson_api', 'add_api', 'add_fb_api', 'login_api', 'confirmation');
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

                $this->Flash->success(__('Sua conta está ativa.'));
                $this->redirect("https://www.echopractice.com/thank-you-for-signing-in/");
            } else {
                $this->Flash->error('Não foi possível confirmar seu cadastro.');
            }
        }
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    public function recover_account() {
        $this->autoRender = false;
        if ($this->request->is(array('post'))) {
            $options = array('fields' => array('id', 'username'), 'conditions' => array('username' => $this->request->data['User']['username']));
            $user = $this->User->find('first', $options);

            $Email = new CakeEmail('smtp');
            $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
                    ->to($this->request->data['User']['username'])
                    ->subject(__('Echo Practice - Password Recovery'))
                    ->template('password_request', 'default')
                    ->emailFormat('html')
                    ->viewVars(array(
                        'activate_account' => __('Create New Password'),
                        'oneMoreStep' => __('Recover your Echo Practice Account'),
                        'userId' => $user['User']['id'],
                        'instructions' => __('If you didn\'t request a new password, please, ignore this email.'),
                    ))
                    ->send();
        }
    }

    public function resetPassword() {
        if ($this->request->is(array('post', 'put')) && $this->request->query('userId')) {
            $options = array('fields' => array('id', 'username'), 'conditions' => array('id' => $this->request->query('userId')));
            $user = $this->User->find('first', $options);
            $this->log('User Id - resetPassword: ' . $user['User']['id'] . ' llll');
            $this->User->id = $this->request->query('userId');
            $this->log($this->request->data);
            if ($this->User->saveField('password', $this->request->data['User']['password'])) {
                $message = __('The user has been saved. Redirecting to echopractice.com');

                //Email
                $Email = new CakeEmail('smtp');
                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
                        ->to($user['User']['username'])
                        ->subject(__('Echo Practice - New Password Created'))
                        ->template('password_changed', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'oneMoreStep' => __('It is sorted.'),
                            'userName' => $this->request->data['first_name'],
                            'instructions' => __('Password successfully changed.')
                                )
                        )
                        ->send();
            } else {
                $message = __('The user could not be saved. Please, try again.');
            }
            $this->flash($message, 'https://echopractice.com');
        }
    }

    /*     * ********************************Rest API********************************** */

    public function login_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->Auth->login();
            $user = $this->Auth->user();
            $user['User']['password'] = '';
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

                $this->request->data['User']['id'] = $this->User->getLastInsertID();
                $this->set(array(
                    'user' => $this->request->data['User'],
                    '_serialize' => array('user')
                ));

                //Email
//                $Email = new CakeEmail('smtp');
//
//                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
//                        ->to($this->request->data['User']['username'] . '')
//                        ->subject(__('Echo Practice - Account confirmation. Start improving your pronunciation'))
//                        ->template('confirmation', 'default')
//                        ->emailFormat('html')
//                        ->viewVars(array(
//                            'activate_account' => __('Activate Account'),
//                            'oneMoreStep' => __('Only one more step to start having fun.'),
//                            'userName' => $this->request->data['User']['name'],
//                            'instructions' => __('Please, click the button bellow to activate your access and start using Echo Practice for free'),
//                            'email' => $this->request->data['User']['username']))
//                        ->send();
            } else {
                $user = $this->User->find('first', array(
                    'fields' => array('id', 'username', 'name', 'is_confirmed', 'last_completed_lesson', 'total_points'),
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

    //must return the user's available score
    public function save_last_lesson_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->id = $this->request->data['User']['id'];
            if ($this->User->saveField('last_completed_lesson', $this->request->data['User']['last_completed_lesson'])) {
                $general_response = array('status' => 'success', 'data' => $this->User->field("total_points"), 'message' => __('Your progress was updated'));
                $this->set(array(
                    'general_response' => $general_response,
                    '_serialize' => array('general_response')
                ));
            }
        }
    }

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->create();

            $this->request->data['User']['last_completed_lesson'] = 0;
            $this->request->data['User']['total_points'] = 0;
            $this->request->data['User']['role'] = 'student'; //only students are allowed to be added via app
            $this->request->data['User']['is_confirmed'] = false;
            if ($this->User->save($this->request->data)) {
                $general_response = array('status' => 'success', 'data' => $this->User->getLastInsertID(), 'message' => __('Conta criada com sucesso. Aproveite sua prática.'));

                $Email = new CakeEmail('smtp');
                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
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
            } else {
                $general_response = array('status' => 'error', 'data' => '', 'message' => __('Não foi possível salvar sua conta.'));
            }

            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
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
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->Paginator->settings = array(
            'order' => array('User.id' => 'desc')
        );
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array(
            'conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    public function admin_email_ptbr() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all', array(
                    'conditions' => array('user_locale' => 'pt_BR')
        )));
    }

    public function admin_email() {
        $this->User->recursive = 0;
        $this->set('users', $this->User->find('all',
                array('conditions' => array('is_confirmed' => '1'))
                ));
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
        $options = array(
            'fields' => array('name', 'created'),
            'conditions' => array('User.' . $this->User->primaryKey => $id));
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
                $Email->from(array('karina@echopractice.com' => 'Echo Practice'))
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
    public function admin_edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(array('action' => 'admin_index'));
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
    public function admin_delete($id = null) {
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
        return $this->redirect(array('action' => 'admin_index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'logout', 'resetPassword'))) {
            return true;
        }
        return parent::isAuthorized($user);
    }

}
