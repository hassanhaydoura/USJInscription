<?php

App::uses('AppController', 'Controller');
/**
 * Dossiers Controller
 *
 * @property Dossier $Dossier
 * @property PaginatorComponent $Paginator
 */
class DossiersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Dossier->recursive = 0;
		$this->set('dossiers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Dossier->exists($id)) {
			throw new NotFoundException(__('Invalid dossier'));
		}
		$options = array('conditions' => array('Dossier.' . $this->Dossier->primaryKey => $id));
		$this->set('dossier', $this->Dossier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Dossier->create();
			if ($this->Dossier->save($this->request->data)) {
				$this->Session->setFlash(__('The dossier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dossier could not be saved. Please, try again.'));
			}
		}
		$users = $this->Dossier->User->find('list');
		$photos = $this->Dossier->Photo->find('list');
		$this->set(compact('users', 'photos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Dossier->exists($id)) {
			throw new NotFoundException(__('Invalid dossier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Dossier->save($this->request->data)) {
				$this->Session->setFlash(__('The dossier has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dossier could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Dossier.' . $this->Dossier->primaryKey => $id));
			$this->request->data = $this->Dossier->find('first', $options);
		}
		$users = $this->Dossier->User->find('list');
		$photos = $this->Dossier->Photo->find('list');
		$this->set(compact('users', 'photos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */


public function blancform()
{ 
 $this->loadModel('User');
  $this->loadModel('Section');
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Dossierformationsec');
  $this->loadModel('Formation');
  $this->loadModel('Fichier');
  $this->loadModel('Dossierformation');
  $this->loadModel('Dossierattribut');
    $this->loadModel('Attribut');
 $usr=$this->User->findById($this->Auth->user('id'));

 
 
  if($this->request->is("post") && !$this->getdossierid(false,false,0))
    {
       $this->loadModel('Attribut');
       $attobli=$this->Attribut->find('list',array('conditions'=>array('existinmain'=>'1')));
       $valeur=$this->request->data['Dossier'];
       $verifer=0;
       foreach($this->request->data as $key=>$val)
       {
        if(preg_match('/^formation\d/',$key) && preg_match('/^priorite\d/',$val))  
 	       {
 				 $verifer=1;
 				 break;
 	       }  
       }
       
       foreach($attobli as $key => $att)
 	   {
          if(isset($valeur['attribut'.$key]) && $valeur['attribut'.$key]!="")
             continue;
            else
              {
               $verifer=0;
               break;
              }
 	   }
       
 	
 	   
       if(!$verifer)
          {
           $this->Session->setFlash("Veuillez remplir les champs vides!");
           return $this->redirect(array("controller"=>"creerdossiers","action"=>"index"));  
          }
        $dossierid =$this->getdossierid(false,true,$usr['User']['id']);
       //$this->Session->write('dossier_id',$dossierid);
	}
  else
  $dossierid =$this->getdossierid();
// $this->Dossier->estComplet($dossierid);
//exit;
   //exit;
  $this->set('dossierid',$dossierid);
 
  $usr=$this->User->findById($this->Auth->user('id'));
  
  $this->set('userid',$usr['User']['id']);
  if($usr['Group']['name']=='Administrators'){
  		$this->set('isAdmin',1);
  }
  else{
  	$this->set('isAdmin',0);
  }
  
  if(!$this->Dossier->isOwnedBy($dossierid,$this->Auth->user('id')) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       $this->redirect(array('controller'=>'users','action' => 'profile'));
    }

// if (isset($_SESSION['newusername']) && isset($_SESSION['newpassword']))
//  {
//  //if($usr['Group']['name']== 'Administrators')
//    // $this->Session->setFlash('Username : '.$_SESSION['newusername'].'     Password : '.$_SESSION['newpassword']);	
// 	//$this->Session->Delete('newusername');
// 	//$this->Session->Delete('newpassword');
//  }
  
  $currDossier = $this->Dossier->findById($dossierid);


 if($currDossier['Dossier']['valide']>0 && !($usr['Group']['name']== 'Administrators') && isset($_GET['edit']))	
	{
	  $this->Session->setFlash('Le Dossier est Validé!');
	  return $this->redirect(array('controller'=>'dossiers','action' => 'blancform','?'=>array('dossierid'=>$dossierid)));
	}
	else
	{
	  $this->set('edit',isset($_GET['edit']));
	}
	
	 if($this->request->is('post'))
     	{

	if($currDossier['Dossier']['valide']>0 && !($usr['Group']['name']== 'Administrators'))	
	  {
 	  $this->Session->setFlash('Le Dossier est Validé!');
 	  return $this->redirect(array('controller'=>'dossiers','action' => 'blancform','?'=>array('dossierid'=>$dossierid)));
 	  }
	
			
  		if($usr['Group']['name']== 'Administrators' && $usr['User']['id']==$currDossier['Dossier']['user_id'])
  		{//admin  	
  		       $this->loadModel('Group');
				$newusername=uniqid($this->request->data['Dossier']['attribut5']);
	            $etudiantg = $this->Group->findByName('Etudiants');
				$d=array('username'=>$newusername,'password'=>'0000','firstname'=>$this->request->data['Dossier']['attribut6'],'lastname'=>$this->request->data['Dossier']['attribut5'],'group_id'=>$etudiantg['Group']['id'],'activated'=>1);
				$this->User->create();
				$saveduser=$this->User->save($d);
				$this->Dossier->id = $dossierid; 
				$this->Dossier->saveField('user_id', $saveduser['User']['id']);
				$pass=uniqid('');
				$this->User->id=$saveduser['User']['id'];
				$this->User->saveField('password', $pass);
				$this->Session->Write('newusername',$newusername);
				$this->Session->Write('newpassword',$pass);
				$this->Session->Write('newdossier',$dossierid);
		 } 

		$this->updateformationUSJ($this->request->data,$dossierid);
		$this->removeformationsec($this->request->data['Dossier'],$dossierid);//supprime les formations secondaires
     	$attributs= $this->removeEmptyAttribute($this->request->data["Dossier"],$dossierid);// tous les attributs avec avec valeur vide sont supprime
			       
 	     //attribut et formation secondaire
 	     foreach($attributs as $key => $att)
 	   {
 	   if (preg_match('/^attribut\d/',$key))
 	    {
 	       $this->updateattribut($dossierid,preg_replace('/^attribut/', '', $key),$att);
 	    }
 	    else
 	       if( ($isEcoleNom=preg_match('/^formationsececolnom\d/',$key)) || preg_match('/^formationsecadress\d/',$key) )
 	    {

 	  	 if($isEcoleNom)
 	  	 {
 	  	  $formationid=preg_replace('/^formationsececolnom/','', $key);
 	  	  $this->updateformationsecondaire($key,$att,$attributs['formationsecadress'.$formationid],$dossierid,$formationid,$isEcoleNom);
 	  	 }
 	  	}
 	  	else if(preg_match('/^contacterecol\d/',$key))
 	  			{
 	  			  $attributid=preg_replace('/^contacterecol/','', $key);
 	  			  $formation = $this->Formationsecondaire->find('first',array('conditions'=>array('attribut_id'=>$attributid)));  
 		     	   $this->setContacteEcole($dossierid,$formation['Formationsecondaire']['id'],$this->request->data["Dossier"]['contacterecol'.$attributid]);
 	  			}
 	   }
			// if(isset($this->data['Dossier']['image']) && $this->data['Dossier']['image']['name'])
// 			{
// 				if (!file_exists('files/'.$dossierid))
//     		 		{
//    					   mkdir('files/'.$dossierid, 0777, true);
//  					}
//  			
//  			$path = $this->data['Dossier']['image']['name'];
// 			$ext = pathinfo($path, PATHINFO_EXTENSION);
// 			if($ext)
// 			{
// 			 $ext='.'.$ext;
// 			}
//  			if(strcasecmp($ext,'png') || strcasecmp($ext,'jpg') )
//  			{
// 			 $this->loadModel('Photo');
// 			
// 			if($currDossier['Dossier']['photo_id'])
//  	           ////////////////////////////////////////////////////////////////////////
// 			{
// 			 $photo = $this->Photo->read(null, $currDossier['Dossier']['photo_id']);
// 			  
// 			unlink('files/'.$dossierid.'/'.$photo['Photo']['nom']);
// 			  move_uploaded_file($this->data['Dossier']['image']['tmp_name'],'files/'.$dossierid.'/'.'pic'.$ext);
// 			  $this->Photo->id = $currDossier['Dossier']['photo_id'];
//   			  $this->Photo->saveField('nom', 'pic'.$ext);
//   			   
//  			 }
//  			 else
//  			 {
//  			 move_uploaded_file($this->data['Dossier']['image']['tmp_name'],'files/'.$dossierid.'/'.'pic'.$ext);
//  			     App::import('Controller', 'Photos');
//  					$photo = new PhotosController;
//  					$resLogo = $photo->SaveByNomFichier('pic'.$ext);
//  					
//   				 $this->Dossier->id = $dossierid;
//   				 $this->Dossier->saveField('photo_id', $this->Photo->getLastInsertID());
//  			 }
//  			
//  			}
//  			else
//  			{
//  			  $this->Session->setFlash(__('JPG et PNG seulement'));
//  			}
//  			
// 			}
 	    return $this->redirect(array('action' =>$this->request->data['redirectionpage']));

     	}
    else	
		{

 		  $this->setsections();
          $this->Dossierformationsec->recursive=0;
  		  $this->Dossierformation->recursive=2;
		  

          $this->set('formationsecdejaexist',$this->Dossierformationsec->find('all',array('conditions'=>array('Dossierformationsec.dossier_id'=>$dossierid))));
  		  
  		  $this->set('formationdejaexist',($formationdejaexist=$this->Dossierformation->find('all',array('conditions'=>array('Dossierformation.dossier_id'=>$dossierid)))));
  		  $this->set('formations',$this->Formation->find('all', array(
 															  'conditions' => array(
 																'NOT' =>  array( 
      'Formation.id' => $this->getformationkeys($formationdejaexist)
 																					)))));
		$this->Dossierattribut->recursive=-1;
		$this->Dossier->recursive=-1;
		$this->set('dossier',$this->Dossier->findById($dossierid));
		
		$attributs=$this->Dossierattribut->find('all',array('fields'=>'valeur,attribut_id','conditions'=>array('Dossierattribut.dossier_id'=>$dossierid)));
		$fichiers= $this->Fichier->find('all',array('conditions'=>array('Fichier.dossier_id'=>$dossierid)));
		$this->set('fichiers',$fichiers);
		
		if(isset($_GET['valider']) || $usr['Group']['name']== 'Administrators')
		    {
		      $missing=$this->missingFields($dossierid);	
    		  if(isset($_GET['valider']))
    		     $this->set('missing',$missing);
             if($usr['Group']['name']== 'Administrators')
    		  $this->set('dossiercomplet',empty($missing));
		    }
 
foreach($attributs as $att)
{
//print_r($att);
$this->request->data["Dossier"]['attribut'.$att['Dossierattribut']['attribut_id']]=$att['Dossierattribut']['valeur'];
}

//set contacter ecole fields
$this->Formationsecondaire->recursive=-1;
$formationsecs = $this->Formationsecondaire->find('all');
foreach($formationsecs as $formationsec)
{
   $fid=$formationsec['Formationsecondaire']['id'];
   $aid=$formationsec['Formationsecondaire']['attribut_id'];
   $dossierformation= $this->Dossierformationsec->find('first',array('conditions'=>array('formationsecondaire_id'=>$fid,'dossier_id'=>$dossierid)));
   if(!empty($dossierformation))
   $this->request->data["Dossier"]['contacterecol'.$aid]=$dossierformation['Dossierformationsec']['contacteecole'];
   
   
}

}

}



public function getLevel($dossierid)
{
  $this->loadModel("Level");
   $levels=$this->Level->find('all');
   $totale=0;
   $completer=0;
   $currentlevel=NULL;
usort($levels, function($a, $b)//odre decroissant
	   {        
        	return $a['Level']['ordre'] > $b['Level']['ordre'] ? -1 : 1;
       });
   foreach($levels as $level)
   {
    foreach($level['Attribut'] as $attribut)
    {
      switch($attribut['type'])
      {
         case "choixcursus":
        $res=$this->checkCursus($dossierid,0);
        ++$totale;
             if($res)
              {
                  ++$completer;
              }
              else
              {
                		$currentlevel= $level['Level'];
              }
              break;  
         case "file":
          ++$totale;
$res=$this->checkFile($dossierid,$attribut['id']);
       if($res)
		      {
                  ++$completer;
              }
                 else
              {
                		$currentlevel= $level['Level'];
              }
              break;  
         case "filenote":
          	   	++$totale;
        	    $res=$this->checkNote($dossierid,$attribut['id']);
        	    if($res)
              {
                  ++$completer;
              }  
               else
              {
                 $currentlevel= $level['Level'];
              }
              break; 
              case "choixformationsecondaire":
               $this->loadModel('Formationsecondaire');
                $formationsecs=$this->Formationsecondaire->find('all');
                foreach($formationsecs as $formationsec)
                 { 
                	++$totale;
                 $res=$this->checkFormationsecondaire($dossierid,$formationsec['Formationsecondaire']['id']);
                   if($res)
                 {
                   ++$completer;
                  }
                     else
              {
                    $currentlevel= $level['Level'];
              }
            } 
              break;
         default:
        		$res=$this->checkAttribut($dossierid,$attribut['id']);
        		 ++$totale;
                if($res)
              {
                ++$completer;
              }
                 else
              {
             		$currentlevel= $level['Level'];
              }
              break;
      }
    }
}
  if($currentlevel)
  {
   $this->Level->id=$currentlevel['id'];
   $this->Level->read();
    $nom=$this->Level->data['Level']['nom'];
   }
   else
   {
       $nom= "Dossier Complet";

   }
   $res =array('level'=>$nom,'progres'=>($completer/$totale)*100);

return $res;
 //  print_r($currentlevel);
}


public function missingFields($dossierid)
      { 
         $this->loadModel('Dossierattribut');
         $this->loadModel('Attribut');
         
        $attribut = $this->Dossierattribut->find('list',array('fields'=>array('attribut_id'),'conditions'=>array('dossier_id'=>$dossierid,'valeur !='=>'')));
        $attObligatoir =$this->Attribut->find('list',array('fields'=>array('id'),'conditions'=>array('obligatoire'=>'1')));
        $typeattribut = $this->Attribut->find('list',array('fields'=>array('id','type'),'conditions'=>array('obligatoire'=>'1')));
        $differences =array_diff($attObligatoir,$attribut);  
        $missing=array();
$completer=0;
$totale=count($attObligatoir);
    
        foreach($differences as $difference)
     {
          $type=$typeattribut[$difference];
         switch($type)
          {
              case "filenote":
              if($this->checkNote($dossierid,$difference))
                  {
                  unset($differences[$difference]);
                  ++$completer;
                  }
               break;
              case "file":
                 if($this->checkFile($dossierid,$difference))
                  {
                   unset($differences[$difference]);
                   ++$completer;
                  }
                  break;
              case "choixcursus":
                 if($this->checkCursus($dossierid,$difference))
    				{
                        unset($differences[$difference]);
					    ++$completer;
					}
				  break;
			 case "choixformationsecondaire":
			     $totale=$totale-1;
			 		unset($differences[$difference]);
			 		$this->loadModel('Formationsecondaire');
			        $formationsecs = $this->Formationsecondaire->find('all',array('fields'=>array('id')));
                    foreach($formationsecs as $formationsec)
                    {
                     ++$totale;
                if(!$this->checkFormationsecondaire($dossierid,$formationsec['Formationsecondaire']['id']))
                      $missing['Formationsecondaire'][$formationsec['Formationsecondaire']['id']]=$formationsec['Formationsecondaire']['id'];
                    else
                       ++$completer;
                    }
			   break;
               default:
                break;
        }  
        }
    //    print_r($differences);
  //      exit;

 //   echo "<br> missing fields";
//    echo "<br>total = ".$totale;
//    echo "<br>comlete = ".$completer;
//    exit;

        if(!empty($differences))
           {  
			 $missing['Attribut'] =$differences;
			 $completer= $completer + ($totale-count($differences));
    	   }
    	  
    	    
//      $formationsec = ClassRegistry::init('Formationsecondaires')->find('list',array('fields'=>array('id')));
//         $formationsecdossier = ClassRegistry::init('Dossierformationsec')->find('list',array('fields'=>array('formationsecondaire_id'),'conditions'=>array('dossier_id'=>$dossierid)));
//         $differences =array_diff($formationsec,$formationsecdossier);  
//         if(!empty($difference))
//            $missing['Formationsecondaire']=$differences; 

//         $formation = ClassRegistry::init('Dossierformation')->find('list',array('fields'=>array('id'),'conditions'=>array('dossier_id'=>$dossierid)));
// 
//         if(empty($formation))
//           $missing['Formation']='1' ;
		return $missing;
      }



private function checkAttribut($dossierid,$attributid)
{
  $this->loadModel("Dossierattribut");
  $res=$this->Dossierattribut->find("first",array("conditions"=>array("attribut_id"=>$attributid,"dossier_id"=>$dossierid,"valeur !="=>"")));
  if(empty($res))
    return false;
  else
      return true;
}

private function checkFile($dossierid,$attributid)
{
  $this->loadModel("Fichier");
  $res=$this->Fichier->find("first",array("conditions"=>array("attribut_id"=>$attributid,"dossier_id"=>$dossierid)));
  if(empty($res))
    return false;
  else
      return true;
}

private function checkNote($dossierid,$attributid)
{
$this->loadModel("Formationsecondaire");
$this->loadModel("Dossierformationsec");
 $formation=$this->Formationsecondaire->find('first',array("conditions"=>array("attribut_id"=>$attributid)));
 $formationid=$formation['Formationsecondaire']['id'];
 $formationsec=$this->Dossierformationsec->find('first',array("conditions"=>array("formationsecondaire_id"=>$formationid,"dossier_id"=>$dossierid)));
  
 if(isset($formationsec["Dossierformationsec"]["contacteecole"]) && $formationsec["Dossierformationsec"]["contacteecole"])
 {
   return true;
 }
 else
   {  
      return $this->checkFile($dossierid,$attributid);
   } 



}

private function checkCursus($dossierid,$v=NULL)
{
$this->loadModel("Dossierformation");
$formations=$this->Dossierformation->find('first',array('conditions'=>array('dossier_id'=>$dossierid)));
if(empty($formations))
   return false;
else
 return true;

}

private function checkFormationsecondaire($dossierid,$formationid)
{
   $this->loadModel('Formationsecondaire');
      $this->loadModel('Dossierformationsec');

    $dossierformation = $this->Dossierformationsec->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'formationsecondaire_id'=>$formationid)));
    if(empty($dossierformation))
       { 
                return false;
        } 
 return true;
}
private function removeformationsec($array,$dossierid)//supprime les formations secondaires
{
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Dossierformationsec'); 
  $formationssecs= $this->Formationsecondaire->find('list');
  foreach($formationssecs as $key=>$formationsec)
  {
   if(isset($array['formationsececolnom'.$key]) && isset($array['formationsecadress'.$key]))
     if($array['formationsececolnom'.$key]=='' || $array['formationsecadress'.$key]=='')
        $this->Dossierformationsec->removeByDossierFormationsec($dossierid,$key);
  }
}
private function updateformationsecondaire($key,$valeur,$address,$dossierid,$formationid,$isEcoleNom)//isEcoleNom pour savoir si traite l'adresse de l'ecole ou le nom pour ne pas appler preg_match deux fois
{
if($isEcoleNom)
 	    {
 	  	   $ecolid=0;
 	  	   $ecolenom=$valeur;
 	  	   $this->loadModel('Ecolessecondaire');
 	  	            $this->Ecolessecondaire->recursive=-1;
 	  	  $ecole= $this->Ecolessecondaire->find('first',array('conditions'=>array('nom'=>$ecolenom,'adresse'=>$address)));
 	  	 if(empty($ecole))
 	  	 {
 	  	   $ecole = $this->Ecolessecondaire->addByNomAdresse($ecolenom,$address);
 	  	   $ecolid= $ecole['Ecolessecondaire']['id'];
 	  	 }
 	  	 else
 	  	 {
 	  	   $ecolid = $ecole['Ecolessecondaire']['id'];
 	  	 }
 	  	 	
 	  	 	$this->Dossierformationsec->addOrUpdateByDossierFormationEcole($dossierid,$formationid,$ecolid);//changer le nom de la fonction
 	    }
 	    else if(preg_match('/^formationsecadress\d/',$key))
 	    {
 	     return;
 	    }
}
private function updateattribut($dossierid,$attributid,$valeur)
{
$this->loadModel('Dossierattribut');
$this->Dossierattribut->addOrUpdateByDossierAttributValeur($dossierid,$attributid,$valeur);
}
private function updateformationUSJ($array,$dossierid)
{
        	$formationkeys = array();
     	foreach(array_keys($array) as $key)
     	{
     	  if(preg_match('/^formation\d/',$key))  
 	       {
 				array_push($formationkeys,preg_replace('/^formation/', '', $key));	
 	       }
     	}

 		$difference = array_diff($this->Dossierformation->find('list',array('fields'=>'formation_id','conditions'=>array('dossier_id'=>$dossierid))),$formationkeys);
 		
     	foreach($difference as $formationid)
     	{
     	  $this->Dossierformation->removeByDossierFormation($dossierid,$formationid);//
     	}
     	
	
     	foreach(array_keys($array) as $key)
     	{
     	  if(preg_match('/^formation\d/',$key))  
 	    	{
 				$formationid = preg_replace('/^formation/', '', $key);
 				$this->Dossierformation->addOrUpdateByDossierFormationPriorite
 					($dossierid,$formationid,preg_replace('/^priorite/', '', $array['formation'.$formationid]));	//mise a jour du priorite d'un formation	
 	       }
     	}


}
private function setContacteEcole($dossierid,$formationsecid,$valeur)
{
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Dossierformationsec'); 
  $formationssecs= $this->Formationsecondaire->find('list');
  $dossieroformsec=$this->Dossierformationsec->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'formationsecondaire_id'=>$formationsecid)));
  if(!empty($dossieroformsec))
  {
  $this->Dossierformationsec->id=$dossieroformsec['Dossierformationsec']['id'];
  $this->Dossierformationsec->saveField('contacteecole',$valeur);
  }
}

