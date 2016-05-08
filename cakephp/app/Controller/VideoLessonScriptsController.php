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
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->VideoLessonScript->recursive = 0;
        $this->set('videoLessonScripts', $this->Paginator->paginate());
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
    public function add() {
        if ($this->request->is('post')) {
            $this->VideoLessonScript->create();
            if ($this->VideoLessonScript->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson script could not be saved. Please, try again.'));
            }
        }
        $videoLessons = $this->VideoLessonScript->VideoLesson->find('list');
        $this->set(compact('videoLessons'));
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
            if ($this->VideoLessonScript->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script has been saved.'));
                return $this->redirect(array('action' => 'index'));
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
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoLessonScript->delete()) {
            $this->Flash->success(__('The video lesson script has been deleted.'));
        } else {
            $this->Flash->error(__('The video lesson script could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
