<?php
App::uses('AppController', 'Controller');
/**
 * VideoLessons Controller
 *
 * @property VideoLesson $VideoLesson
 * @property PaginatorComponent $Paginator
 */
class VideoLessonsController extends AppController {

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
		$this->VideoLesson->recursive = 0;
		$this->set('videoLessons', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->VideoLesson->exists($id)) {
			throw new NotFoundException(__('Invalid video lesson'));
		}
		$options = array('conditions' => array('VideoLesson.' . $this->VideoLesson->primaryKey => $id));
		$this->set('videoLesson', $this->VideoLesson->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->VideoLesson->create();
			if ($this->VideoLesson->save($this->request->data)) {
				$this->Flash->success(__('The video lesson has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The video lesson could not be saved. Please, try again.'));
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
		if (!$this->VideoLesson->exists($id)) {
			throw new NotFoundException(__('Invalid video lesson'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->VideoLesson->save($this->request->data)) {
				$this->Flash->success(__('The video lesson has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The video lesson could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('VideoLesson.' . $this->VideoLesson->primaryKey => $id));
			$this->request->data = $this->VideoLesson->find('first', $options);
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
		$this->VideoLesson->id = $id;
		if (!$this->VideoLesson->exists()) {
			throw new NotFoundException(__('Invalid video lesson'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->VideoLesson->delete()) {
			$this->Flash->success(__('The video lesson has been deleted.'));
		} else {
			$this->Flash->error(__('The video lesson could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
