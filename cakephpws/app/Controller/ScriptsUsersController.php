<?php
App::uses('AppController', 'Controller');
/**
 * ScriptsUsers Controller
 *
 * @property ScriptsUser $ScriptsUser
 * @property PaginatorComponent $Paginator
 */
class ScriptsUsersController extends AppController {

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
		$this->ScriptsUser->recursive = 0;
		$this->set('scriptsUsers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ScriptsUser->exists($id)) {
			throw new NotFoundException(__('Invalid scripts user'));
		}
		$options = array('conditions' => array('ScriptsUser.' . $this->ScriptsUser->primaryKey => $id));
		$this->set('scriptsUser', $this->ScriptsUser->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ScriptsUser->create();
			if ($this->ScriptsUser->save($this->request->data)) {
				$this->Flash->success(__('The scripts user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The scripts user could not be saved. Please, try again.'));
			}
		}
		$users = $this->ScriptsUser->User->find('list');
		$speechScripts = $this->ScriptsUser->SpeechScript->find('list');
		$this->set(compact('users', 'speechScripts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ScriptsUser->exists($id)) {
			throw new NotFoundException(__('Invalid scripts user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ScriptsUser->save($this->request->data)) {
				$this->Flash->success(__('The scripts user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The scripts user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ScriptsUser.' . $this->ScriptsUser->primaryKey => $id));
			$this->request->data = $this->ScriptsUser->find('first', $options);
		}
		$users = $this->ScriptsUser->User->find('list');
		$speechScripts = $this->ScriptsUser->SpeechScript->find('list');
		$this->set(compact('users', 'speechScripts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ScriptsUser->id = $id;
		if (!$this->ScriptsUser->exists()) {
			throw new NotFoundException(__('Invalid scripts user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->ScriptsUser->delete()) {
			$this->Flash->success(__('The scripts user has been deleted.'));
		} else {
			$this->Flash->error(__('The scripts user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
