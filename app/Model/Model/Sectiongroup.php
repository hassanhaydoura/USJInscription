<?php
App::uses('AppModel', 'Model');
/**
 * Sectiongroup Model
 *
 */
class Sectiongroup extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'nom';

public $hasMany = array(
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'sectiongroup_id',
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
