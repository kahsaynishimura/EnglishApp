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
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->SpeechScript->recursive = 0;
        $this->set('speechScripts', $this->Paginator->paginate());
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
    public function add() {
        if ($this->request->is('post')) {
            $this->SpeechScript->create();
            if ($this->SpeechScript->save($this->request->data)) {
                $this->Flash->success(__('The speech script has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The speech script could not be saved. Please, try again.'));
            }
        }
        $speechFunctions = $this->SpeechScript->SpeechFunction->find('list');
        $exercises = $this->SpeechScript->Exercise->find('list');
        $this->set(compact('speechFunctions', 'exercises'));
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
                return $this->redirect(array('action' => 'index'));
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
