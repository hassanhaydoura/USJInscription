<?php
App::uses('AppModel', 'Model');
/**
 * Dossiercode Model
 *
 */
class Dossiercode extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	/*public $displayField = 'id';*/

/**
 * Validation rules
 *
 * @var array
 */
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
	);
}
