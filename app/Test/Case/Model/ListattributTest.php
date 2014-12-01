<?php
App::uses('Listattribut', 'Model');

/**
 * Listattribut Test Case
 *
 */
class ListattributTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.listattribut',
		'app.attribut',
		'app.section',
		'app.userattribut'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Listattribut = ClassRegistry::init('Listattribut');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Listattribut);

		parent::tearDown();
	}

}
