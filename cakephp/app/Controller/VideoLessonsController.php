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
        $this->Auth->allow('filtered_index_api', 'index_api', 'lesson_scripts_api');
    }

    public function index_api() {
        $this->VideoLesson->recursive = 0;
        if ($this->request->is('xml')) {
            $videos = $this->VideoLesson->find('all', array(
                'conditions' => array('package_id' => $this->request->data['VideoLesson']['package_id'])
            ));
            $this->set(array(
                'videoLessons' => $videos,
                '_serialize' => 'videoLessons'));
        }
    }

//expects a post parameter: TAG_CATEGORY_ID = "data[VideoLesson][video_category_id]"
    public function filtered_index_api() {
        $this->VideoLesson->recursive = 0;
        if ($this->request->is('xml')) {
            $categoryId = $this->request->data['VideoLesson']['video_category_id'];

            $freeVideoLessons = $this->VideoLesson->find('all', array(
                'conditions' => array('video_category_id' => $categoryId)
            ));
            $this->set(array(
                'VideoLessons' => $freeVideoLessons,
                '_serialize' => 'VideoLessons'));
        }
    }

    public function lesson_scripts_api() {
        $this->VideoLesson->recursive = 0;
        $this->VideoLesson->Behaviors->load('Containable');
        if ($this->request->is('xml')) {
            $videoLesson = $this->VideoLesson->find('all', array(
                'fields' => array('VideoLesson.id', 'id_video', 'name'),
                'contain' => array(
                    'VideoLessonScript' => array(
                        'fields' => array('id',
                            'text_to_show',
                            'text_to_check',
                            'video_lesson_id',
                            'stop_at_seconds',
                            'start_at_seconds'),
                        'order' => array('VideoLessonScript.stop_at_seconds')
                    )
                ),
                'conditions' => array('VideoLesson.id' => $this->request->data['VideoLesson']['id']),
            ));

            $this->set(array(
                'VideoLesson' => $videoLesson,
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
    public function add($packageId = 0) {
        if ($this->request->is('post')) {
            $this->VideoLesson->create();
            $this->request->data['VideoLesson']['package_id'] = $packageId;
            $this->request->data['VideoLesson']['user_id'] = $this->Auth->user('id');

            if ($this->VideoLesson->save($this->request->data)) {
                $this->Flash->success(__('The video lesson has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson could not be saved. Please, try again.'));
            }
        }
        $this->set(array(
            'categories' => $this->VideoLesson->VideoCategory->find('list'),
            'packages' => $this->VideoLesson->Package->find('list'),
            '_serialize' => array('categories', 'packages')));
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
        $this->set(array(
            'categories' => $this->VideoLesson->VideoCategory->find('list'),
            'packages' => $this->VideoLesson->Package->find('list'),
            '_serialize' => array('categories', 'packages')));
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

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'index'))) {
            return true;
        }

        // The owner of a videoLesson can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $itemId = (int) $this->request->params['pass'][0];
            if ($this->VideoLesson->isOwnedBy($itemId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }

}
