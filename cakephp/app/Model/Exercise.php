<?php
App::uses('AppModel', 'Model');
/**
 * Exercise Model
 *
 * @property SpeechScript $SpeechScript
 * @property Lesson $Lesson
 * @property Practice $Practice
 */
class Exercise extends AppModel {
 

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Lesson' => array(
			'className' => 'Lesson',
			'foreignKey' => 'lesson_id',
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
		'SpeechScript' => array(
			'className' => 'SpeechScript',
			'foreignKey' => 'exercise_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Practice' => array(
			'className' => 'Practice',
			'foreignKey' => 'exercise_id',
			'dependent' => true,
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
