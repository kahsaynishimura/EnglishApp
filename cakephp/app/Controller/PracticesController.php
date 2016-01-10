<?php

App::uses('AppController', 'Controller');

/**
 * Practices Controller
 *
 * @property Practice $Practice
 * @property PaginatorComponent $Paginator
 */
class PracticesController extends AppController {

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

    /*     * ********************************Rest API********************************** */

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->Practice->create();

            if ($this->Practice->save($this->request->data)) {
                $this->Practice->User->id = $this->request->data['Practice']['user_id'];
                $this->Practice->User->saveField('total_points', $this->request->data['Practice']['points'] + $this->Practice->User->field('total_points'));
                $message = __('The practice has been saved.');
            } else {
                $message = __('The practice could not be saved. Please, try again.');
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Practice->recursive = 0;
        $this->set('practices', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Practice->exists($id)) {
            throw new NotFoundException(__('Invalid practice'));
        }
        $options = array('conditions' => array('Practice.' . $this->Practice->primaryKey => $id));
        $this->set('practice', $this->Practice->find('first', $options));
    }

}
