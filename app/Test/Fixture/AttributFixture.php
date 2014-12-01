<?php
/**
 * AttributFixture
 *
 */
class AttributFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'nom' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'pardefault' => array('type' => 'integer', 'null' => false, 'default' => null),
		'section_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'key' => 'index'),
		'obligatoire' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 4),
		'ordre' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'section_id' => array('column' => 'section_id', 'unique' => 0)
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
			'nom' => 'Lorem ipsum dolor sit amet',
			'type' => 'Lorem ipsum dolor sit amet',
			'pardefault' => 1,
			'section_id' => 1,
			'obligatoire' => 1,
			'ordre' => 1
		),
	);

}
