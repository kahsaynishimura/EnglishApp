<?php

App::uses('AppController', 'Controller');

/**
 * Lessons Controller
 *
 * @property Lesson $Lesson
 * @property PaginatorComponent $Paginator
 */
class LessonsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('v_lesson_scripts_api');
    }

    public function v_lesson_scripts_api() {
        $this->Lesson->recursive = 0;
        $this->Lesson->Behaviors->load('Containable');
        if ($this->request->is('xml')) {
            $lesson = $this->Lesson->find('all', array(
                'fields' => array('Lesson.id', 'id_video', 'name'),
                'contain' => array(
                    'VideoLessonScript' => array(
                        'fields' => array('id',
                            'text_to_show',
                            'text_to_check',
                            'lesson_id',
                            'stop_at_seconds',
                            'start_at_seconds'),
                        'order' => array('stop_at_seconds'),
                        'VideoLessonScriptCheck' => array('fields' => array('id', 'text_to_check'))
                    ),
                ),
                'conditions' => array('Lesson.id' => $this->request->data['Lesson']['id']),
            ));

            $this->set(array(
                'lesson' => $lesson,
                '_serialize' => 'lesson'));
        }
    }

    public function index_api() {
        $this->Lesson->recursive = 0;
        if ($this->request->is('xml')) {
            $this->set(array(
                'lessons' => $this->Lesson->find('all', array(
                    'fields' => array('id', 'name', 'book_id'),
                    'conditions' => array('book_id' => $this->data['Lesson']['book_id']))),
                '_serialize' => 'lessons'));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($book_id = null) {
        $this->Lesson->recursive = 0;
        $this->Lesson->Book->id = $book_id;
        if (!$this->Lesson->Book->exists($book_id)) {
            throw new NotFoundException(__('Invalid book'));
        }
        $this->set('lessons', $this->Paginator->paginate('Lesson', array('Book.id' => $book_id)));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Lesson->exists($id)) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        $options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
        $this->set('lesson', $this->Lesson->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($book_id = null) {

        if ($this->request->is('post')) {
            $this->Lesson->Book->id = $book_id;
            if (!$this->Lesson->Book->exists($book_id)) {
                throw new NotFoundException(__('Invalid book'));
            }
            $this->request->data['Lesson']['book_id'] = $book_id;
            $this->Lesson->create();
            if ($this->Lesson->save($this->request->data)) {
                $this->Flash->success(__('The lesson has been saved.'));
                return $this->redirect(array('controller' => 'speech_scripts', 'action' => 'add', $this->Lesson->getLastInsertID()));
            } else {
                $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
        }
        $books = $this->Lesson->Book->find('list');
        $this->set(compact('books'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Lesson->exists($id)) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->Lesson->id = $id;
            if ($this->Lesson->save($this->request->data)) {
                $this->Flash->success(__('The lesson has been saved.'));
                return $this->redirect(array('controller' => 'books', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The lesson could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
            $this->request->data = $this->Lesson->find('first', $options);
        }
        $books = $this->Lesson->Book->find('list');
        $this->set(compact('books'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Lesson->id = $id;
        if (!$this->Lesson->exists()) {
            throw new NotFoundException(__('Invalid lesson'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Lesson->delete()) {
            $this->Flash->success(__('The lesson has been deleted.'));
        } else {
            $this->Flash->error(__('The lesson could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('controller' => 'books', 'action' => 'index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('edit', 'delete', 'add', 'index'))) {
            return true;
        }
    }

}
