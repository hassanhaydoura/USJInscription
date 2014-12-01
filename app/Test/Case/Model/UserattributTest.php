<?php
App::uses('Userattribut', 'Model');

/**
 * Userattribut Test Case
 *
 */
class UserattributTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.userattribut',
		'app.user',
		'app.attribut',
		'app.section',
		'app.listattribut'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Userattribut = ClassRegistry::init('Userattribut');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Userattribut);

		parent::tearDown();
	}

}
