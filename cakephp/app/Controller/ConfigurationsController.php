<?php
App::uses('AppController', 'Controller');
/**
 * Configurations Controller
 *
 * @property Configuration $Configuration
 * @property PaginatorComponent $Paginator
 */
class ConfigurationsController extends AppController {

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
		$this->Configuration->recursive = 0;
		$this->set('configurations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
		$this->set('configuration', $this->Configuration->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Configuration->create();
			if ($this->Configuration->save($this->request->data)) {
				$this->Flash->success(__('The configuration has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The configuration could not be saved. Please, try again.'));
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
		if (!$this->Configuration->exists($id)) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Configuration->save($this->request->data)) {
				$this->Flash->success(__('The configuration has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The configuration could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Configuration.' . $this->Configuration->primaryKey => $id));
			$this->request->data = $this->Configuration->find('first', $options);
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
		$this->Configuration->id = $id;
		if (!$this->Configuration->exists()) {
			throw new NotFoundException(__('Invalid configuration'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Configuration->delete()) {
			$this->Flash->success(__('The configuration has been deleted.'));
		} else {
			$this->Flash->error(__('The configuration could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
