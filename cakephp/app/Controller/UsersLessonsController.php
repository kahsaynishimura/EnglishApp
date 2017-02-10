<?php

App::uses('AppController', 'Controller');

/**
 * UsersLessons Controller
 *
 * @property UsersLesson $UsersLesson
 * @property PaginatorComponent $Paginator
 */
class UsersLessonsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add_api');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->UsersLesson->recursive = 0;
        $this->set('usersLessons', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->UsersLesson->exists($id)) {
            throw new NotFoundException(__('Invalid users lesson'));
        }
        $options = array('conditions' => array('UsersLesson.' . $this->UsersLesson->primaryKey => $id));
        $this->set('usersLesson', $this->UsersLesson->find('first', $options));
    }

    /*     * ********************************Rest API********************************** */

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->UsersLesson->create();

            if ($this->UsersLesson->save($this->request->data)) {
                $general_response = array(
                    'status' => 'success',
                    'data' => $this->UsersLesson->getLastInsertID(),
                    'message' => __('The completed lesson has been saved.')
                );
            } else {
                $general_response = array(
                    'status' => 'error',
                    'data' => '0',
                    'message' => __('The completed Lesson could not be saved. Please, try again.')
                );
            }
            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->UsersLesson->create();
            if ($this->UsersLesson->save($this->request->data)) {
                $this->Flash->success(__('The users lesson has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The users lesson could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersLesson->User->find('list');
        $lessons = $this->UsersLesson->Lesson->find('list');
        $this->set(compact('users', 'lessons'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->UsersLesson->exists($id)) {
            throw new NotFoundException(__('Invalid users lesson'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->UsersLesson->save($this->request->data)) {
                $this->Flash->success(__('The users lesson has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The users lesson could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('UsersLesson.' . $this->UsersLesson->primaryKey => $id));
            $this->request->data = $this->UsersLesson->find('first', $options);
        }
        $users = $this->UsersLesson->User->find('list');
        $lessons = $this->UsersLesson->Lesson->find('list');
        $this->set(compact('users', 'lessons'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->UsersLesson->id = $id;
        if (!$this->UsersLesson->exists()) {
            throw new NotFoundException(__('Invalid users lesson'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->UsersLesson->delete()) {
            $this->Flash->success(__('The users lesson has been deleted.'));
        } else {
            $this->Flash->error(__('The users lesson could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('index'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
