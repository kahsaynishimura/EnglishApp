<?php
App::uses('AppModel', 'Model');
/**
 * SpeechScript Model
 *
 * @property SpeechFunction $SpeechFunction
 * @property Exercise $Exercise
 * @property ScriptsUser $ScriptsUser
 */
class SpeechScript extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'SpeechFunction' => array(
			'className' => 'SpeechFunction',
			'foreignKey' => 'speech_function_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Exercise' => array(
			'className' => 'Exercise',
			'foreignKey' => 'exercise_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ScriptsUser' => array(
			'className' => 'ScriptsUser',
			'foreignKey' => 'speech_script_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
