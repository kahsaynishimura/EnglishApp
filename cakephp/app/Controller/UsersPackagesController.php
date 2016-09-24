<?php
App::uses('AppController', 'Controller');
/**
 * UsersPackages Controller
 *
 * @property UsersPackage $UsersPackage
 * @property PaginatorComponent $Paginator
 */
class UsersPackagesController extends AppController {

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
		$this->UsersPackage->recursive = 0;
		$this->set('usersPackages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersPackage->exists($id)) {
			throw new NotFoundException(__('Invalid users package'));
		}
		$options = array('conditions' => array('UsersPackage.' . $this->UsersPackage->primaryKey => $id));
		$this->set('usersPackage', $this->UsersPackage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersPackage->create();
			if ($this->UsersPackage->save($this->request->data)) {
				$this->Flash->success(__('The users package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users package could not be saved. Please, try again.'));
			}
		}
		$users = $this->UsersPackage->User->find('list');
		$packages = $this->UsersPackage->Package->find('list');
		$this->set(compact('users', 'packages'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersPackage->exists($id)) {
			throw new NotFoundException(__('Invalid users package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersPackage->save($this->request->data)) {
				$this->Flash->success(__('The users package has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersPackage.' . $this->UsersPackage->primaryKey => $id));
			$this->request->data = $this->UsersPackage->find('first', $options);
		}
		$users = $this->UsersPackage->User->find('list');
		$packages = $this->UsersPackage->Package->find('list');
		$this->set(compact('users', 'packages'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersPackage->id = $id;
		if (!$this->UsersPackage->exists()) {
			throw new NotFoundException(__('Invalid users package'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersPackage->delete()) {
			$this->Flash->success(__('The users package has been deleted.'));
		} else {
			$this->Flash->error(__('The users package could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