private function setsections()
{
         $this->loadModel('Sectiongroup');
          $this->loadModel('Formationsecondaire');
          $this->loadModel('Formation');
  		  $this->set('sectionid',isset($_GET['section'])?$_GET['section']:"all");
		  $this->Sectiongroup->recursive=3;
  		  $this->set('gsections',$this->Sectiongroup->find('all',array('conditions'=>array('existindossier'=>1))));///////////////////////////
  		  $this->Sectiongroup->recursive=1;
  		  $this->Formationsecondaire->recursive=-1;
 		  $this->Formation->recursive=1;
 		  $this->set('formationsecs',$this->Formationsecondaire->find('all'));
 		  $this->set('formations',$this->Formation->find('all'));
 		    
}

public function viewinfo()
{ 
  $this->loadModel('User');

  $usr=$this->User->findById($this->Auth->user('id'));
$dossierid =$this->getdossierid();
  
    if(!$this->Dossier->isOwnedBy($dossierid,$usr) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       	$this->redirect(array('controller'=>'users','action' => 'profile'));
       	
    }
 
  $this->loadModel('Section');
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Dossierformationsec');
  $this->loadModel('Formation');
  $this->loadModel('Dossierformation');
  $this->loadModel('Dossierattribut');
  $this->Section->recursive=2;
		  
		  $this->set('sections',$this->Section->find('all'));
 		  $this->set('dossierid',$dossierid);

 			
 
  		  $this->Section->recursive=1;
 
          $this->Dossierformationsec->recursive=0;
  		  $this->Dossierformation->recursive=2;
 		  $this->Formationsecondaire->recursive=-1;
 		  $this->Formation->recursive=1;

          $this->set('formationsecdejaexist',$this->Dossierformationsec->find('all',array('conditions'=>array('Dossierformationsec.dossier_id'=>$dossierid))));
  		  $this->set('formationsecs',$this->Formationsecondaire->find('all'));
  		  $this->set('formationdejaexist',($formationdejaexist=$this->Dossierformation->find('all',array('conditions'=>array('Dossierformation.dossier_id'=>$dossierid)))));
  		  $this->set('formations',$this->Formation->find('all', array(
 															  'conditions' => array(
 																'NOT' =>  array( 
      'Formation.id' => $this->getformationkeys($formationdejaexist)
 																					)))));
		
	  $this->Dossierattribut->recursive=2;
		$attributs=$this->Dossierattribut->find('all',array('fields'=>'valeur,attribut_id','conditions'=>array('Dossierattribut.dossier_id'=>$dossierid)));
		     $this->loadModel('Listattribut');

	foreach($attributs as $att)
		{
		  if($att['Attribut']['type']=='liste')
		   {
		    $listattribut = $this->Listattribut->findById($att['Dossierattribut']['valeur']);
		    $this->request->data['attribut'.$att['Dossierattribut']['attribut_id']]=$listattribut['Listattribut']['valeur'];
		   }
		   if($att['Attribut']['type']=='filenote')
		   {
		    $formation = $this->Formationsecondaire->find('first',array("conditions"=>array("attribut_id"=>	$att['Attribut']['id'])));
		    $dossierformation = $this->Dossierformationsec->find('first',array("conditions"=>array("dossier_id"=>$dossierid,"formationsecondaire_id"=>$formation['Formationsecondaire']['id'])));
		    echo $att['Dossierattribut']['attribut_id'];
		    $this->request->data['attribut'.$att['Dossierattribut']['attribut_id']]['contacterecole']=$dossierformation['Dossierformationsec']['contacteecole'];
		   }
			else
			$this->request->data['attribut'.$att['Dossierattribut']['attribut_id']]=$att['Dossierattribut']['valeur'];
		}

}




