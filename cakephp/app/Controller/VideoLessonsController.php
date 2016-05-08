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
	
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('index_api');
    }

    public function index_api() {
        $this->VideoLesson->recursive = 0;
          $this->VideoLesson->Behaviors->load('Containable');
        if ($this->request->is('xml')) {
            $videoLesson = $this->VideoLesson->find('all', array(
                'fields' =>array('VideoLesson.id','id_video','name'),
                'contain'=>array( 
                    'VideoLessonScript'=>array(
                        'VideoLessonScript.id', 
                        'text_to_show', 
                        'text_to_check',
                        'video_lesson_id',
                        'stop_at_seconds')
                    ),
                'conditions' => array('VideoLesson.id' => 1),
                'order' => array('VideoLesson.id ASC'),));
            
            $this->set(array(
            'VideoLesson' =>$videoLesson,
            '_serialize' => 'VideoLesson'));
        }
    }

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
