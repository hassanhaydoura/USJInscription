<?php
App::uses('AppModel', 'Model');
/**
 * Dossier Model
 *
 * @property User $User
 * @property Photo $Photo
 */
class Dossier extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
  

	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'activated' => array(
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
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CreatUser' => array(
			'className' => 'User',
			'foreignKey' => 'createdby',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

    public function nomDossier($dossierid)
    {
       $nom = ClassRegistry::init('Dossierattribut')->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'attribut_id'=>'5')));
       $prenom = ClassRegistry::init('Dossierattribut')->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'attribut_id'=>'6')));

    if(!empty($nom) && !empty($prenom))
       {
         if($nom['Dossierattribut']['valeur']!="" && $prenom['Dossierattribut']['valeur']!="")
           return $prenom['Dossierattribut']['valeur']." ".$nom['Dossierattribut']['valeur'];
        }
    
  		  return "Dossier ".$dossierid;
    }
   
   
//     public function missingFields($dossierid)
//       {
//         $attribut = ClassRegistry::init('Dossierattribut')->find('list',array('fields'=>array('attribut_id'),'conditions'=>array('dossier_id'=>$dossierid,'valeur !='=>'')));
//          $attObligatoir = ClassRegistry::init('Attribut')->find('list',array('fields'=>array('id'),'conditions'=>array('obligatoire'=>'1')));
//         $typeattribut = ClassRegistry::init('Attribut')->find('list',array('fields'=>array('id','type'),'conditions'=>array('obligatoire'=>'1')));
//          $differences =array_diff($attObligatoir,$attribut);  
//         $missing=array();
//         echo "<br>";
//                   print_r($differences);
// 
//         foreach($differences as $difference)
//         {
//           $type=$typeattribut[$difference];
//          switch($type)
//           {
//               case "filenote":
//               unset($differences[$difference]);
//                break;
//                default:
//                 break;
//         }  
//         }
//         print_r($differences);
//         exit;
//         if(!empty($difference))
//            {  
// 			 $missing['Attribut'] =$differences;        
//     	   }
//     	  
//     	    
// 
//         $formationsec = ClassRegistry::init('Formationsecondaires')->find('list',array('fields'=>array('id')));
//         $formationsecdossier = ClassRegistry::init('Dossierformationsec')->find('list',array('fields'=>array('formationsecondaire_id'),'conditions'=>array('dossier_id'=>$dossierid)));
//         $differences =array_diff($formationsec,$formationsecdossier);  
//         if(!empty($difference))
//            $missing['Formationsecondaire']=$differences; 
//         
//         $formation = ClassRegistry::init('Dossierformation')->find('list',array('fields'=>array('id'),'conditions'=>array('dossier_id'=>$dossierid)));
// 
//         if(empty($formation))
//           $missing['Formation']='1' ;
//               print_r($missing);
// 		return $missing;
//       }

//     public function completEnPourcent($dossierid)
//       {
//       $obligatoir = 0;
//       $reste = 0;
// 
//          $attribut = ClassRegistry::init('Dossierattribut')->find('list',array('fields'=>array('attribut_id'),'conditions'=>array('dossier_id'=>$dossierid,'valeur !='=>'')));
//          $attObligatoir = ClassRegistry::init('Attribut')->find('list',array('fields'=>array('id'),'conditions'=>array('obligatoire'=>'1')));
//  
//          $difference =array_diff($attObligatoir,$attribut);  
//  
//   $obligatoir += count($attObligatoir);
//   $reste += count($difference);
// 
//    
//         $formationsec = ClassRegistry::init('Formationsecondaires')->find('list',array('fields'=>array('id')));
//         $formationsecdossier = ClassRegistry::init('Dossierformationsec')->find('list',array('fields'=>array('formationsecondaire_id'),'conditions'=>array('dossier_id'=>$dossierid)));
//         $difference =array_diff($formationsec,$formationsecdossier);  
// 
// 	$obligatoir +=count($formationsec);
// 	$reste +=count($difference);
//  
//         
//         $formation = ClassRegistry::init('Dossierformation')->find('list',array('fields'=>array('id'),'conditions'=>array('dossier_id'=>$dossierid)));
//         $obligatoir+=1;   
// 
//         if(empty($formation))
//             {
//             	$reste+=1;
//         	}	
// 		$pourcent=(1 - $reste/$obligatoir)*100;
// 		return $pourcent;
// }
//    
//     public function estComplet($dossierid)
//       {
// 
//          $attribut = ClassRegistry::init('Dossierattribut')->find('list',array('fields'=>array('attribut_id'),'conditions'=>array('dossier_id'=>$dossierid,'valeur !='=>'')));
//          $attObligatoir = ClassRegistry::init('Attribut')->find('list',array('fields'=>array('id'),'conditions'=>array('obligatoire'=>'1')));
//  
//          $difference =array_diff($attObligatoir,$attribut);  
//     
//         if(!empty($difference))
//            {  
//              return false;
//     	   }
// 
//         $formationsec = ClassRegistry::init('Formationsecondaires')->find('list',array('fields'=>array('id')));
//         $formationsecdossier = ClassRegistry::init('Dossierformationsec')->find('list',array('fields'=>array('formationsecondaire_id'),'conditions'=>array('dossier_id'=>$dossierid)));
//         $difference =array_diff($formationsec,$formationsecdossier);  
//         if(!empty($difference))
//           {
//             return false;
//           }
// 
//        $formation = ClassRegistry::init('Dossierformation')->find('list',array('fields'=>array('id'),'conditions'=>array('dossier_id'=>$dossierid)));
// 
//         if(empty($formation))
//             {
//             	return false;
//         	}	
// 		return true;
//       }
   
   	public function invalider($dossier) 
	{
	// echo $dossier." ".$user;
	// echo  $this->field('id', array('id' => $dossier, 'user_id' => $user));
      return $this->saveField('valide','0');
	}
	public function isOwnedBy($dossier, $user) 
	{
	// echo $dossier." ".$user;
	// echo  $this->field('id', array('id' => $dossier, 'user_id' => $user));
      return $this->field('id', array('id' => $dossier, 'user_id' => $user)) === $dossier;
	}

	
}
