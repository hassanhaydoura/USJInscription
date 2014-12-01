<?php
/**
 * UserformationsecFixture
 *
 */
class UserformationsecFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'ecolessecondaire_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'formationsecondaire_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uc_usrformationsec' => array('column' => array('user_id', 'formationsecondaire_id'), 'unique' => 1),
			'formationsecondaire_id' => array('column' => 'formationsecondaire_id', 'unique' => 0),
			'ecolessecondaire_id' => array('column' => 'ecolessecondaire_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'ecolessecondaire_id' => 1,
			'formationsecondaire_id' => 1
		),
	);

}
