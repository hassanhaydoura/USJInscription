<?php
App::uses('AppModel', 'Model');
/**
 * Userformationsec Model
 *
 * @property User $User
 * @property Ecolessecondaire $Ecolessecondaire
 * @property Formationsecondaire $Formationsecondaire
 */
class Dossierformationsec extends AppModel {

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
		'ecolessecondaire_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'formationsecondaire_id' => array(
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

public function addOrUpdateByDOssierFormationEcole($dossierid,$formationsecid,$ecoleid)
   {
           $this->recursive =-1;
      $dosatt = $this->find('first',array('conditions' => array('Dossierformationsec.dossier_id' => $dossierid,'Dossierformationsec.formationsecondaire_id' => $formationsecid)));
              $param = array (
   								 "Dossierformationsec"  => array("dossier_id" => $dossierid, "formationsecondaire_id" => $formationsecid,"ecolessecondaire_id"=>$ecoleid)
   					);
   				
   				$this->id = 	isset($dosatt['Dossierformationsec']['id']) ? $dosatt['Dossierformationsec']['id'] : 0;
   					
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
   

 public function removeByDossierFormationsec($dossierid,$formationsecid)
   {
     $this->recursive =-1;
      $dosatt = $this->find('first',array('conditions' => array('Dossierformationsec.dossier_id' => $dossierid,'Dossierformationsec.formationsecondaire_id' => $formationsecid)));
              
   				$this->id = isset($dosatt['Dossierformationsec']['id']) ? $dosatt['Dossierformationsec']['id'] : 0;
   					
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
		'Ecolessecondaire' => array(
			'className' => 'Ecolessecondaire',
			'foreignKey' => 'ecolessecondaire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Formationsecondaire' => array(
			'className' => 'Formationsecondaire',
			'foreignKey' => 'formationsecondaire_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
