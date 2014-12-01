<?php
App::uses('AppModel', 'Model');
/**
 * Userformation Model
 *
 * @property User $User
 * @property Formation $Formation
 */
class Dossierformation extends AppModel {

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
		'formation_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'priorite' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
 * belongsTo associations
 *
 * @var array
 */
 
 public function addOrUpdateByDossierFormationPriorite($dossierid,$formationid,$priorite)
   {
           $this->recursive =-1;
    
          $dosatt = $this->find('first',array('conditions' => array('Dossierformation.dossier_id' => $dossierid,'Dossierformation.formation_id' => $formationid)));
              $param = array (
   								 "Dossierformation"  => array("dossier_id" => $dossierid, "formation_id" => $formationid,"priorite"=>$priorite)
   					);
   				
   				$this->id = 	isset($dosatt['Dossierformation']['id']) ? $dosatt['Dossierformation']['id'] : 0;
   					
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
   
 
    public function removeByDossierFormation($dossierid,$formationid)
  	 {
           $this->recursive =-1;
    
          $dosatt = $this->find('first',array('conditions' => array('Dossierformation.dossier_id' => $dossierid,'Dossierformation.formation_id' => $formationid)));
              $param = array
              (
   				"Dossierformation"  => array("dossier_id" => $dossierid, "formation_id" => $formationid)
   			   );
   				
   		$this->id = 	isset($dosatt['Dossierformation']['id']) ? $dosatt['Dossierformation']['id'] : 0;
   					
        if(!$this->exists())
              {
   					return false;
			  }
		else
			  if ($this->delete()) 
					{
                		return true;
            		}	
        return false;
  		 }
 
	public $belongsTo = array(
		'Dossier' => array(
			'className' => 'Dossier',
			'foreignKey' => 'dossier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Formation' => array(
			'className' => 'Formation',
			'foreignKey' => 'formation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
