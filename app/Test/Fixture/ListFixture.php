<?php
/**
 * ListFixture
 *
 */
class ListFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'attributid' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'index'),
		'valeur' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'attributadditionnelid' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'uc_listvaleur' => array('column' => array('attributid', 'valeur'), 'unique' => 1),
			'attributadditionnelid' => array('column' => 'attributadditionnelid', 'unique' => 0)
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
			'attributid' => 1,
			'valeur' => 'Lorem ipsum dolor sit amet',
			'attributadditionnelid' => 1
		),
	);

}
