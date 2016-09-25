<?php

App::uses('AppController', 'Controller');

/**
 * VideoLessonScripts Controller
 *
 * @property VideoLessonScript $VideoLessonScript
 * @property PaginatorComponent $Paginator
 */
class VideoLessonScriptsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    /**
     * index method
     *
     * @return void
     */
    public function index($id = 0) {
        $this->VideoLessonScript->recursive = 0;
        $this->Paginator->settings = array(
            'order' => 'VideoLessonScript.stop_at_seconds desc'
        );
        $this->set('videoLessonScripts', $this->Paginator->paginate('VideoLessonScript', array('VideoLessonScript.video_lesson_id' => $id)));
    }

    public function index_for_text($id = 0) {
        $this->VideoLessonScript->recursive = 0;
         $this->Paginator->settings = array(
            'limit' => '400'
        );
        $this->set('videoLessonScripts', $this->Paginator->paginate('VideoLessonScript', array('VideoLessonScript.video_lesson_id' => $id)));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VideoLessonScript->exists($id)) {
            throw new NotFoundException(__('Invalid video lesson script'));
        }
        $options = array('conditions' => array('VideoLessonScript.' . $this->VideoLessonScript->primaryKey => $id));
        $this->set('videoLessonScript', $this->VideoLessonScript->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($lesson_id) {
        if ($this->request->is('post')) {
            $this->VideoLessonScript->create();
            $this->request->data['VideoLessonScript']['video_lesson_id'] = $lesson_id;
            $startSec = (int) $this->request->data['VideoLessonScript']['start_seconds'];
            $startMin = (int) $this->request->data['VideoLessonScript']['start_minutes'];
            $stopSec = (int) $this->request->data['VideoLessonScript']['stop_seconds'];
            $stopMin = (int) $this->request->data['VideoLessonScript']['stop_minutes'];
            $this->request->data['VideoLessonScript']['start_at_seconds'] = $startSec + $startMin * 60;
            $this->request->data['VideoLessonScript']['stop_at_seconds'] = $stopSec + $stopMin * 60;
            if ($this->VideoLessonScript->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script has been saved.'));
                return $this->redirect(array('controller' => 'videoLessons', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
            }
        }
        $options = array('conditions' => array('VideoLesson.id' => $lesson_id));
        $videoLesson = $this->VideoLessonScript->VideoLesson->find('first', $options);
        $this->set(compact('videoLesson'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->VideoLessonScript->exists($id)) {
            throw new NotFoundException(__('Invalid video lesson script'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $startSec = (int) $this->request->data['VideoLessonScript']['start_seconds'];
            $startMin = (int) $this->request->data['VideoLessonScript']['start_minutes'];
            $stopSec = (int) $this->request->data['VideoLessonScript']['stop_seconds'];
            $stopMin = (int) $this->request->data['VideoLessonScript']['stop_minutes'];
            $this->request->data['VideoLessonScript']['start_at_seconds'] = $startSec + $startMin * 60;
            $this->request->data['VideoLessonScript']['stop_at_seconds'] = $stopSec + $stopMin * 60;
            if ($this->VideoLessonScript->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script has been saved.'));

                return $this->redirect(array('action' => 'index', $this->request->data['VideoLessonScript']['video_lesson_id']));
            } else {
                $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('VideoLessonScript.' . $this->VideoLessonScript->primaryKey => $id));
            $this->request->data = $this->VideoLessonScript->find('first', $options);
        }
        $videoLessons = $this->VideoLessonScript->VideoLesson->find('list');
        $this->set(compact('videoLessons'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->VideoLessonScript->id = $id;
        if (!$this->VideoLessonScript->exists()) {
            throw new NotFoundException(__('Invalid video lesson script'));
        }
        $this->VideoLessonScript->id = $id;
        $video_lesson_id = $this->VideoLessonScript->field('video_lesson_id');
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoLessonScript->delete()) {
            $this->Flash->success(__('The video lesson script has been deleted.'));
        } else {
            $this->Flash->error(__('The video lesson script could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index', $video_lesson_id));
    }

    public function isAuthorized($user) {
        // All registered users can 
        if (in_array($this->action, array('edit', 'delete', 'add', 'index_for_text'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
