<?php

App::uses('AppController', 'Controller');

/**
 * SpeechScripts Controller
 *
 * @property SpeechScript $SpeechScript
 * @property PaginatorComponent $Paginator
 */
class SpeechScriptsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function index_api() {
        $this->SpeechScript->recursive = 0;
        if ($this->request->is('xml')) {
            $this->set(array(
                'speech_scripts' => $this->SpeechScript->find('all', array(
                    'fields' => array('id', 'text_to_read', 'text_to_check', 'text_to_show', 'exercise_id', 'speech_function_id', 'script_index'),
                    'conditions' => array('exercise_id' => $this->data['SpeechScript']['exercise_id']))),
                '_serialize' => 'speech_scripts'));
        }
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($exerciseId) {
        $this->SpeechScript->recursive = 0;
        $this->set('speechScripts', $this->Paginator->paginate('SpeechScript', array('SpeechScript.exercise_id' => $exerciseId)));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->SpeechScript->exists($id)) {
            throw new NotFoundException(__('Invalid speech script'));
        }
        $options = array('conditions' => array('SpeechScript.' . $this->SpeechScript->primaryKey => $id));
        $this->set('speechScript', $this->SpeechScript->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($lessonId) {
        if ($this->request->is('post')) {
            $this->SpeechScript->Exercise->create();
            $exercise = array(
                'transition_image' => 'practice',
                'name' => $this->request->data['SpeechScript']['exercise_name'],
                'lesson_id' => $lessonId
            );
            if ($this->SpeechScript->Exercise->save($exercise)) {
                $newExerciseId = $this->SpeechScript->Exercise->getLastInsertID();
                $this->SpeechScript->Exercise->id = $newExerciseId;

                $str = $this->request->data['SpeechScript']['complete_text'];
                $arr = preg_split('/\R|,|\.|\/|!|;|:/', $str); //explode("\n", $str);
                foreach ($arr as $key => $value) {
                    $arr[$key] = trim($arr[$key]);
                    if (empty($arr[$key]) || $arr[$key] == " ") {
                        unset($arr[$key]);
                    }
                }
                // var_dump($arr);
                $i = 0;
                foreach ($arr as $key => $value) {
                    $i++;
                    $speechScript = array(
                        'text_to_show' => $arr[$key],
                        'text_to_check' => $arr[$key],
                        'text_to_read' => $arr[$key],
                        'exercise_id' => $this->SpeechScript->Exercise->id,
                        'speech_function_id' => 2,
                        'script_index' => $i
                    );
                    $this->SpeechScript->create();

                    $this->SpeechScript->save($speechScript);
                }

                return $this->redirect(array('action' => 'index', $newExerciseId));
            }
        }
        // $speechFunctions = $this->SpeechScript->SpeechFunction->find('list');
        //$exercises = $this->SpeechScript->Exercise->find('list');
        // $this->set(compact('speechFunctions', 'exercises'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->SpeechScript->exists($id)) {
            throw new NotFoundException(__('Invalid speech script'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->SpeechScript->save($this->request->data)) {
                $this->Flash->success(__('The speech script has been saved.'));
                return $this->redirect(array('controller' => 'books', 'action' => 'index'));
            } else {
                $this->Flash->error(__('The speech script could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SpeechScript.' . $this->SpeechScript->primaryKey => $id));
            $this->request->data = $this->SpeechScript->find('first', $options);
        }
        $speechFunctions = $this->SpeechScript->SpeechFunction->find('list');
        $exercises = $this->SpeechScript->Exercise->find('list');
        $this->set(compact('speechFunctions', 'exercises'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->SpeechScript->id = $id;
        if (!$this->SpeechScript->exists()) {
            throw new NotFoundException(__('Invalid speech script'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->SpeechScript->delete()) {
            $this->Flash->success(__('The speech script has been deleted.'));
        } else {
            $this->Flash->error(__('The speech script could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('edit', 'delete', 'add'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
