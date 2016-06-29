<?php
App::uses('AppController', 'Controller');
/**
 * UsersVideoLessons Controller
 *
 * @property UsersVideoLesson $UsersVideoLesson
 * @property PaginatorComponent $Paginator
 */
class UsersVideoLessonsController extends AppController {

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
		$this->UsersVideoLesson->recursive = 0;
		$this->set('usersVideoLessons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->UsersVideoLesson->exists($id)) {
			throw new NotFoundException(__('Invalid users video lesson'));
		}
		$options = array('conditions' => array('UsersVideoLesson.' . $this->UsersVideoLesson->primaryKey => $id));
		$this->set('usersVideoLesson', $this->UsersVideoLesson->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->UsersVideoLesson->create();
			if ($this->UsersVideoLesson->save($this->request->data)) {
				$this->Flash->success(__('The users video lesson has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users video lesson could not be saved. Please, try again.'));
			}
		}
		$users = $this->UsersVideoLesson->User->find('list');
		$videoLessons = $this->UsersVideoLesson->VideoLesson->find('list');
		$this->set(compact('users', 'videoLessons'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->UsersVideoLesson->exists($id)) {
			throw new NotFoundException(__('Invalid users video lesson'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsersVideoLesson->save($this->request->data)) {
				$this->Flash->success(__('The users video lesson has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The users video lesson could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('UsersVideoLesson.' . $this->UsersVideoLesson->primaryKey => $id));
			$this->request->data = $this->UsersVideoLesson->find('first', $options);
		}
		$users = $this->UsersVideoLesson->User->find('list');
		$videoLessons = $this->UsersVideoLesson->VideoLesson->find('list');
		$this->set(compact('users', 'videoLessons'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->UsersVideoLesson->id = $id;
		if (!$this->UsersVideoLesson->exists()) {
			throw new NotFoundException(__('Invalid users video lesson'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->UsersVideoLesson->delete()) {
			$this->Flash->success(__('The users video lesson has been deleted.'));
		} else {
			$this->Flash->error(__('The users video lesson could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
