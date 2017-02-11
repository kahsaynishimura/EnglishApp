<?php

App::uses('AppModel', 'Model');

/**
 * VideoLesson Model
 * @property Package $Package 
 * @property VideoLessonScript $VideoLessonScript
 * @property VideoCategory $VideoCategory
 */
class VideoLesson extends AppModel {

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            //'message' => 'Your custom message here',
            //'allowEmpty' => false,
            //'required' => false,
            //'last' => false, // Stop validation after this rule
            //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'link' => array(
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
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'VideoLessonScript' => array(
            'className' => 'VideoLessonScript',
            'foreignKey' => 'video_lesson_id',
            'dependent' => false,
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

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'VideoCategory' => array(
            'className' => 'VideoCategory',
            'foreignKey' => 'video_category_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'Package' => array(
            'className' => 'Package',
            'foreignKey' => 'package_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
    );

    public function isOwnedBy($itemId, $userId) {
        return $this->field('id', array('id' => $itemId, 'user_id' => $userId)) !== false;
    }

}
