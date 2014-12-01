<?php
App::uses('Formationsecondaire', 'Model');

/**
 * Formationsecondaire Test Case
 *
 */
class FormationsecondaireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.formationsecondaire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Formationsecondaire = ClassRegistry::init('Formationsecondaire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Formationsecondaire);

		parent::tearDown();
	}

}
