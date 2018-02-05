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
        $scripts = $this->Paginator->paginate('VideoLessonScript', array('VideoLessonScript.lesson_id' => $id));
        $this->set('videoLessonScripts', $scripts);
        $this->VideoLessonScript->Lesson->recursive = 0;
        $lesson = $this->VideoLessonScript->Lesson->find('first', array(
            'fields' => array('id_video', 'id'),
            'conditions' => array('Lesson.id' => $id)));
        $this->set('lesson', $lesson);
    }

    public function index_for_text($id = 0) {
        $this->VideoLessonScript->recursive = 0;
        $this->Paginator->settings = array(
            'limit' => '400'
        );
        $this->set('videoLessonScripts', $this->Paginator->paginate('VideoLessonScript', array('VideoLessonScript.lesson_id' => $id)));
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
            $this->request->data['VideoLessonScript']['lesson_id'] = $lesson_id;
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
        $options = array('conditions' => array('Lesson.id' => $lesson_id));
        $lesson = $this->VideoLessonScript->Lesson->find('first', $options);
        $this->set(compact('lesson'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_api() {
        if ($this->request->is('post')) {
            $this->VideoLessonScript->create();
            if ($this->VideoLessonScript->save($this->data)) {
                $this->VideoLessonScript->recursive = 0;
                $this->Paginator->settings = array(
                    'order' => 'VideoLessonScript.stop_at_seconds desc'
                );
                $scripts = $this->Paginator->paginate('VideoLessonScript', array(
                    'VideoLessonScript.lesson_id' => $this->data['VideoLessonScript']['lesson_id']));
                $this->set('videoLessonScripts', $scripts);
                $this->VideoLessonScript->Lesson->recursive = 0;
                $lesson = $this->VideoLessonScript->Lesson->find('first', array(
                    'fields' => array('id_video', 'id'),
                    'conditions' => array('Lesson.id' => $this->data['VideoLessonScript']['lesson_id'])));
                $this->set('lesson', $lesson);
            } else {
                $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
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

                return $this->redirect(array('controller' => 'videoLessons', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('VideoLessonScript.' . $this->VideoLessonScript->primaryKey => $id));
            $this->request->data = $this->VideoLessonScript->find('first', $options);
        }
        $lessons = $this->VideoLessonScript->Lesson->find('list');
        $this->set(compact('lessons'));
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
        $lesson_id = $this->VideoLessonScript->field('lesson_id');
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoLessonScript->delete()) {
            $this->Flash->success(__('The video lesson script has been deleted.'));
        } else {
            $this->Flash->error(__('The video lesson script could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index', $lesson_id));
    }

    public function delete_api() {
        $this->VideoLessonScript->id = $this->data['VideoLessonScript']['id'];
        if (!$this->VideoLessonScript->exists()) {
            throw new NotFoundException(__('Invalid video lesson script'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoLessonScript->delete()) {
            $this->VideoLessonScript->recursive = 0;
            $this->Paginator->settings = array(
                'order' => 'VideoLessonScript.stop_at_seconds desc'
            );
            $scripts = $this->Paginator->paginate('VideoLessonScript', array(
                'VideoLessonScript.lesson_id' => $this->data['VideoLessonScript']['lesson_id']));
            $this->set('videoLessonScripts', $scripts);
            $this->VideoLessonScript->Lesson->recursive = 0;
            $lesson = $this->VideoLessonScript->Lesson->find('first', array(
                'fields' => array('id_video', 'id'),
                'conditions' => array('Lesson.id' => $this->data['VideoLessonScript']['lesson_id'])));
            $this->set('lesson', $lesson);
        } else {
            $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
        }
    }

    public function isAuthorized($user) {
        // All registered users can 
        if (in_array($this->action, array('edit', 'delete', 'add', 'index_for_text'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

    function edit_api() {
        if (!$this->data['VideoLessonScript']['id'])
            return;

        if ($this->data) {

            $field = $this->data['VideoLessonScript']['field'];
            switch ($field) {
                case 'text_to_check':
                case 'text_to_show':
                case 'stop_at_seconds':
                case 'start_at_seconds':
                    break;
                default:

                    return;
            }
            if ($this->request->is(array('post', 'put'))) {
                $this->VideoLessonScript->id = $this->data['VideoLessonScript']['id'];
                if ($this->VideoLessonScript->saveField($field, $this->data['VideoLessonScript']['value'])) {
                    $this->VideoLessonScript->recursive = 0;
                    $this->Paginator->settings = array(
                        'order' => 'VideoLessonScript.stop_at_seconds desc'
                    );
                    $scripts = $this->Paginator->paginate('VideoLessonScript', array(
                        'VideoLessonScript.lesson_id' => $this->data['VideoLessonScript']['lesson_id']));
                    $this->set('videoLessonScripts', $scripts);
                    $this->VideoLessonScript->Lesson->recursive = 0;
                    $lesson = $this->VideoLessonScript->Lesson->find('first', array(
                        'fields' => array('id_video', 'id'),
                        'conditions' => array('Lesson.id' => $this->data['VideoLessonScript']['lesson_id'])));
                    $this->set('lesson', $lesson);
                }
            }
        }
    }

}
