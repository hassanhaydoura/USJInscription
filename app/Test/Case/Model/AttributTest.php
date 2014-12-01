<?php
App::uses('Attribut', 'Model');

/**
 * Attribut Test Case
 *
 */
class AttributTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.attribut',
		'app.section',
		'app.listattribut',
		'app.userattribut'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Attribut = ClassRegistry::init('Attribut');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Attribut);

		parent::tearDown();
	}

}
