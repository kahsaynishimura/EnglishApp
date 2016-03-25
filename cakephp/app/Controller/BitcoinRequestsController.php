<?php
App::uses('AppController', 'Controller');
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
	public $components = array('Paginator');

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
	public function add() {
		if ($this->request->is('post')) {
			$this->BitcoinRequest->create();
			if ($this->BitcoinRequest->save($this->request->data)) {
				$this->Flash->success(__('The bitcoin request has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The bitcoin request could not be saved. Please, try again.'));
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
