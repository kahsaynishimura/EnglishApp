<?php

App::uses('AppController', 'Controller');

/**
 * SpeechScriptChecks Controller
 *
 * @property SpeechScriptCheck $SpeechScriptCheck
 * @property PaginatorComponent $Paginator
 */
class SpeechScriptChecksController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'RequestHandler');

    public function beforeFilter() {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add_api');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index($speechScriptId) {
        $this->SpeechScriptCheck->recursive = 0;
        $this->set('speechScriptChecks', $this->Paginator->paginate(array(
                    'speech_script_id' => $speechScriptId
        )));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->SpeechScriptCheck->exists($id)) {
            throw new NotFoundException(__('Invalid speech script check'));
        }
        $options = array('conditions' => array('SpeechScriptCheck.' . $this->SpeechScriptCheck->primaryKey => $id));
        $this->set('speechScriptCheck', $this->SpeechScriptCheck->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($speechScriptId = null, $exerciseId = null) {
        if ($this->request->is('post')) {
            $this->SpeechScriptCheck->create();

            $this->request->data['SpeechScriptCheck']['speech_script_id'] = $speechScriptId;

            if ($this->SpeechScriptCheck->save($this->request->data)) {
                $this->Flash->success(__('The speech script check has been saved.'));
                return $this->redirect(array('action' => 'index', $speechScriptId, $exerciseId));
            } else {
                $this->Flash->error(__('The speech script check could not be saved. Please, try again.'));
            }
        }
        $speechScripts = $this->SpeechScriptCheck->SpeechScript->find('list');
        $this->set(compact('speechScripts'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_api() {
        if ($this->request->is(array('post', 'xml'))) {
            $general_response = array();
            $this->SpeechScriptCheck->create();

            if ($this->SpeechScriptCheck->save($this->request->data)) {
                $general_response = array('status' => 'success', 'data' => $this->SpeechScriptCheck->field("id"), 'message' => __('Your alternate check was saved.'));
            } else {
                $general_response = array('status' => 'error', 'data' => $this->SpeechScriptCheck->field("id"), 'message' => __('Something went wrong. Please, try again.'));
            }
        }

        $this->set(array(
            'general_response' => $general_response,
            '_serialize' => array('general_response')
        ));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->SpeechScriptCheck->exists($id)) {
            throw new NotFoundException(__('Invalid speech script check'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->SpeechScriptCheck->save($this->request->data)) {
                $this->Flash->success(__('The speech script check has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Flash->error(__('The speech script check could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('SpeechScriptCheck.' . $this->SpeechScriptCheck->primaryKey => $id));
            $this->request->data = $this->SpeechScriptCheck->find('first', $options);
        }
        $speechScripts = $this->SpeechScriptCheck->SpeechScript->find('list');
        $this->set(compact('speechScripts'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->SpeechScriptCheck->id = $id;
        if (!$this->SpeechScriptCheck->exists()) {
            throw new NotFoundException(__('Invalid speech script check'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->SpeechScriptCheck->delete()) {
            $this->Flash->success(__('The speech script check has been deleted.'));
        } else {
            $this->Flash->error(__('The speech script check could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        if (in_array($this->action, array('add', 'index', 'edit', 'delete'))) {
            return true;
        }



        return parent::isAuthorized($user);
    }

}
