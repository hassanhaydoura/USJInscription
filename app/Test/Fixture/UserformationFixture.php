<?php
/**
 * UserformationFixture
 *
 */
class UserformationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'formation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'priorite' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uc_usrform' => array('column' => array('user_id', 'formation_id'), 'unique' => 1),
			'uc_usrformation' => array('column' => array('user_id', 'formation_id'), 'unique' => 1),
			'formation_id' => array('column' => 'formation_id', 'unique' => 0)
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
			'formation_id' => 1,
			'priorite' => 1
		),
	);

}