public function delete($id = null) {
$this->loadModel('User');
 $usr= $this->User->findById($this->Auth->user('id'));
  if(!$this->Dossier->isOwnedBy($id,$usr['User']['id']) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       $this->redirect(array('controller'=>'users','action' => 'profile'));
    }
		$this->Dossier->id = $id;
		$this->request->onlyAllow('post');
		if ($this->Dossier->exists())
		{   
		       $this->loadModel('Dossierattribut');
			   $this->loadModel('Dossierformation');
				$this->loadModel('Dossierformationsec');
				$this->loadModel('Dossiertext');
				$this->loadModel('Dossiercode');
				$this->loadModel('Fichier');

    $this->Dossierattribut->deleteAll(array('dossier_id'=>$id));
    $this->Dossierformation->deleteAll(array('dossier_id'=>$id));
    $this->Dossierformationsec->deleteAll(array('dossier_id'=>$id));
    $this->Dossiertext->deleteAll(array('dossier_id'=>$id));
    $this->Dossiercode->deleteAll(array('dossier_id'=>$id));
    $this->Fichier->deleteAll(array('dossier_id'=>$id),false,true);
 		   	if($this->Dossier->delete())
            	{
				$this->Session->setFlash(__('Le dossier est supprimé.'));
		     	}
				 else
		 		{
					$this->Session->setFlash(__('Le dossier n\'est pas supprimé.'));
		 		}
}
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
}



public function invalider($id = null) {
$this->loadModel('User');
 $usr= $this->User->findById($this->Auth->user('id'));
  if(!($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       $this->redirect(array('controller'=>'users','action' => 'profile'));
    }
		$this->Dossier->id = $id;
		$this->request->onlyAllow('post');
		if ($this->Dossier->invalider($id)) {
			$this->Session->setFlash(__('Le dossier est invalidé.'));
		} else {
			$this->Session->setFlash(__('Le dossier n\'est pas invalidé.'));
		}
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
}



function removeEmptyAttribute($array,$dossierid)
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = $this->removeEmptyAttribute($array[$key]);
        }

        if (empty($array[$key]))
        {
          if(preg_match('/^attribut\d/',$key))
          {          
        	$this->Dossierattribut->removeByDossierAttribut($dossierid,preg_replace('/^attribut/', '', $key));
            unset($array[$key]);
          }
        }
    }

    return $array;
}
 
 private function getdossierid($redirect=true,$createnew=false,$userid=0)
 {
//  revoir le probleme
  if($createnew)
  {
    $this->loadModel('User');
    $usr = $this->User->findById($userid);

if(empty($usr))
 return 0;
 if(!$usr['User']['activated'])
      {
          $this->Session->setFlash('Veuillez confirmer votre mail!');
          return $this->redirect(array('controller'=>'users','action' => 'profile'));
	  }
	 $count=$this->Dossier->find('count',array('conditions'=>array('user_id'=>$userid)));

	 if($count>=$usr['Group']['maxDossier'] && $usr['Group']['maxDossier'] !=0)
	 {
	    $this->Session->setFlash('Vous avez atteint le nombre maximum de dossiers!');
        return $this->redirect(array('controller'=>'users','action' => 'profile'));
	 }
  
    $data=array('user_id'=>$userid,'createdby'=>$userid);	
	    $this->Dossier->create();
	    $tmp=$this->Dossier->save($data);
	    return $tmp['Dossier']['id'];
  }
 
 $dossierid =isset($_GET['dossierid'])?$_GET['dossierid']:NULL;
 if(!$dossierid)
 {
 	 if($this->Session->read('dossier_id')!="")
		{
		 $this->Dossier->id=$this->Session->read('dossier_id');
		if($this->Dossier->exists())
		 return $this->Session->read('dossier_id');
		// $this->Session->delete('dossier_id'); //manage session var
		}
			else
		{
		  if($redirect)
	     	$this->redirect(array('controller'=>'users','action' => 'profile'));	
	       
		}	
		
 }
 else
 {
   $this->Dossier->id=$dossierid;
	if($this->Dossier->exists()) 
 	   return $dossierid;	
}
  if($redirect)
   $this->redirect(array('controller'=>'users','action' => 'profile'));
   else
    return false;
}

