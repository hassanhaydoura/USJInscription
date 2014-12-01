<?php
App::uses('AppModel', 'Model');
/**
 * Userattribut Model
 *
 * @property User $User
 * @property Attribut $Attribut
 */
class Dossierattribut extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'dossier_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'attribut_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'valeur' => array(
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


public function addOrUpdateByDossierAttributValeur($dossierid,$attributid,$valeur)
   {
           $this->recursive =-1;
      $dosatt = $this->find('first',array('conditions' => array('Dossierattribut.dossier_id' => $dossierid,'Dossierattribut.attribut_id' => $attributid)));
              $param = array (
   								 "Dossierattribut"  => array("dossier_id" => $dossierid, "attribut_id" => $attributid,"valeur"=>$valeur)
   					);
   				
   				$this->id = 	isset($dosatt['Dossierattribut']['id']) ? $dosatt['Dossierattribut']['id'] : 0;
   					
        if(!$this->exists())
              {
   					$this->create();
	   				$res=array();
			if ($this->save($param))
					{
		 			return true;
					}
			}
		else
			  if ($this->save($param)) 
					{
                		return true;
            		}	
        return false;
}
 
 
  
 
 public function removeByDossierAttribut($dossierid,$attributid)
   {
     $this->recursive =-1;
      $dosatt = $this->find('first',array('conditions' => array('Dossierattribut.dossier_id' => $dossierid,'Dossierattribut.attribut_id' => $attributid)));
              $param = array (
   								 "Dossierattribut"  => array("dossier_id" => $dossierid, "attribut_id" => $attributid)
   					);
   				
   				$this->id = 	isset($dosatt['Dossierattribut']['id']) ? $dosatt['Dossierattribut']['id'] : 0;
   					
        if(!$this->exists())
              {
   					 return false;
			}
		else
			{
			  if ($this->delete()) 
					{
                		return true;
            		}	
         	}
        return false;
   }  

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Dossier' => array(
			'className' => 'Dossier',
			'foreignKey' => 'dossier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Attribut' => array(
			'className' => 'Attribut',
			'foreignKey' => 'attribut_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
