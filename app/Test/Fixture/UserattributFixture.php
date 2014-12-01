<?php
/**
 * UserattributFixture
 *
 */
class UserattributFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'attribut_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'valeur' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uc_usrattribut' => array('column' => array('user_id', 'attribut_id'), 'unique' => 1),
			'attribut_id' => array('column' => 'attribut_id', 'unique' => 0)
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
			'attribut_id' => 1,
			'valeur' => 'Lorem ipsum dolor sit amet'
		),
	);

}
