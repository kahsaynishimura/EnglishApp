<?php

App::uses('AppController', 'Controller');

/**
 * Exercises Controller
 *
 * @property Exercise $Exercise
 * @property PaginatorComponent $Paginator
 */
class ExercisesController extends AppController {

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
        $this->Exercise->recursive = 0;
        $this->Exercise->Behaviors->load('Containable');
        // order by Practice.id Desc to get the last sequence of practice made for that particular lesson
        if ($this->request->is('xml')) {
            $this->set(array(
                'exercises' => $this->Exercise->find('all', array(
                    'contain' => array('Practice' => array(
                            'fields' => array('id'),
                            'conditions' => array('Practice.user_id' => $this->data['Exercise']['user_id']),
                            'order' => array('Practice.id DESC')
                        )),
                    'fields' => array('id', 'name', 'lesson_id', 'transition_image'),
                    'conditions' => array('lesson_id' => $this->data['Exercise']['lesson_id']),
                    'order' => array('Exercise.id ASC'),)),
                '_serialize' => 'exercises'));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($lessonId = null) {
        if (!$this->Exercise->Lesson->exists($lessonId)) {
            throw new NotFoundException(__('Invalid exercise'));
        }
        $this->Exercise->recursive = 0;
        $this->set('exercises', $this->Paginator->paginate('Exercise', array('Exercise.lesson_id' => $lessonId)));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Exercise->exists($id)) {
            throw new NotFoundException(__('Invalid exercise'));
        }
        $options = array('conditions' => array('Exercise.' . $this->Exercise->primaryKey => $id));
        $this->set('exercise', $this->Exercise->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Exercise->create();
            if ($this->Exercise->save($this->request->data)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        }
        $lessons = $this->Exercise->Lesson->find('list');
        $this->set(compact('lessons'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Exercise->exists($id)) {
            throw new NotFoundException(__('Invalid exercise'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Exercise->save($this->request->data)) {
                $this->Flash->success(__('The exercise has been saved.'));
                return $this->redirect(array('controller' => 'books', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The exercise could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Exercise.' . $this->Exercise->primaryKey => $id));
            $this->request->data = $this->Exercise->find('first', $options);
        }
        $lessons = $this->Exercise->Lesson->find('list');
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
        $this->Exercise->id = $id;
        if (!$this->Exercise->exists()) {
            throw new NotFoundException(__('Invalid exercise'));
        }
        $this->request->allowMethod('post', 'delete');
        $lesson_id=$this->Exercise->field("lesson_id");
        if ($this->Exercise->delete()) {
            $this->Flash->success(__('The exercise has been deleted.'));
        } else {
            $this->Flash->error(__('The exercise could not be deleted. Please, try again.'));
        }
        return $this->redirect(array( 'action' => 'index',$lesson_id));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('edit', 'delete', 'add','index'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }
 
}
