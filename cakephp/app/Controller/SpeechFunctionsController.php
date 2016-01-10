<?php
App::uses('AppController', 'Controller');
/**
 * SpeechFunctions Controller
 *
 * @property SpeechFunction $SpeechFunction
 * @property PaginatorComponent $Paginator
 */
class SpeechFunctionsController extends AppController {

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
		$this->SpeechFunction->recursive = 0;
		$this->set('speechFunctions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SpeechFunction->exists($id)) {
			throw new NotFoundException(__('Invalid speech function'));
		}
		$options = array('conditions' => array('SpeechFunction.' . $this->SpeechFunction->primaryKey => $id));
		$this->set('speechFunction', $this->SpeechFunction->find('first', $options));
	}

}
