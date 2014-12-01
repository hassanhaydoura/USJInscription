<?php
App::uses('AppModel', 'Model');
/**
 * Ecolessecondaire Model
 *
 * @property Userformationsec $Userformationsec
 */
class Ecolessecondaire extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
 public $virtualFields = array(
    'nomadress' => 'CONCAT(Ecolessecondaire.nom, " ", Ecolessecondaire.adresse)'
);
	public $validate = array(
		'nom' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
 
 public function addByNomAdresse($nom,$adresse)
	{
          	$param = array
          				(
   						 	"Ecolessecondaire"  => array("nom" => $nom, "adresse" => $adresse)
   						);
	$this->create();
		
		if ($this->save($param))
			{
				return $this->read();
			}
			 else 
			{
				return false;
			}
}
 
	
public function findEcoleByQuery($term)
{
      $results = $this->find('all', array('fields' => array('id','nom','adresse'),
          'conditions' => array('Ecolessecondaire.nom LIKE ' => $term. '%')
       ));
      $ecoles = Set::extract('../Ecolessecondaire', $results);           
       return json_encode($ecoles);   
}
 
 

 
// 	public $hasMany = array(
// 		'Userformationsec' => array(
// 			'className' => 'Userformationsec',
// 			'foreignKey' => 'ecolessecondaire_id',
// 			'dependent' => false,
// 			'conditions' => '',
// 			'fields' => '',
// 			'order' => '',
// 			'limit' => '',
// 			'offset' => '',
// 			'exclusive' => '',
// 			'finderQuery' => '',
// 			'counterQuery' => ''
// 		)
// 	);

}
