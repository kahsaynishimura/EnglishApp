<?php

App::uses('AppModel', 'Model');

/**
 * Book Model
 *
 * @property Lesson $Lesson 
 * @property UsersBook $UsersBook  
 * @property User $User
 */
class Book extends AppModel {
    // The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Lesson' => array(
            'className' => 'Lesson',
            'foreignKey' => 'book_id',
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
        'UsersBook' => array(
            'className' => 'UsersBook',
            'foreignKey' => 'book_id',
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
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '', 
            'fields' => '',
            'order' => ''
        ) 
    );

    public function isOwnedBy($bookId, $userId) {
        return $this->field('id', array('id' => $bookId, 'user_id' => $userId)) !== false;
    }

}
