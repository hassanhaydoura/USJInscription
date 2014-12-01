<?php
App::uses('Ecolessecondaire', 'Model');

/**
 * Ecolessecondaire Test Case
 *
 */
class EcolessecondaireTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ecolessecondaire',
		'app.userformationsec',
		'app.user',
		'app.formationsecondaire'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ecolessecondaire = ClassRegistry::init('Ecolessecondaire');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ecolessecondaire);

		parent::tearDown();
	}

}
