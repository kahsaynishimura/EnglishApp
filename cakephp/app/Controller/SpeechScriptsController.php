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
        $this->SpeechScript->Behaviors->load('Containable');
        if ($this->request->is('xml')) {
            $this->set(array(
                'speech_scripts' => $this->SpeechScript->find('all', array(
                    'fields' => array('id', 'text_to_read', 'text_to_check', 'text_to_show', 'translation', 'exercise_id', 'speech_function_id', 'script_index'),
                    'contain' => array('SpeechScriptCheck' => array(
                            'fields' => array('id', 'speech_script_id', 'text_to_check')
                        )),
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
     * Adds a bunch of sentences at one (creates a new exercise)
     * @return void
     */
    public function add($lessonId) {
        if ($this->request->is('post')) {
            $this->SpeechScript->Exercise->create();
            $exercise = array(
                'transition_image' => 'practice',
                'name' => $this->request->data['SpeechScript']['exercise_name'],
                'lesson_id' => $lessonId,
            );

            if ($this->SpeechScript->Exercise->save($exercise)) {
                $newExerciseId = $this->SpeechScript->Exercise->getLastInsertID();
                $this->SpeechScript->Exercise->id = $newExerciseId;

                $str = $this->request->data['SpeechScript']['complete_text'];

                $arr = '';
                if ($this->request->data['SpeechScript']['include_comma'] === "1") {
                    $arr = preg_split('/\R|\.|\/|!|;|:|,/', $str);
                } else {
                    $arr = preg_split('/\R|\/|;/', $str); //$arr = preg_split('/\R|\.|\/|!|;/', $str);
                }
                //$arr = preg_split('/\R|\.|\/|!|;|:/', $str); //explode("\n", $str);
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
                    $text = preg_split('/=|\|/', $value);
                  //  var_dump($text);
                    $speechScript = array(
                        'text_to_show' => $text[0],
                        'text_to_check' => $text[0],
                        'text_to_read' =>
                        ($this->request->data['SpeechScript']['fulfill_text_to_read'] === "1") ? $text[0] : '',
                        'translation' =>
                        (array_key_exists(1, $text)) ? $text[1] : '',
                        'exercise_id' => $this->SpeechScript->Exercise->id,
                        'speech_function_id' => $this->request->data['SpeechScript']['speech_function_id'],
                        'script_index' => $i
                    );

                    $this->SpeechScript->create();

                    $this->SpeechScript->save($speechScript);
                }

                return $this->redirect(array('action' => 'index', $newExerciseId));
            }
        }
    }

//adds one single speech script to an exercise
    public function add_one($exerciseId = null) {
        if ($this->request->is('post') && $exerciseId != null) {
            $this->SpeechScript->create();
            $this->request->data['SpeechScript']['exercise_id'] = $exerciseId;
            $this->request->data['SpeechScript']['speech_function_id'] = 2;
            if ($this->SpeechScript->save($this->request->data)) {
                $this->Flash->success(__('The speech script has been saved.'));
                return $this->redirect(array('action' => 'index', $this->request->data['SpeechScript']['exercise_id']));
            } else {
                $this->Flash->error(__('The speech script could not be saved. Please, try again.'));
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
        if (!$this->SpeechScript->exists($id)) {
            throw new NotFoundException(__('Invalid speech script'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->SpeechScript->save($this->request->data)) {
                $this->Flash->success(__('The speech script has been saved.'));
                return $this->redirect(array('action' => 'index', $this->request->data['SpeechScript']['exercise_id']));
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
    public function delete($id = null, $exercise_id = null) {
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
        return $this->redirect(array('action' => 'index', $exercise_id));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('edit', 'delete', 'add', 'add_one', 'index'))) {
            return true;
        }

        return parent::isAuthorized($user);
    }

}
