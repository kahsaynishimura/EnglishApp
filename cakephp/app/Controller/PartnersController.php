<?php

App::uses('AppController', 'Controller');

/**
 * Partners Controller
 *
 * @property Partner $Partner
 * @property PaginatorComponent $Paginator
 */
class PartnersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Partner->recursive = 0;
        $this->set('partners', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Partner->exists($id)) {
            throw new NotFoundException(__('Invalid partner'));
        }
        $options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
        $this->set('partner', $this->Partner->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Partner->create();
            $this->request->data['Partner']['user_id'] = $this->Auth->user('id');
            if ($this->Partner->save($this->request->data)) {
                $this->Flash->success(__('The partner has been saved.'));
                return $this->redirect(array('controller' => 'products', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The partner could not be saved. Please, try again.'));
            }
        }
        $users = $this->Partner->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Partner->exists($id)) {
            throw new NotFoundException(__('Invalid partner'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Partner->save($this->request->data)) {
                $this->Flash->success(__('The partner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The partner could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
            $this->request->data = $this->Partner->find('first', $options);
        }
        $users = $this->Partner->User->find('list');
        $this->set(compact('users'));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit'))) {
            $partnerId = (int) $this->request->params['pass'][0];
            if ($this->Partner->isOwnedBy($partnerId, $user['id'])) {
                return true;
            } 
        }

        return parent::isAuthorized($user);
    }

}
