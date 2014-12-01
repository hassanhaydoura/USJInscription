<?php
App::uses('Userformationsec', 'Model');

/**
 * Userformationsec Test Case
 *
 */
class UserformationsecTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userformationsec',
		'app.user',
		'app.ecolessecondaire',
		'app.formationsecondaire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Userformationsec = ClassRegistry::init('Userformationsec');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userformationsec);

		parent::tearDown();
	}

}
