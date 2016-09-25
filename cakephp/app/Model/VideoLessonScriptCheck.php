<?php
App::uses('AppModel', 'Model');
/**
 * VideoLessonScriptCheck Model
 *
 * @property VideoLessonScript $VideoLessonScript
 */
class VideoLessonScriptCheck extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'video_lesson_script_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'text_to_check' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'VideoLessonScript' => array(
			'className' => 'VideoLessonScript',
			'foreignKey' => 'video_lesson_script_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
