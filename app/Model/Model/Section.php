<?php
App::uses('AppModel', 'Model');
/**
 * Section Model
 *
 * @property Attribut $Attribut
 */
class Section extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
public $order = "Section.ordre ASC";
	public $validate = array(
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
		'ordre' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * hasMany associations
 *
 * @var array
 */
 
 	public $belongsTo = array(
		'Sectiongroup' => array(
			'className' => 'Sectiongroup',
			'foreignKey' => 'sectiongroup_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

 
 
	public $hasMany = array(
		'Attribut' => array(
			'className' => 'Attribut',
			'foreignKey' => 'section_id',
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