public function pdf()
{
$dossierid=$this->getdossierid();

  $this->loadModel('Dossierattribut');
  $this->loadModel('Attribut');
	$this->loadModel('Dossierformationsec');
	$this->loadModel('Dossierformation');

  $this->Attribut->recursive=-1;
    $this->Dossierattribut->recursive=-1;

  $this->Dossierformation->recursive=-1;
  $listattribut = $this->Attribut->find('list',array('conditions'=>array('Attribut.Type'=>'liste')));
  //print_r($listattribut);
 $attributs = $this->Dossierattribut->find('all',array('conditions'=>array('Dossierattribut.dossier_id'=>$dossierid)));
 $Dossierformationsec = $this->Dossierformationsec->find('all',array('conditions'=>array('Dossierformationsec.dossier_id'=>$dossierid)));
  $dossierformations = $this->Dossierformation->find('all',array('conditions'=>array('Dossierformation.dossier_id'=>$dossierid)));

$fdf = '%FDF-1.2
1 0 obj<</FDF<< /Fields[';
foreach($attributs as $att)
{
if(!isset($listattribut[$att['Dossierattribut']['attribut_id']]))
 $fdf=$fdf.'<</T(attribut'.$att['Dossierattribut']['attribut_id'].')/V('.$att['Dossierattribut']['valeur'].')>>';
else
 $fdf=$fdf.'<</T(liste'.$att['Dossierattribut']['valeur'].')/V(true)>>';
}
  foreach($Dossierformationsec as $formation)////////////////////
{
  $formationid = $formation['Dossierformationsec']['formationsecondaire_id'];
  $ecolnom = $formation['Ecolessecondaire']['nom'];
  $ecoladresse = $formation['Ecolessecondaire']['adresse'];

  $fdf=$fdf.'<</T(adresseformation'.$formationid.')/V('.$ecoladresse.')>>';
  $fdf=$fdf.'<</T(ecoleformation'.$formationid.')/V('.$ecolnom.')>>';
}

foreach($dossierformations as $form)
{
 $fdf=$fdf.'<</T(formation'.$form['Dossierformation']['formation_id'].')/V('.$form['Dossierformation']['priorite'].')>>';
}

$fdf=$fdf.'] >> >>
endobj
trailer
<</Root 1 0 R>>
%%EOF';
$dir= $dossierid;

	if (!file_exists('files/'.$dossierid))
    		 		{
   					   mkdir('files/'.$dossierid, 0777, true);
 					}

    file_put_contents('files/'.$dir.'/dossier.fdf', $fdf);
exec("/opt/pdflabs/pdftk/bin/pdftk "."dossadm14form.pdf "." fill_form files/".$dir.'/dossier.fdf'." output dossier".$dir.".pdf flatten"); 
  return $this->redirect("http://localhost/usjinscription/dossier".$dir.".pdf");
}

public function generatexfdf()
{

$file='dossadm14form.pdf';
$enc='UTF-8';
$dossierid =$this->getdossierid();;
$this->loadModel('Dossierattribut');
$this->loadModel('Attribut');
$this->loadModel('Dossierformationsec');
$this->loadModel('Dossierformation');

$this->Attribut->recursive=-1;
$this->Dossierattribut->recursive=-1;

$this->Dossierformation->recursive=-1;
$listattribut = $this->Attribut->find('list',array('conditions'=>array('Attribut.Type'=>'liste')));
  //print_r($listattribut);
$attributs = $this->Dossierattribut->find('all',array('conditions'=>array('Dossierattribut.dossier_id'=>$dossierid)));
$Dossierformationsec = $this->Dossierformationsec->find('all',array('conditions'=>array('Dossierformationsec.dossier_id'=>$dossierid)));
$dossierformations = $this->Dossierformation->find('all',array('conditions'=>array('Dossierformation.dossier_id'=>$dossierid)));

$data='<?xml version="1.0" encoding="'.$enc.'"?>'."\n". 
        '<xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve">'."\n". 
        '<fields>'."\n";

foreach($attributs as $att)
{ 
    if(!isset($listattribut[$att['Dossierattribut']['attribut_id']]))
 			{
		 $data.='<field name="'.'attribut'.$att['Dossierattribut']['attribut_id'].'">'."\n"; 

            $data.='<value>'.htmlentities($att['Dossierattribut']['valeur'],ENT_QUOTES, 'UTF-8').'</value>'."\n";
                    $data.='</field>'."\n";  
		}
		else
 		{
 		 $data.='<field name="'.'liste'.$att['Dossierattribut']['valeur'].'">'."\n"; 
        $data.='<value>'.htmlentities('true').'</value>'."\n"; 
                $data.='</field>'."\n"; 
    	}
    } 
      foreach($Dossierformationsec as $formation)
{
  $formationid = $formation['Dossierformationsec']['formationsecondaire_id'];
  $ecolnom = $formation['Ecolessecondaire']['nom'];
  $ecoladresse = $formation['Ecolessecondaire']['adresse'];  
   $data.='<field name="'.'adresseformation'.$formationid.'">'."\n"; 
    $data.='<value>'.htmlentities($ecoladresse).'</value>'."\n"; 
    $data.='</field>'."\n"; 
   
   $data.='<field name="'.'ecoleformation'.$formationid.'">'."\n"; 
   $data.='<value>'.htmlentities($ecolnom).'</value>'."\n"; 
    $data.='</field>'."\n"; 
}

    
foreach($dossierformations as $form)
{
 $data.='<field name="'.'formation'.$form['Dossierformation']['formation_id'].'">'."\n"; 
        $data.='<value>'.htmlentities($form['Dossierformation']['priorite']).'</value>'."\n";
                $data.='</field>'."\n";  
}
    
    
    
    $data.='</fields>'."\n". 
        '<ids original="'.md5($file).'" modified="'.time().'" />'."\n". 
        '<f href="'.$file.'" />'."\n". 
        '</xfdf>'."\n"; 
$dir= $dossierid;

	if (!file_exists('files/'.$dossierid))
    		 		{
   					   mkdir('files/'.$dossierid, 0777, true);
 					}
   file_put_contents('files/'.$dir.'/dossier.xdf', $data);
}

public function dossierpdf()
{
   $this->pdf3(true);
}

private function pdf3($redirect)
{

 $this->loadModel('User');
   $this->loadModel('Attribut');
      $this->loadModel('Fichier');
  $usr=$this->User->findById($this->Auth->user('id'));
$dossierid =$this->getdossierid();
    if(!$this->Dossier->isOwnedBy($dossierid,$usr['User']['id']) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       	$this->redirect(array('controller'=>'users','action' => 'profile'));       	
    }

$currDossier=$this->Dossier->findById($dossierid);

 $photocmd="";


  $photoatt= $this->Attribut->findByNom('Attache une photo récente');

 $this->Fichier->recursive=-1;
 $photo = $this->Fichier->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'attribut_id'=>$photoatt['Attribut']['id'])));
if(!empty($photo))
{
 $photocmd=" -image 'files/".$dossierid."/".$photo["Fichier"]["nom"]."' ";
}

$this->generatexfdf();
$rand =rand();
shell_exec("java -Dfile.encoding=UTF-8 -classpath ./:itextpdf-5.5.0.jar FormFiller "."dossadm14form.pdf".$photocmd." -xfdf "."files/".$dossierid.'/dossier.xdf'." -font arial.ttf "."tmp/dossier".$rand.".pdf");
if($redirect)
return $this->redirect("/tmp/dossier".$rand.".pdf");
else
return "tmp/dossier".$rand.".pdf";
}

public function pdf2()
{
$dossierid=$this->getdossierid();

$this->generatexfdf();
exec("/opt/pdflabs/pdftk/bin/pdftk "."dossadm14form.pdf "." fill_form files/".$dossierid.'/dossier.xdf'." output dossier2".$dossierid.".pdf flatten"); 
  return $this->redirect("http://localhost/usjinscription/dossier2".$dossierid.".pdf");
}

public function getformationkeys($formationdejaexist)
	{
	 $keys=array();
			foreach($formationdejaexist as $formation)
	   			{
	   				array_push($keys,$formation['Dossierformation']['formation_id']);
	   			}
	   	return $keys;
}
	
	
public function attachments($id=null,$thumb=0) {

   if(!$id)
    return;
 
    $this->loadModel('Fichier');
     $this->loadModel('User'); 
    $this->Fichier->id=$id;
    if($this->Fichier->exists())
    	{
    	$fichier =$this->Fichier->read();
		$usr=$this->User->findById($this->Auth->user('id'));
   	  if($this->Dossier->isOwnedBy($fichier['Fichier']['dossier_id'],$usr['User']['id']) || $usr['Group']['name']== 'Administrators')
    	  {
    	     $dir='files'.DS.$fichier['Fichier']['dossier_id'].DS;
    	   if($thumb)
    	    $dir.="thumbs".DS;
     	 if(file_exists($dir.$fichier['Fichier']['nom']))
         	{
          $this->response->file($dir.$fichier['Fichier']['nom'],array('download' => true, 'name' => $fichier['Fichier']['nom']));
		  return $this->response;
		 	}
		 }
		}
  echo "not authorized";
  exit;
    
}	

