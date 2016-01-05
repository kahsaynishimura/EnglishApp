<?php
App::uses('AppController', 'Controller');
/**
 * SpeechFunctions Controller
 *
 * @property SpeechFunction $SpeechFunction
 * @property PaginatorComponent $Paginator
 */
class SpeechFunctionsController extends AppController {

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
		$this->SpeechFunction->recursive = 0;
		$this->set('speechFunctions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SpeechFunction->exists($id)) {
			throw new NotFoundException(__('Invalid speech function'));
		}
		$options = array('conditions' => array('SpeechFunction.' . $this->SpeechFunction->primaryKey => $id));
		$this->set('speechFunction', $this->SpeechFunction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SpeechFunction->create();
			if ($this->SpeechFunction->save($this->request->data)) {
				$this->Flash->success(__('The speech function has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The speech function could not be saved. Please, try again.'));
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
		if (!$this->SpeechFunction->exists($id)) {
			throw new NotFoundException(__('Invalid speech function'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SpeechFunction->save($this->request->data)) {
				$this->Flash->success(__('The speech function has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The speech function could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SpeechFunction.' . $this->SpeechFunction->primaryKey => $id));
			$this->request->data = $this->SpeechFunction->find('first', $options);
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
		$this->SpeechFunction->id = $id;
		if (!$this->SpeechFunction->exists()) {
			throw new NotFoundException(__('Invalid speech function'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->SpeechFunction->delete()) {
			$this->Flash->success(__('The speech function has been deleted.'));
		} else {
			$this->Flash->error(__('The speech function could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
