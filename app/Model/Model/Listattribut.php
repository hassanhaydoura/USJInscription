<?php
App::uses('AppModel', 'Model');
/**
 * Listattribut Model
 *
 * @property Attribut $Attribut
 */
class Listattribut extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
	public $validate = array(
		'attribut_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valeur' => array(
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
		'Attribut' => array(
			'className' => 'Attribut',
			'foreignKey' => 'attribut_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
