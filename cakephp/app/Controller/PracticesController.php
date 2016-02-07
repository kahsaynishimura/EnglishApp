<?php

App::uses('AppController', 'Controller');

/**
 * Practices Controller
 *
 * @property Practice $Practice
 * @property PaginatorComponent $Paginator
 */
class PracticesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add_api');
    }

    /*     * ********************************Rest API********************************** */

    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $this->Practice->create();

            if ($this->Practice->save($this->request->data)) {
                $this->Practice->User->id = $this->request->data['Practice']['user_id'];
                $this->Practice->User->saveField('total_points', $this->request->data['Practice']['points'] + $this->Practice->User->field('total_points'));
                $message = __('The practice has been saved.');
            } else {
                $message = __('The practice could not be saved. Please, try again.');
            }
            $this->set(array(
                'message' => $message,
                '_serialize' => array('message')
            ));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Practice->recursive = 0;
        $this->set('practices', $this->Paginator->paginate());
    }

    public function ranking($bookId = null) {
        $this->Practice->Behaviors->load('Containable');

        $this->Practice->Exercise->Lesson->recursive = 0;

        if ($bookId != null) {

            //find lessons
            $lessons = $this->Practice->Exercise->Lesson->find('all', array(
                'conditions' => array('Lesson.book_id' => $bookId),
                'fields' => array('Lesson.id')
            ));
            $lessonIds = array();
            foreach ($lessons as $key => $lesson) {
                array_push($lessonIds, $lesson['Lesson']['id']);
            }

            //find exercises
            $exercises = $this->Practice->Exercise->find('all', array(
                'conditions' => array('Exercise.lesson_id' => $lessonIds),
                'fields' => array('Exercise.id')
            ));
            $exerciseIds = array();

            foreach ($exercises as $key => $exercise) {
                array_push($exerciseIds, $exercise['Exercise']['id']);
            }
            $this->Paginator->settings = array(
                'Practice' => array(
                    'limit' => 20,
                    'conditions' => array(
                        'Practice.exercise_id' => $exerciseIds
                    ),
                    'contain' => array(
                        'User' => array('name')),
                    'fields' => array('(SUM(Practice.points)) as total_points', 'Practice.user_id'),
                    'order' => array('total_points' => 'desc'),
                    'group' => array('user_id')
            ));
        } else {
            $this->Paginator->settings = array(
                'Practice' => array(
                    'limit' => 20,
                    'contain' => array(
                        'User' => array('name'),
                    ),
                    'fields' => array('(SUM(Practice.points)) as total_points', 'Practice.user_id'),
                    'order' => array('total_points' => 'desc'),
                    'group' => array('user_id')
                )
            );
        }
        $this->set('practices', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Practice->exists($id)) {
            throw new NotFoundException(__('Invalid practice'));
        }
        $options = array('conditions' => array('Practice.' . $this->Practice->primaryKey => $id));
        $this->set('practice', $this->Practice->find('first', $options));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if (in_array($this->action, array('index', 'ranking'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
