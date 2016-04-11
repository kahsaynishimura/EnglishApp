<?php

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * BitcoinRequests Controller
 *
 * @property BitcoinRequest $BitcoinRequest
 * @property PaginatorComponent $Paginator
 */
class BitcoinRequestsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add_api');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->BitcoinRequest->recursive = 0;
        $this->set('bitcoinRequests', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->BitcoinRequest->exists($id)) {
            throw new NotFoundException(__('Invalid bitcoin request'));
        }
        $options = array('conditions' => array('BitcoinRequest.' . $this->BitcoinRequest->primaryKey => $id));
        $this->set('bitcoinRequest', $this->BitcoinRequest->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_api() { 
        if ($this->request->is(array('post', 'xml'))) {
       
            $general_response = array();
            $this->BitcoinRequest->create();
            if ($this->BitcoinRequest->save($this->request->data)) {
                $Email = new CakeEmail();

                $Email->from(array('robot@echopractice.com' => 'Echo Practice'))
                        ->to('thiago@echopractice.com')
                        ->subject(__('Echo Practice - BitCoin request'))
                        ->template('bitcoin_request', 'default')
                        ->emailFormat('html')
                        ->viewVars(array(
                            'manage_bitcoin_requests' => __('Manage Bitcoin Requests'),
                            'pay_customers' => __('Pay your customers.'),
                            'instructions' => __('There is a new request from ' . $this->request->data['User']['username'] . ', click the button bellow to activate your access and start using Echo Practice for free'),
                            ))
                        ->send();
                $general_response = array('status' => 'success', 'data' => $this->BitcoinRequest->field("id"), 'message' => __('Your request was saved.'));
            } else {
                $general_response = array('status' => 'error', 'data' => $this->BitcoinRequest->field("id"), 'message' => __('The bitcoin request could not be saved. Please, try again.'));
            }
            $this->set(array(
                'general_response' => $general_response,
                '_serialize' => array('general_response')
            ));
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
        if (!$this->BitcoinRequest->exists($id)) {
            throw new NotFoundException(__('Invalid bitcoin request'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->BitcoinRequest->save($this->request->data)) {
                $this->Flash->success(__('The bitcoin request has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The bitcoin request could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('BitcoinRequest.' . $this->BitcoinRequest->primaryKey => $id));
            $this->request->data = $this->BitcoinRequest->find('first', $options);
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
        $this->BitcoinRequest->id = $id;
        if (!$this->BitcoinRequest->exists()) {
            throw new NotFoundException(__('Invalid bitcoin request'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->BitcoinRequest->delete()) {
            $this->Flash->success(__('The bitcoin request has been deleted.'));
        } else {
            $this->Flash->error(__('The bitcoin request could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
