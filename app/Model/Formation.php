<?php
App::uses('AppModel', 'Model');
/**
 * Formation Model
 *
 * @property Institution $Institution
 * @property Userformation $Userformation
 */
class Formation extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */ 
 public $displayField = 'nom';
	public $validate = array(
		'code' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'nom' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'institution_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'url' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Institution' => array(
			'className' => 'Institution',
			'foreignKey' => 'institution_id',
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
// 	public $hasMany = array(
// 		'Userformation' => array(
// 			'className' => 'Userformation',
// 			'foreignKey' => 'formation_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		)
// 	);

}
