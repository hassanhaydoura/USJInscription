<?php
App::uses('Formation', 'Model');

/**
 * Formation Test Case
 *
 */
class FormationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formation',
		'app.institution',
		'app.userformation',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formation = ClassRegistry::init('Formation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formation);

		parent::tearDown();
	}

}
