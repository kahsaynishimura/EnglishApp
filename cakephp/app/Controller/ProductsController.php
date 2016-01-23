<?php

App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function index_api() {
        $this->Product->recursive = 0;
        if ($this->request->is('xml')) {
            $this->set(array(
                'products' => $this->Product->find('all'),
                '_serialize' => array('products')));
        }
    }

    public function view_api($id = null) {
        $this->Product->recursive = 0;
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is('xml')) {
            $options = array(
                'fields' => array('id', 'name', 'description', 'quantity_available', 'points_value'),
                'conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $product = $this->Product->find('first', $options);
            $this->set(array(
                'product' => $product,
                '_serialize' => array('product')
            ));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Product->recursive = 0;
        $this->set('products', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
        $this->set('product', $this->Product->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Product->create();
            $this->request->data['Product']['partner_id'] = $this->Auth->user('id');
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        }
        $partners = $this->Product->Partner->find('list');
        $this->set(compact('partners'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Product->exists($id)) {
            throw new NotFoundException(__('Invalid product'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Product->save($this->request->data)) {
                $this->Flash->success(__('The product has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The product could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
            $this->request->data = $this->Product->find('first', $options);
        }
        $partners = $this->Product->Partner->find('list');
        $this->set(compact('partners'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {//checar se tem trades
        $this->Product->id = $id;
        if (!$this->Product->exists()) {
            throw new NotFoundException(__('Invalid product'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Product->delete()) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('add', 'edit', 'delete'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
