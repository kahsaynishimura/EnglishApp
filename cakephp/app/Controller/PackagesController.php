<?php

App::uses('AppController', 'Controller');

/**
 * Packages Controller
 *
 * @property Package $Package
 * @property PaginatorComponent $Paginator
 */
class PackagesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('index_api');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Package->recursive = 0;
        $this->set('packages', $this->Paginator->paginate());
    }

    public function index_api() {
        $this->Package->Behaviors->load("Containable");


        $options = array(
            'fields' => array('id', 'name', 'is_free', 'is_scratch', 'link_blog_description', 'description', 'locale'),
            'contain' => array(
                'UsersPackage' => array(
                    //return if the user bought this lesson
                    'conditions' => array('UsersPackage.user_id' => $this->request->data['User']['id']),
                    'fields' => array('UsersPackage.user_id'),
                )
            ),
            'order' => array('name')
        );

        $packages = $this->Package->find('all', $options);
        $this->set(array(
            'packages' => $packages,
            '_serialize' => 'packages'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Package->exists($id)) {
            throw new NotFoundException(__('Invalid package'));
        }
        $options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
        $this->set('package', $this->Package->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Package->create();
            if ($this->Package->save($this->request->data)) {
                $this->Flash->success(__('The package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The package could not be saved. Please, try again.'));
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
        if (!$this->Package->exists($id)) {
            throw new NotFoundException(__('Invalid package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Package->save($this->request->data)) {
                $this->Flash->success(__('The package has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The package could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
            $this->request->data = $this->Package->find('first', $options);
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
        $this->Package->id = $id;
        if (!$this->Package->exists()) {
            throw new NotFoundException(__('Invalid package'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Package->delete()) {
            $this->Flash->success(__('The package has been deleted.'));
        } else {
            $this->Flash->error(__('The package could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
