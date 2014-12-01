<?php
App::uses('AppModel', 'Model');
/**
 * Formationsecondaire Model
 *
 */
class Formationsecondaire extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 public $displayField = 'nom';
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
	);
}
