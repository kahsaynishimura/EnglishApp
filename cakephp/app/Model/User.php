<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

/**
 * User Model
 *
 *   @property UsersBook $UsersBook
 */
class User extends AppModel {

    public $validate = array('name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A name is required',
                'on' => 'create'
            )
        ),
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Please, enter a valid email'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'This username has already been taken.'
            )
        ),
        'password' => array(
            'rule' => array('minLength', '8'),
            'message' => 'Minimum 8 characters long'
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'student', 'author', 'partner')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                    $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'UsersBook' => array(
            'className' => 'UsersBook',
            'foreignKey' => 'user_id',
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
        'UsersPackage' => array(
            'className' => 'UsersPackage',
            'foreignKey' => 'user_id',
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
        'UsersLesson' => array(
            'className' => 'UsersLesson',
            'foreignKey' => 'user_id',
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
