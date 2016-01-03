<?php
App::uses('AppModel', 'Model');
/**
 * SpeechFunction Model
 *
 * @property SpeechScript $SpeechScript
 */
class SpeechFunction extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'SpeechScript' => array(
			'className' => 'SpeechScript',
			'foreignKey' => 'speech_function_id',
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
