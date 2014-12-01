<?php
App::uses('Userformation', 'Model');

/**
 * Userformation Test Case
 *
 */
class UserformationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userformation',
		'app.user',
		'app.formation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Userformation = ClassRegistry::init('Userformation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userformation);

		parent::tearDown();
	}

}
