<?php

App::uses('AppController', 'Controller');

/**
 * VideoCategories Controller
 *
 * @property VideoCategory $VideoCategory
 * @property PaginatorComponent $Paginator
 */
class VideoCategoriesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function index_api() {
        $this->VideoCategory->recursive = 0;
        $this->set(array(
            'videoCategories' => $this->Paginator->paginate(),
            '_serialize' => 'videoCategories'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->VideoCategory->recursive = 0;
        $this->set('videoCategories', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VideoCategory->exists($id)) {
            throw new NotFoundException(__('Invalid video category'));
        }
        $options = array('conditions' => array('VideoCategory.' . $this->VideoCategory->primaryKey => $id));
        $this->set('videoCategory', $this->VideoCategory->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->VideoCategory->create();
            if ($this->VideoCategory->save($this->request->data)) {
                $this->Flash->success(__('The video category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video category could not be saved. Please, try again.'));
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
        if (!$this->VideoCategory->exists($id)) {
            throw new NotFoundException(__('Invalid video category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->VideoCategory->save($this->request->data)) {
                $this->Flash->success(__('The video category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('VideoCategory.' . $this->VideoCategory->primaryKey => $id));
            $this->request->data = $this->VideoCategory->find('first', $options);
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
        $this->VideoCategory->id = $id;
        if (!$this->VideoCategory->exists()) {
            throw new NotFoundException(__('Invalid video category'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoCategory->delete()) {
            $this->Flash->success(__('The video category has been deleted.'));
        } else {
            $this->Flash->error(__('The video category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
