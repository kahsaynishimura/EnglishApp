<?php

App::uses('AppController', 'Controller');

/**
 * VideoLessonScriptChecks Controller
 *
 * @property VideoLessonScriptCheck $VideoLessonScriptCheck
 * @property PaginatorComponent $Paginator
 */
class VideoLessonScriptChecksController extends AppController {

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
        $this->VideoLessonScriptCheck->recursive = 0;
        $this->set('videoLessonScriptChecks', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->VideoLessonScriptCheck->exists($id)) {
            throw new NotFoundException(__('Invalid video lesson script check'));
        }
        $options = array('conditions' => array('VideoLessonScriptCheck.' . $this->VideoLessonScriptCheck->primaryKey => $id));
        $this->set('videoLessonScriptCheck', $this->VideoLessonScriptCheck->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($videoScriptId = null) {
        if ($this->request->is('post')) {
            $this->VideoLessonScriptCheck->create();
            $this->request->data['VideoLessonScriptCheck']['video_lesson_script_id'] = $videoScriptId;

            if ($this->VideoLessonScriptCheck->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script check has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson script check could not be saved. Please, try again.'));
            }
        }
        $videoLessonScripts = $this->VideoLessonScriptCheck->VideoLessonScript->find('list');
        $this->set(compact('videoLessonScripts'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->VideoLessonScriptCheck->exists($id)) {
            throw new NotFoundException(__('Invalid video lesson script check'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->VideoLessonScriptCheck->save($this->request->data)) {
                $this->Flash->success(__('The video lesson script check has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The video lesson script check could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('VideoLessonScriptCheck.' . $this->VideoLessonScriptCheck->primaryKey => $id));
            $this->request->data = $this->VideoLessonScriptCheck->find('first', $options);
        }
        $videoLessonScripts = $this->VideoLessonScriptCheck->VideoLessonScript->find('list');
        $this->set(compact('videoLessonScripts'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->VideoLessonScriptCheck->id = $id;
        if (!$this->VideoLessonScriptCheck->exists()) {
            throw new NotFoundException(__('Invalid video lesson script check'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->VideoLessonScriptCheck->delete()) {
            $this->Flash->success(__('The video lesson script check has been deleted.'));
        } else {
            $this->Flash->error(__('The video lesson script check could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