public function sendMail2($dossierid){
	$this->loadModel('Dossiercode');
	$this->loadModel('Dossier');
	$this->loadModel('Ecolessecondaire');
	$this->loadModel('Dossierformationsec');
	$this->loadModel('User');
	$this->loadModel('Formationsecondaire');
	
	$formationsecs=$this->Formationsecondaire->find('all');
	date_default_timezone_set("Asia/Beirut");
	$datedebut=date("Y-m-d h:i:s");
    $tmpdate=mktime(date("h"),date("i"),date("s"),date("m"),date("d")+1,date("Y"));
    $datefin=date("Y-m-d h:i:s",$tmpdate);
	
	App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail('gmail');
    $email->from('projetwebusj@gmail.com');

	foreach($formationsecs as $formation){
		$code=NULL;
		$dossForSec=$this->Dossierformationsec->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'formationsecondaire_id'=>$formation['Formationsecondaire']['id'])));
		
		$code=uniqid('',false);
    	$dossiercodedata=array('dossier_id'=>$dossierid,'code'=>$code,'ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'datedebut'=>$datedebut,'datefin'=>$datefin);
    	$existingCode=$this->Dossiercode->find('all',array('conditions'=>array('ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'dossier_id'=>$dossierid)));
    	if($existingCode==NULL){
			
    	$this->Dossiercode->create();
    	$this->Dossiercode->save($dossiercodedata);		
    		
		$ecole=$this->Ecolessecondaire->findById($dossForSec['Dossierformationsec']['ecolessecondaire_id']);
		$dossier=$this->Dossier->findById($dossierid);
		$etudiant=$this->User->findById($dossier['Dossier']['user_id']);
		
		 $email->to($ecole['Ecolessecondaire']['mail']);
         $email->subject('Saisie des notes');
         $txt= "Cliquez ici pour saisir les notes de l'étudiant ".$etudiant['User']['firstname']." ".$etudiant['User']['lastname']."\n". Router::url( "/", true ) . 'dossiers/editnotes/' . $code;
         $email->send($txt);
    	 echo 'Sending mail to '.$ecole['Ecolessecondaire']['nom'].'<br>';	
		}
	}
	
}



public function sendMail($dossierid)
{
 $this->autoRender=false;
	$this->loadModel('Dossiercode');
	$this->loadModel('Dossier');
	$this->loadModel('Ecolessecondaire');
	$this->loadModel('Dossierformationsec');
	$this->loadModel('User');
	$this->loadModel('Formationsecondaire');
	
	//$formationsecs=$this->Formationsecondaire->find('all');
	
	$datedebut=date("Y-m-d h:i:s");
    $tmpdate=mktime(date("h"),date("i"),date("s"),date("m"),date("d")+1,date("Y"));
    $datefin=date("Y-m-d h:i:s",$tmpdate);
	
	App::uses('CakeEmail', 'Network/Email');
    $email = new CakeEmail('gmail');
    $email->from('projetwebusj@gmail.com');

		$dossForSecs=$this->Dossierformationsec->find('all',array('conditions'=>array('dossier_id'=>$dossierid)));
	foreach($dossForSecs as $dossForSec)
	{
		
	if($dossForSec['Dossierformationsec']['contacteecole'])
	{
		$code=NULL;	
		$code=uniqid('',false);
    	$dossiercodedata=array('dossier_id'=>$dossierid,'type'=>'note','code'=>$code,'ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'datedebut'=>$datedebut,'datefin'=>$datefin);
    	$existingCode=$this->Dossiercode->find('all',array('conditions'=>array('ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'type'=>'note','dossier_id'=>$dossierid)));
    	if($existingCode==NULL)
    	{	
    	  $this->Dossiercode->create();
    	  $this->Dossiercode->save($dossiercodedata);			
		  $ecole=$this->Ecolessecondaire->findById($dossForSec['Dossierformationsec']['ecolessecondaire_id']);
		  $dossier=$this->Dossier->findById($dossierid);
		  $etudiant=$this->User->findById($dossier['Dossier']['user_id']);
		
		   $email->to($ecole['Ecolessecondaire']['mail']);
           $email->subject('Saisie des notes');
           $txt= "Cliquez ici pour saisir les notes de l'étudiant ".$etudiant['User']['firstname']." ".$etudiant['User']['lastname']."\n". Router::url( "/", true ) . 'dossiers/editnotes/' . $code;
           $email->send($txt);
    	   echo '<br>Sending mail to '.$ecole['Ecolessecondaire']['nom'].'<br>'. Router::url( "/", true ) . 'dossiers/editnotes/' . $code;
    	   	
		}
	}
	if($dossForSec['Formationsecondaire']['demandeappreciation'])
	{
	    $code=uniqid('',false);
    	$dossiercodedata=array('dossier_id'=>$dossierid,'code'=>$code,'type'=>'appreciation_scientifique','ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'datedebut'=>$datedebut,'datefin'=>$datefin);
    	$existingCode=$this->Dossiercode->find('all',array('conditions'=>array('ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'dossier_id'=>$dossierid,'type'=>'appreciation_scientifique')));
    	if($existingCode==NULL)
    	{	
    	$this->Dossiercode->create();
    	$this->Dossiercode->save($dossiercodedata);		
    		
		$ecole=$this->Ecolessecondaire->findById($dossForSec['Dossierformationsec']['ecolessecondaire_id']);
		$dossier=$this->Dossier->findById($dossierid);
		$etudiant=$this->User->findById($dossier['Dossier']['user_id']);
		
		 $email->to($ecole['Ecolessecondaire']['mail']);
         $email->subject("Lettre d'appréciation");
         $txt= $ecole['Ecolessecondaire']['nom']."\n Cliquez ici pour remplir une lettre d'appréciation par un professeur d'une matière scientifique pour l'étudiant ".$etudiant['User']['firstname']." ".$etudiant['User']['lastname']."\n". Router::url( "/", true ) . 'dossiers/appreciation/' . $code;
         $email->send($txt);
	  echo '<br>Sending appreciation scientique mail to '.$ecole['Ecolessecondaire']['nom'].'<br>';
	  
	  
	  	  $code=uniqid('',false);
    	$dossiercodedata=array('dossier_id'=>$dossierid,'code'=>$code,'type'=>'appreciation_non_scientifique','ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'datedebut'=>$datedebut,'datefin'=>$datefin);
    	$existingCode=$this->Dossiercode->find('all',array('conditions'=>array('ecole_id'=>$dossForSec['Dossierformationsec']['ecolessecondaire_id'],'dossier_id'=>$dossierid,'type'=>'appreciation_non_scientifique')));
    	if($existingCode==NULL)
    	{	
    	$this->Dossiercode->create();
    	$this->Dossiercode->save($dossiercodedata);		
    		
		$ecole=$this->Ecolessecondaire->findById($dossForSec['Dossierformationsec']['ecolessecondaire_id']);
		$dossier=$this->Dossier->findById($dossierid);
		$etudiant=$this->User->findById($dossier['Dossier']['user_id']);
		
		 $email->to($ecole['Ecolessecondaire']['mail']);
         $email->subject("Lettre d'appréciation");
         $txt= $ecole['Ecolessecondaire']['nom']."\n Cliquez ici pour remplir une lettre d'appréciation par un professeur d'une matière non scientifique pour l'étudiant ".$etudiant['User']['firstname']." ".$etudiant['User']['lastname']."\n". Router::url( "/", true ) . 'dossiers/appreciation/' . $code;
         $email->send($txt);
	
	  echo '<br>Sending appreciation non scientique mail to '.$ecole['Ecolessecondaire']['nom'].'<br>';
	  }
	  }	
}
	}
	
}

public function appreciationManuelle($code)
{//change it to dossier code
	$this->loadModel('Attribut');
	$this->loadModel('Section');
	$this->loadModel('Dossier');
	$this->loadModel('Dossierattribut');
    $this->loadModel('Dossiercode');
    $this->loadModel('Ecolessecondaire');

	$dossiercode=$this->Dossiercode->findByCode($code);
	if(empty($dossiercode))
	  {
	   return $this->redirect(array('controller'=>'dossiers','action' => 'appreciation',$code));
	  }
	$type=$dossiercode['Dossiercode']['type'];
	
	$ecole = $this->Ecolessecondaire->findById($dossiercode['Dossiercode']['ecole_id']);
	$dossierid=$dossiercode['Dossiercode']['dossier_id'];
	$dossier=$this->Dossier->findById($dossierid);	

	switch($type)
	{
	  case "appreciation_non_scientifique":
	  	$appSec=$this->Section->findByNom('Appreciation non scientifique');
		$this->set('type','non scientifique');
		break;
	  case "appreciation_scientifique":
		$appSec=$this->Section->findByNom('Appreciation scientifique');
		$this->set('type','scientifique');
		break;	   
	   default:
			return ; 
	}
	
	$attSc=$this->Attribut->findAllBySectionId($appSec['Section']['id']);

   
	if($this->request->is('post'))
	{
		$attributs= $this->request->data['Appreciation'];
	    
	        foreach($attributs as $key => $att)
 	   {
 	   if (preg_match('/^attribut\d/',$key))
 	    {
 	      //echo $key." ".$att."<br>";
 	       $this->updateattribut($dossierid,preg_replace('/^attribut/', '', $key),$att);
 	    }
 	   else  if (preg_match('/^text\d/',$key))
 	    {
 	      $this->loadModel('Dossiertext');
 	      $attid=preg_replace('/^text/','', $key);
 	      $ret=$this->Dossiertext->addDossiertext($dossierid,$attid,$att);
 	      $this->updateattribut($dossierid,$attid,$ret['Dossiertext']['id']);
 	    }
	    
  	 }
	
	$this->Session->write('appreciation','succes');
	return	$this->redirect(array('controller'=>'pages','action' => 'merciapp')); 
   }
 else
 { 
	//fill static fields
	foreach($attSc as $key=>$att)
	 {
	  if($att['Attribut']['type']=='static')
		 {
		    switch($att['Attribut']['nom'])
		    { 
		      case 'Établissement':
		      	$attSc[$key]['Attribut']['valeur']=$ecole['Ecolessecondaire']['nom'];
		         break;
		     case 'Date':
		     $attSc[$key]['Attribut']['valeur']=date("d/m/Y");
		         break;
		     case 'Chef de l\'établissement':
		     $attSc[$key]['Attribut']['valeur']=$ecole['Ecolessecondaire']['chef'];
		         break;
		     case 'Nom et prénom du (de la) candidat(e)':
           $res=  $this->getNomPrenom($dossierid);
		   $nom=$res['nom'];
		   $prenom= $res['prenom'];
		   $prenompere= $res['prenompere'];

		   $attSc[$key]['Attribut']['valeur']=$nom." ".$prenom." (".$prenompere.")";

		         break;
		     default:
		     	$attSc[$key]['Attribut']['valeur']='erreur';
		        break;                        		         
		    }
		 
		 }
	 }
	
	$this->set('attSc',$attSc);
	

 }
	
	
	
	
}


public function getNomPrenom($dossierid)
{

	$this->loadModel('Attribut');
	$this->loadModel('Section');
	$this->loadModel('Dossierattribut');

		   $this->Attribut->recursive=-1;
		   $this->Dossierattribut->recursive=-1;
		   $this->Section->recursive=-1;
		   $etatcivilsection =  $this->Section->findByNom('ÉTAT CIVIL');

		   $nomatt = $this->Attribut->find('first',array('conditions'=>array('Attribut.nom'=>'Nom','Attribut.section_id'=>$etatcivilsection['Section']['id'])));
		   $prenomatt = $this->Attribut->find('first',array('conditions'=>array('Attribut.nom'=>'Prénom','Attribut.section_id'=>$etatcivilsection['Section']['id'])));
		   $prenompereatt = $this->Attribut->find('first',array('conditions'=>array('Attribut.nom'=>'Prénom du Père','Attribut.section_id'=>$etatcivilsection['Section']['id'])));

 		   $nom = $this->Dossierattribut->find('first',array('fields'=>'valeur','conditions'=>array('Dossierattribut.attribut_id'=>$nomatt['Attribut']['id'],'Dossierattribut.dossier_id'=>$dossierid)));
		   $prenom = $this->Dossierattribut->find('first',array('fields'=>'valeur','conditions'=>array('Dossierattribut.attribut_id'=>$prenomatt['Attribut']['id'],'Dossierattribut.dossier_id'=>$dossierid)));
		   $prenompere = $this->Dossierattribut->find('first',array('fields'=>'valeur','conditions'=>array('Dossierattribut.attribut_id'=>$prenompereatt['Attribut']['id'],'Dossierattribut.dossier_id'=>$dossierid)));

		   $nom= isset($nom['Dossierattribut']['valeur'])?$nom['Dossierattribut']['valeur'] : "N/A";
		   $prenom= isset($prenom['Dossierattribut']['valeur'])?$prenom['Dossierattribut']['valeur'] : "N/A";
		   $prenompere=isset($prenompere['Dossierattribut']['valeur'])?$prenompere['Dossierattribut']['valeur'] : "N/A";
		   
		   return array("nom"=>$nom,"prenom"=>$prenom,"prenompere"=>$prenompere);
}


public function appreciation($code){
		$this->set('code',$code);
		$this->loadModel('Dossiercode');
		$this->loadModel('Dossier');
		$this->loadModel('User');
		$dossiercode=$this->Dossiercode->findByCode($code);
		if(empty($dossiercode))
		{
		 	$this->set('valid',0);
		 	return;
		}
		  else
   {
		$dossierid=$dossiercode['Dossiercode']['dossier_id'];
		$dossier=$this->Dossier->findById($dossierid);
		$user=$this->User->findById($dossier['Dossier']['user_id']);
		$this->set('user',$user);
        
        $res=  $this->getNomPrenom($dossierid);
		$nom=$res['nom'];
		$prenom= $res['prenom'];
		
        $this->set('prenom',$prenom);
        $this->set('nom',$nom);
        
		$this->set('succes',0);
		$this->set('type',$dossiercode['Dossiercode']['type']);
		
		if($dossiercode['Dossiercode']['type']=="appreciation_scientifique")
		{
		$this->set('attid',"72");//attribut id de l'appreciation 1;
		}
		else if($dossiercode['Dossiercode']['type']=="appreciation_non_scientifique")
		{
		$this->set('attid',"73");//attribut id de l'appreciation 2;
		}
		else
		{
		  return;
		}
	}
		
		//if(($dossiercode['Dossiercode']['valid']==0)/*||date("Y-m-d h:i:s")>date("Y-m-d h:i:s",strtotime($dossiercode['Dossiercode']['datefin']))*/){
		//	$this->set('valid',0);
		//	return;
		//}
		//else{
			$this->set('valid',1);
	//	/}
		$this->Dossiercode->id=$dossiercode['Dossiercode']['id'];
		//$this->Dossiercode->savefield('valid',0);
		
		
}




public function checkNotesArray($code,&$data){
	$this->loadModel('Dossiercode');
	$this->loadModel('Dossier');
	$this->loadModel('Dossier');
	$this->loadModel('Dossierformationsec');
	$this->loadModel('Formationsecondaire');
	$this->loadModel('Attribut');
	$dossiercode=$this->Dossiercode->findByCode($code);
	$dossier=$this->Dossier->findById($dossiercode['Dossiercode']['dossier_id']);
	$DossForSecs=$this->Dossierformationsec->find('all',array('conditions'=>array('dossier_id'=>$dossiercode['Dossiercode']['dossier_id'])));
	$codeEcoleId=$dossiercode['Dossiercode']['ecole_id'];
	$ecole=$this->Ecolessecondaire->findById($codeEcoleId);
	
	
	$valeurpermis=array();
	

	foreach($DossForSecs as $DossForSec)
	{
			$FormationEcoleId=$DossForSec['Dossierformationsec']['ecolessecondaire_id'];
  			if($codeEcoleId==$FormationEcoleId)
  			{
  				$formsec=$this->Formationsecondaire->findById($DossForSec['Dossierformationsec']['formationsecondaire_id']);
				$atts=$this->Attribut->findAllBySectionId($formsec['Formationsecondaire']['section_id']);
				foreach($atts as $att){
					array_push($valeurpermis,$att['Attribut']['id']);
				}
 			 }
 	}
	
	foreach($data as $key=>$value){
		if(!in_array($key,$valeurpermis)){
			unset($data[$key]);
		}
		else{
			
			if(is_numeric($value)){
				if($value<0||$value>20){
					unset($data[$key]);
				}
			}
			else{
				unset($data[$key]);
			}	
		}
	
	}
}

public function editnotes($code)
{


		$this->loadModel('Attribut');
		$this->loadModel('Dossierattribut');
		$this->loadModel('Section');
		$this->loadModel('Sectiongroup');
		$this->loadModel('Dossiercode');
		$this->loadModel('Dossierformationsec');
		$this->loadModel('Formationsecondaire');
		$this->loadModel('Ecolessecondaire');
		$this->loadModel('Dossier');
		$this->loadModel('User');
		
		$dossiercode=$this->Dossiercode->findByCode($code);//code => ecole_id

	if(empty($dossiercode))
		  exit;
		
		if($this->request->is('post'))
     	{
			$this->checkNotesArray($code,$this->request->data['Note']);
     		foreach($this->request->data['Note'] as $key=>$valeur){
     			$this->Dossierattribut->addOrUpdateByDossierAttributValeur($dossiercode['Dossiercode']['dossier_id'],$key,$valeur);
			}
			$this->redirect(array('action' => 'viewnotes',$code));	
     	}	
	
	/*	if($dossiercode['Dossiercode']['valid']==0)||date("Y-m-d h:i:s")>date("Y-m-d h:i:s",strtotime($dossiercode['Dossiercode']['datefin'])*/ /*|| date("Y-m-d h:i:s")<date("Y-m-d h:i:s",strtotime($dossiercode['Dossiercode']['datedebut'])){
			$this->set('valid',0);
			return;
		}
		else{*/
			$this->set('valid',1);
		//}
		
		$this->Dossiercode->id=$dossiercode['Dossiercode']['id'];
		$this->Dossiercode->savefield('valid',0);
		////////////////////////////////////////////////////////////////////
		
		
		$codeEcoleId=$dossiercode['Dossiercode']['ecole_id'];
		$ecole=$this->Ecolessecondaire->findById($codeEcoleId);
		$this->set('etablissement',$ecole['Ecolessecondaire']['nom']);
		$dossier=$this->Dossier->findById($dossiercode['Dossiercode']['dossier_id']);
		$user=$this->User->findById($dossier['Dossier']['user_id']);
		$this->set('prenom',$user['User']['firstname']);
		$this->set('nom',$user['User']['lastname']);
		date_default_timezone_set("Asia/Beirut");
		$date=date("d/m/Y");
		$this->set('date',$date);
		
		
		$formationsecs=$this->Formationsecondaire->find('all');
	
		/*$sections=array();
		foreach($formationsecs as $formation){
			$DossForSec=$this->Dossierformationsec->find('first',array('conditions'=>array('dossier_id'=>$dossiercode['Dossiercode']['dossier_id'],'formationsecondaire_id'=>$formation['Formationsecondaire']['id'])));
			$FormationEcoleId=$DossForSec['Dossierformationsec']['ecolessecondaire_id'];
			if($codeEcoleId==$FormationEcoleId){
				$sectionCorresp=$this->Section->findById($formation['Formationsecondaire']['section_id']);			
				array_push($sections,$sectionCorresp);
			}	
		}*/
 	 $sections=array();
  	$DossForSecs=$this->Dossierformationsec->find('all',array('conditions'=>array('dossier_id'=>$dossiercode['Dossiercode']['dossier_id'],'contacteecole'=>'1')));
	foreach($DossForSecs as $DossForSec)
	{
			$FormationEcoleId=$DossForSec['Dossierformationsec']['ecolessecondaire_id'];
  			if($codeEcoleId==$FormationEcoleId)
  			{
			$sectionCorresp=$this->Section->findById($DossForSec['Formationsecondaire']['section_id']);
	 		 array_push($sections,$sectionCorresp);
 			 }
 	}
	$this->set('sections',$sections);				
}


public function viewnotes($code){
	$this->loadModel('Dossierattribut');
	$this->loadModel('Attribut');
	$this->loadModel('Section');
	$this->loadModel('Sectiongroup');
	$this->loadModel('Dossiercode');
	$this->loadModel('Formationsecondaire');
	$this->loadModel('Dossierformationsec');
	$dossier=$this->Dossiercode->findByCode($code);
	$dossierid=$dossier['Dossiercode']['dossier_id'];
	$ecoleid=$dossier['Dossiercode']['ecole_id'];
	
	$DossForSecs=$this->Dossierformationsec->find('all',array('conditions'=>array('dossier_id'=>$dossierid)));
	$formIds=array();
	foreach($DossForSecs as $dfs){
		if($dfs['Dossierformationsec']['ecolessecondaire_id']==$ecoleid)
			array_push($formIds,$dfs['Dossierformationsec']['formationsecondaire_id']);
	}
	
	
	$formationsecs=$this->Formationsecondaire->find('all');
	
	$sections=array();
	foreach($formationsecs as $formation){
		if(in_array($formation['Formationsecondaire']['id'],$formIds)){
			
		$notes=array();
		$sectionFullInfo=array();	
		$sectionCorresp=$this->Section->findById($formation['Formationsecondaire']['section_id']);			
		$matieres=$this->Attribut->find('all',array('conditions'=>array('section_id'=>$sectionCorresp['Section']['id'])));
		foreach($matieres as $matiere){
			$matNoteVal=$this->Dossierattribut->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'attribut_id'=>$matiere['Attribut']['id'])));
				if($matNoteVal!=Null)
				$notes[$matiere['Attribut']['nom']]=$matNoteVal['Dossierattribut']['valeur'];
			else	
				$notes[$matiere['Attribut']['nom']]='-';
		}
		$sectionFullInfo['nom']=$sectionCorresp['Section']['nom'];
		$sectionFullInfo['notes']=$notes;
		array_push($sections,$sectionFullInfo);
		}		
	}
	$this->set('sections',$sections);
}

public function export()
{
  $dossiers=array();
  foreach($this->request->data['dossiers'] as $dossierid)
  {
  if (preg_match('/^export\d/',$dossierid))
 	  {
 	      $id=preg_replace('/^export/','', $dossierid);
   			array_push($dossiers,$id);
       }
  }
 $this->autoRender=false;
 
  $root = new SimpleXMLElement('<dossiers/>');

  foreach($dossiers as $dID)
{
  $child=$this->genererxml($dID);
  //$root->addChild('d',$child); 
  $this->sxml_append($root,$child);   
}
 //Header('Content-type: text/xml');
 $rand=rand();
 $xmlfile="xmldossiers".$rand.".xml";
 $ziplocation = "dossier".$rand.".zip";
file_put_contents("tmp/".$xmlfile,$root->asXML());

$cmd=" tmp/".$xmlfile;
foreach($dossiers as $dossier)
{
 $cmd.=" files/".$dossier." ";
}

shell_exec("zip -r tmp/".$ziplocation.$cmd);
$response['url']= Router::url(array('controller'=>'tmp','action'=>$ziplocation), true) ;
echo json_encode($response);
}

function sxml_append(SimpleXMLElement $to, SimpleXMLElement $from) {
    $toDom = dom_import_simplexml($to);
    $fromDom = dom_import_simplexml($from);
    $toDom->appendChild($toDom->ownerDocument->importNode($fromDom, true));
}

public function genererxml($dossierid)
{
 $this->autoRender=false;
 $this->loadModel('Dossierattribut');
 $this->loadModel('Listattribut');
 $this->loadModel('Dossierformationsec');
 $this->loadModel('Ecolessecondaire');
 $this->loadModel('Sectiongroup');
 $this->loadModel('Fichier');
 $this->loadModel('Formation');
$this->loadModel('Dossiertext');
$this->loadModel('Dossierformation');
   $this->Sectiongroup->recursive=2;
// $this->Attribut->recursive=-1;
// $this->Dossierattribut->recursive=-1;
// 
// $this->Dossierformation->recursive=-1;
// $listattribut = $this->Attribut->find('list',array('conditions'=>array('Attribut.Type'=>'liste')));
//   //print_r($listattribut);
// $attributs = $this->Dossierattribut->find('all',array('conditions'=>array('Dossierattribut.dossier_id'=>$dossierid)));
// $Dossierformationsec = $this->Dossierformationsec->find('all',array('conditions'=>array('Dossierformationsec.dossier_id'=>$dossierid)));
// $dossierformations = $this->Dossierformation->find('all',array('conditions'=>array('Dossierformation.dossier_id'=>$dossierid)));
$sectiongs = $this->Sectiongroup->find('all');
$root = new SimpleXMLElement('<dossier/>');
$root->addAttribute('id',$dossierid);

foreach($sectiongs as $sectiong)
{
    $element=$sectiong['Sectiongroup']['nom'];
    $element=str_replace(" ","_",$element);
	$element=str_replace("'","_",$element);
	$sg = $root->addChild($element);
	foreach($sectiong['Section'] as $section)
 	{
 		$element=$section['nom'];
		$element=str_replace(" ","_",$element);
		$element=str_replace("'","_",$element);
		$sec=$sg->addChild($element);


	 foreach($section['Attribut'] as $att)
	 {
 	$element=$att['nom'];
	$element=str_replace(" ","_",$element);
	$element=str_replace("'","_",$element);
	$element=str_replace("(","_",$element);
	$element=str_replace(")","_",$element);
	$element=str_replace("’","_",$element);
	$element=str_replace("/","_",$element);
 
 
 	switch($att['type'])
  	{
  	case "file":
        $f=$this->Fichier->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
     	if($f)
     	$sec->addChild($element,$f['Fichier']['nom']);
		break;
  	case "filenote":
  		  $f=$this->Fichier->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
     	if($f)
     	$sec->addChild($element,$f['Fichier']['nom']);
  		break;
    case "fileappreciation":
  		  $f=$this->Fichier->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
     	if($f)
     	$sec->addChild($element,$f['Fichier']['nom']);
  		break;
  	case "choixcursus":
         $dossierformations=$this->Dossierformation->find('all',array('conditions'=>array('dossier_id'=>$dossierid)));
         foreach($dossierformations as $formation)
         {
          $this->Formation->id=$formation['Dossierformation']['formation_id'];
           $f=$this->Formation->read();
           $s1=$sec->addChild("Formation",$f['Formation']['nom']);
           $s1->addAttribute("priorite",$formation['Dossierformation']['priorite']);
          
         }
     	break;
  case "choixformationsecondaire":
              $this->loadModel('Formationsecondaire');
			        $formationsecs = $this->Formationsecondaire->find('all',array('fields'=>array('id','nom')));
                    foreach($formationsecs as $formationsec)
                    {
                      $dossierformations = $this->Dossierformationsec->find('first',array('conditions'=>array('dossier_id'=>$dossierid,'formationsecondaire_id'=>$formationsec['Formationsecondaire']['id'])));
                      if($dossierformations)
                      {
                     
                        $s1 = $sec->addChild($element);
                        $s1->addAttribute('nom',$formationsec['Formationsecondaire']['nom']);
                        $ecolid = $dossierformations['Dossierformationsec']['ecolessecondaire_id'];
                        $this->Ecolessecondaire->id=$ecolid;
                        $this->Ecolessecondaire->read();
                        $s1->addChild('nom',$this->Ecolessecondaire->data['Ecolessecondaire']['nom']);
                        $s1->addChild('adresse',$this->Ecolessecondaire->data['Ecolessecondaire']['adresse']);
                      }
                    }
  	      break;
  	case "liste":
    	   $f1=$this->Dossierattribut->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
    	 if($f1){
    		  		$f2=$this->Listattribut->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'Listattribut.id'=>$f1['Dossierattribut']['valeur'])));
            	 	$sec->addChild($element,$f2['Listattribut']['valeur']);
             	}
        break;
     case "textarea":
    	   $f1=$this->Dossierattribut->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
    	 if($f1){
    		  		$f2=$this->Dossiertext->find('first',array('conditions'=>array('Dossiertext.id'=>$f1['Dossierattribut']['valeur'])));
            	 	if($f2)
            	 	  $sec->addChild($element,$f2['Dossiertext']['text']);
             	}
        break;    
  default :
     $f=$this->Dossierattribut->find('first',array('conditions'=>array('attribut_id'=>$att['id'],'dossier_id'=>$dossierid)));
     	if($f)
     	$sec->addChild($element,$f['Dossierattribut']['valeur']);
        break;
  }
 }
  
 }
}
//Header('Content-type: text/xml');
return $root;
}

public function souche($filename,$option)
{    
   $this->loadModel('User');
   $usr=$this->User->findById($this->Auth->user('id'));
   $dossierid=$this->getdossierid();
    if(!$this->Dossier->isOwnedBy($dossierid,$usr['User']['id']) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access');
       $this->redirect(array('controller'=>'users','action' => 'profile')); 	
    }
      
     // $this->layout = 'pdf';
 
 if($this->Session->read('newusername') && $this->Session->read('newpassword') && $this->Session->read('newdossier'))
  {
 
  if($usr['Group']['name']== 'Administrators' && $_SESSION['newdossier']==$dossierid)
    {
 	 $this->set('username',$_SESSION['newusername']);
 	 $this->set('password',$_SESSION['newpassword']);
 ////	$this->set->('password',$_SESSION['newpassword']);
 //	$this->Session->Delete('newusername');
 //	$this->Session->Delete('newpassword');
 	}

  }     
    
     $this->set('filename',$filename);
     $this->set('option',$option);
   	 $this->set('dossierid',$dossierid);

        $this->render();
}

private function generatesouche($filename='souche.pdf',$option='F',$dossierid)
{

  $this->loadModel('User');
   $usr=$this->User->findById($this->Auth->user('id'));
   
App::import('Vendor','xtcpdf');
//ob_end_clean(); 
$tcpdf = new XTCPDF();
$tcpdf->SetAuthor("USJInscription");
$tcpdf->SetAutoPageBreak( false );
$resolution= array(95, 210);
$tcpdf->AddPage('L', $resolution);
$logo='<img src="img/header.jpg"/>';
$tcpdf->writeHTMLCell($w='', $h='', $x='', $y='5', $logo, $border=0, $ln=1, $fill=0, $reseth=true);
$annee='<h5> Ann&eacute;e 2013/2014</h5>';
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='12', $annee, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='18', 'Dossier '.$dossierid, $border=0, $ln=1, $fill=0, $reseth=true);

$tcpdf->SetFont(PDF_FONT_MONOSPACED,'','8');
$tcpdf->setCellHeightRatio(2);
$html = <<<EOD
</center><table  bordercolor="#0053b0" color="#0053b0" border="0.3" >
  <tr align="center">
    <td rowspan="2" colspan="2">Institut/Cursus</td>
    <td colspan="2">Droits de scolarit&eacute;</td>
    <td colspan="2">Montant</td>
    <td colspan="2">Delai de paiement</td>
  </tr>
  <tr align="center">
    <td>Semestre</td>
    <td>Versement</td>
    <td></td>
    <td></td>
    <td>du</td>
    <td>au</td>
  </tr>
  <tr  align="center">
    <td colspan="2">USJ</td>
    <td></td>
    <td></td>
    <td>150 000L.L.</td>
    <td></td>
    <td>1/3/2014</td>
    <td> 1/2/2015</td>
  </tr>
  
 </table>
EOD;
$tcpdf->writeHTMLCell($w='170', $h='', $x='20', $y='40', $html, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->SetFont(PDF_FONT_NAME_DATA,'','8');
$footer='<div  align="center" bgcolor="#e4edf4" ><font color="#0053ad">Rectorat de l\'USJ, Rue de Damas, B.P. 17-5208, Mar Mikha&euml;l 1104 2020 Beyrouth, Liban. T&eacute;l : 961.1.421000, Tpie : 961.1.421112</font></div>';
//$tcpdf->WriteHTML($footer);	
$tcpdf->writeHTMLCell($w='170', $h='20', $x='20', $y='80', $footer, $border=0, $ln=1, $fill=0, $reseth=true);

if($this->Session->read('newusername') && $this->Session->read('newpassword') && $this->Session->read('newdossier'))
{
 if($usr['Group']['name']== 'Administrators' && $this->Session->read('newdossier') == $dossierid)
 {
   $username=$this->Session->read('newusername');
   $password=$this->Session->read('newpassword');
   $tcpdf->AddPage('L', $resolution);

   $logo='<img src="img/header.jpg"/>';
$tcpdf->writeHTMLCell($w='', $h='', $x='', $y='5', $logo, $border=0, $ln=1, $fill=0, $reseth=true);

$annee='<h5> Ann&eacute;e 2013/2014</h5>';
$tcpdf->writeHTMLCell($w='', $h='', $x='100', $y='12', $annee, $border=0, $ln=1, $fill=0, $reseth=true);
$username="Username : ".$username;
$password ="Mdt de passe : ".$password;
$message="Un compte est cr&eacute;e avec les param&egrave;tres suivantes :";
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='32', $message, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='42', $username, $border=0, $ln=1, $fill=0, $reseth=true);
$tcpdf->writeHTMLCell($w='', $h='', $x='20', $y='52', $password, $border=0, $ln=1, $fill=0, $reseth=true);
 }
}

$tcpdf->Output($filename, $option);

}	

public function valider()
{
  	
   $this->autoRender = false;
   
 	if($this->request->is('get'))
 	  {
 	    return $this->redirect(array('controller'=>'users','action' => 'profile'));
		}
		 
 $this->layout ='ajax';
 $this->request->onlyAllow('post','ajax');
 
 $this->loadModel('User');
 
 $dossierid=$this->getdossierid();
 $usr=$this->User->findById($this->Auth->user('id'));
  

  
  if(!$this->Dossier->isOwnedBy($dossierid,$this->Auth->user('id')) && !($usr['Group']['name']== 'Administrators'))
    {
       $this->Session->setFlash('Unauthorized access'); //check if i have to add return for security issues;
       return $this->redirect(array('controller'=>'users','action' => 'profile'));
    }
   
    $this->Dossier->id=$dossierid;
    $this->Dossier->read();
    $missingFileds= $this->missingFields($dossierid);
  if(!$this->Dossier->data['Dossier']['valide'] && !empty($missingFileds) && !($usr['Group']['name']== 'Administrators'))
       { 
        if($this->request->is('post'))
           {
           $this->Session->setFlash("Le dossier est incomplet!");
           $response['url']= Router::url(array('controller'=>'dossiers','action'=>'blancform','?'=>array('dossierid'=>$dossierid,'valider'=>$this->Auth->user('id'))), true) ;
           echo json_encode($response);
           }
          return;
	   }
    
    $rand =rand();
    $soucheloation = 'tmp/souche'.$rand.'.pdf';
    $this->generatesouche($soucheloation,'F',$dossierid);
    $pdflocation =$this->pdf3(false); 
     $rand=rand();
    $ziplocation = "dossier".$rand.".zip";
    shell_exec("zip tmp/".$ziplocation." ".$soucheloation." ".$pdflocation);
    shell_exec("rm ".$soucheloation);
    shell_exec("rm ".$pdflocation);
    $this->Dossier->saveField('valide',$this->Auth->user('id'));


   if($this->request->is('post'))
       {  
          $response['url']= Router::url(array('controller'=>'tmp','action'=>$ziplocation), true) ;
          echo json_encode($response);
       }
    
	//return $this->redirect("/".$ziplocation);

    // $this->autoRender=false
   }	
	
  public function getmissingfields()
  { 
   $this->request->onlyAllow('post','ajax');
   $this->loadModel('Attribut');
    $this->loadModel('User');

    $this->layout='ajax';
	$this->autoRender=false;
 $dossierid=$this->getdossierid();
 $usr=$this->User->findById($this->Auth->user('id'));
  if(!$this->Dossier->isOwnedBy($dossierid,$this->Auth->user('id')) && !($usr['Group']['name']== 'Administrators'))
	 {
	  return;		
	}
	 
    $missingFileds= $this->missingFields($dossierid);
$results=array();
    foreach($missingFileds as $key=>$val)
    { 
    // print_r($val);
     switch($key)
     { 
       case "Formationsecondaire":
     foreach($val as $att)
          {
          if(!isset($results['ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES']))
          $results['ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES']=array();        
           
            $this->Formationsecondaire->id=$att;
            $formation = $this->Formationsecondaire->read();
            
            array_push($results['ÉTABLISSEMENTS SCOLAIRES DES ANNÉES SECONDAIRES'],$formation['Formationsecondaire']['nom']);
            
          }
          break;
        case "Attribut":
          foreach($val as $att)
          {
          $this->Attribut->id=$att;
          $attribut = $this->Attribut->read();
        if(!isset($results[$attribut['Section']['nom']]))
           $results[$attribut['Section']['nom']]=array();
           
            array_push($results[$attribut['Section']['nom']],$attribut['Attribut']['nom']);
            
          }
          //echo "<missing attribut";
          break;
       
     }

    }
 header('Access-Control-Allow-Origin: *');  
   print(json_encode($results));
  }	
	



public function test()
{
  echo "note = ";print_r($this->checkNoteEcole('23'));echo "<br>";
  echo "appreciation = ";print_r($this->checkAppreciation('23'));echo "<br>";
}

public function checkAppreciation($dossierid)
{
  $this->loadModel('Attribut');
  $this->loadModel('Section');
$this->loadModel('Dossierattribut');
  $attributs=$this->Attribut->find('all',array('fields'=>'id','conditions'=>array('type'=>'fileappreciation')));
  $valide=1;
  $missings = array();
  foreach($attributs as $attribut)
  {
    if($this->checkFile($dossierid,$attribut['Attribut']['id']))
      {   
		continue;
      }
      else
      {
        if($attribut['Attribut']['id']=='72')
          $sectionid='16';
        
        if($attribut['Attribut']['id']=='73')
          $sectionid='15';
        
        $appSc = $this->Section->findById($sectionid);
        $attSc = $this->Attribut->find('list',array('fields'=>'id','conditions'=>array('section_id'=>$sectionid,'or'=>array(array('type'=>'liste'),array('type'=>'string'),array('type'=>'date')))));
        $dossieratt=$this->Dossierattribut->find('list',array('fields'=>array('attribut_id','valeur'),'conditions'=>array('dossier_id'=>$dossierid,'valeur !='=>"")));

    $diff=array_diff_key($attSc,$dossieratt);
       if(!empty($diff))
         {
          array_push($missings,$appSc['Section']['nom']);
         }
      }
    
  }
  return $missings;
}

public function checkNoteEcole($dossierid)
{

  $this->loadModel('Attribut');
  $this->loadModel('Section');
  $this->loadModel('Dossierattribut');
  $this->loadModel('Dossierformationsec');
  $this->loadModel('Formationsecondaire');
    $missings = array();
$dossierformationsecs=$this->Dossierformationsec->find('list',array('fields'=>array('formationsecondaire_id','contacteecole'),'conditions'=>array('dossier_id'=>$dossierid,'contacteecole'=>'1')));
$dossieratts = $this->Dossierattribut->find('list',array('fields'=>array('attribut_id','valeur'),'conditions'=>array('dossier_id'=>$dossierid)));
 $valide=1;
 foreach($dossierformationsecs as $key=>$dossierformationsec)
 {
  $formationsec = $this->Formationsecondaire->findById($key);
  $attSc = $this->Attribut->find('list',array('fields'=>'id','conditions'=>array('section_id'=>$formationsec['Formationsecondaire']['section_id'],'or'=>array(array('type'=>'liste'),array('type'=>'string'),array('type'=>'date')))));
  $diff=array_diff_key($attSc,$dossieratts);
  if(!empty($diff))
   { 
     array_push($missings,$formationsec['Formationsecondaire']['nom']);
    }
 }
return $missings;
}

public function ecoleLevelComplet($dossierid)
{
$note=$this->checkNoteEcole($dossierid);
$appre= $this->checkAppreciation($dossierid);
  if(empty($note) && empty($appre))
  {
   return true;
  }
  return false;
}


  public function getecolemissing()
  { 
   $this->request->onlyAllow('get','post','ajax');
    $this->loadModel('User');

    $this->layout='ajax';
	$this->autoRender=false;
    $dossierid=$this->getdossierid();
    $usr=$this->User->findById($this->Auth->user('id'));
  if(!$this->Dossier->isOwnedBy($dossierid,$this->Auth->user('id')) && !($usr['Group']['name']== 'Administrators'))
	 {
	  return;		
	}
	
$results=array();
$note=$this->checkNoteEcole($dossierid);
$appre= $this->checkAppreciation($dossierid);
if(!empty($note))
$results['Notes'] = $note;

if(!empty($appre))
$results['Lettres d\'appreciation'] = $appre;


 
   print(json_encode($results));
  }	


   public function beforeFilter()
{
    parent::beforeFilter();
   $this->Auth->allow('souche','editnotes','getecolemissing','viewnotes','test','checkappreciation','sendMail','appreciation','appreciationManuelle');
}
	

}
