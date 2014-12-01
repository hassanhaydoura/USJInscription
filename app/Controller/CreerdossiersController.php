<?php
App::uses('AppController', 'Controller');
/**
 * Sections Controller
 *
 */
class CreerdossiersController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
		
	public function index()
{ 
	  
  $this->loadModel('Section');
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Dossierformationsec');
  $this->loadModel('Formation');
  $this->loadModel('Dossierformation');
  $this->loadModel('Dossierattribut');
  $this->loadModel('Dossier');
  $this->loadModel('User');
  $this->loadModel('Listattribut');
  $this->set('listattributs',$this->Listattribut->find('all'));

    $userid=$this->Auth->user('id');
    $usr = $this->User->findById($userid);
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
	
// 	$this->Dossier->create();
// 	$tmp=$this->Dossier->save($data);
// 	$dossierid=$tmp['Dossier']['id'];
//     $this->Session->write('dossier_id',$dossierid);

    $this->set('formations',$this->Formation->find('all'));
	
    $this->loadModel('Attribut');
    $options=array('conditions'=>array('Attribut.existinmain'=>1));
    $AttExistInMain=$this->Attribut->find('all',$options);
    $this->set('AttExistInMain',$AttExistInMain);	

}
	
	

public function beforeFilter() 
{
    parent::beforeFilter();
}

}
