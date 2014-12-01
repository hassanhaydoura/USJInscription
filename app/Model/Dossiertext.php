<?php
App::uses('AppModel', 'Model');
/**
 * Dossiertext Model
 *
 * @property Formation $Formation
 */
class Dossiertext extends AppModel {


	
public function addDossiertext($dossierid,$attributid,$text)
   {
      $Dossiertext = $this->find('first',array('conditions' => array("dossier_id"=>$dossierid,"attribut_id"=>$attributid)));
    
    $param = array("Dossiertext"  =>array("dossier_id"=>$dossierid,"attribut_id"=>$attributid,"text"=>$text));
   
   $this->id = 	isset($Dossiertext['Dossiertext']['id']) ? $Dossiertext['Dossiertext']['id'] : 0;
   		
   
    if(!$this->exists())
              {
   					$this->create();
	   				$res=array();
			if (($res=$this->save($param)))
					{
		 			return $res;
					}
			}
		else
			  if (($res=$this->save($param))) 
					{
                	   $res['Dossiertext']['id']=$this->id;
                		return $res;
            		}	
        return false;
   
   }

}
  