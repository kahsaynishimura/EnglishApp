<?php

App::uses('AppController', 'Controller');

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
        $this->Auth->allow('add', 'login', 'add_api', 'login_api');
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

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->User->create();

            $this->request->data['User']['last_completed_lesson'] = $this->request->data['User']['total_points'] = 0;
            $this->request->data['User']['role'] = 'student'; //only students are allowed to be added via app

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
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
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
                $this->Flash->success(__('Your account has been created.'));
                if ($this->request->data['User']['role'] == "partner") {
                    return $this->redirect(array('controller'=>'partners','action' => 'add'));
                } else {
                     return $this->redirect(array('controller'=>'books','action' => 'index'));//TODO:baixe o app
                }
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

}
