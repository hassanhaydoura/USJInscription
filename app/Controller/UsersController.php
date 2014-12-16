<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
}

public function profile(){
	$this->loadModel('Dossier');
	$userId=$this->Auth->user('id');
	$user = $this->User->findById($userId);
	   App::import('Controller', 'Dossiers');
 	    $dossierscontroller=  new  DossiersController;
     
        $this->set('activated',$user['User']['activated']);	 	
	if($user['Group']['name']=='Administrators')
	{
	 $listeDossiers=$this->Dossier->Find('all');
	 $this->set('isAdmin','1');
	}
	else
	{
     $this->set('isAdmin','0');
    $listeDossiers=$this->Dossier->Find('all',array('conditions'=>array('Dossier.user_id'=>$userId)));
	}
  	foreach($listeDossiers as $key=>$dossier)
  	{
  		$valideparetudiant=0;
 		$valideparadmin=0;
       $nom = $this->Dossier->nomDossier($dossier['Dossier']['id']);
    	if($dossier['Dossier']['valide']>0){
		$owner=$this->User->findById($dossier['Dossier']['valide']);
		
		if($owner['Group']['name']=='Etudiants')
			$valideparetudiant=1;
		if($owner['Group']['name']=='Administrators')
			$valideparadmin=1;	
	}
       $res=$dossierscontroller->getLevel($dossier['Dossier']['id']);
		$ecolecomplet = $dossierscontroller->ecoleLevelComplet($dossier['Dossier']['id']);

       //print_r($nom);
       $listeDossiers[$key]['Dossier']['nom']=$nom;
       $listeDossiers[$key]['Dossier']['progres']=$res['progres'];
       $listeDossiers[$key]['Dossier']['level']=$res['level'];
      $listeDossiers[$key]['Dossier']['valideparetudiant']=$valideparetudiant;
       $listeDossiers[$key]['Dossier']['valideparadmin']=$valideparadmin;
    	  $listeDossiers[$key]['Dossier']['ecolecomplet']=$ecolecomplet;
    }
	$this->set('listeDossiers',$listeDossiers);
}




private function setsections()
{
 $this->loadModel('Section');
  $this->loadModel('Formationsecondaire');
  $this->loadModel('Formation');
  		  $this->set('sectionid',isset($_GET['section'])?$_GET['section']:"all");
		  $this->Section->recursive=2;
  		  $this->set('sections',$this->Section->find('all'));
  		  $this->Section->recursive=1;
  		  $this->Formationsecondaire->recursive=-1;
 		  $this->Formation->recursive=1;
 		  $this->set('formationsecs',$this->Formationsecondaire->find('all'));
 		  $this->set('formations',$this->Formation->find('all'));
 		    
}



function removeEmptyAttribute($array)
{
if($this->Session->read('dossier_id')!="")
$dossierid=$this->Session->read('dossier_id');
else
 $this->redirect(array('controller'=>'users','action' => 'login'));
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $array[$key] = $this->removeEmptyAttribute($array[$key]);
        }

        if (empty($array[$key]))
        {
          App::import('Controller', 'Userattributs');
          if(preg_match('/^attribut\d/',$key))
          {
          	$controller=  new  UserattributsController;
        	$controller->removeByUserAttribut($dossierid,preg_replace('/^attribut/', '', $key));
            unset($array[$key]);
          }
        }
    }

    return $array;
}


public function getformationkeys($formationdejaexist)
	{
	 $keys=array();
			foreach($formationdejaexist as $formation)
	   			{
	   				array_push($keys,$formation['Userformation']['formation_id']);
	   			}
	   	return $keys;
	}
	


public function newuser()
	{
      $this->setsections();
	}


function activate($code = null) {

 $this->autoRender=false;
  $usr  =  $this->User->findByActivationcode($code);   
  if (!empty($usr))
  {
  	 $this->User->id = $usr['User']['id'];
  	$this->User->saveField('activated', 1);
  	 $this->Session->write('Auth.User.activated','1');
    $this->Session->setFlash('Votre compte est activé!');
    $this->redirect(array('controller'=>'users','action' => 'login'));
    }
}

  function __sendActivationEmail($code,$mail)
  {
		App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail('gmail');
        $email->from('projetwebusj@gmail.com');
        $email->to($mail);
        $email->subject('Account confirmation');
        $txt= "Cliquez pour activer votre compte sur notre site".
          "\n". Router::url( "/", true ) . 'users/activate/' . $code;
        $email->send($txt);
    
    }
    
    
public function changePassword($dossierid){
	if($dossierid==NULL){
		$this->Session->SetFlash('Erreur');
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
	}
	$this->request->onlyAllow('post');
	$this->loadModel('User');
	$this->loadModel('Dossier');
	$dossier=$this->Dossier->findById($dossierid);
	$pass=uniqid('',false);
	$this->User->id=$dossier['Dossier']['user_id'];
	$this->User->saveField('password',$pass);
	$usr=$this->User->read();
	$this->Session->setFlash("Le nouveau mot de passe de l'utilisateur ".$usr['User']['username'].'  est: '.$pass);
	return $this->redirect(array('controller'=>'users','action' => 'profile'));
		
}
    
public function changeAccountSettings($uid=null){
	
	$this->loadModel('User');
	
	if ($this->request->is('post')) {
			if($uid==null){
				$userid=$this->Auth->user('id');
			}
			else{
				$userid=$uid;
			}			
			$usr=$this->User->findById($userid);				
			$old=$this->request->data['User']['old'];
			$new=$this->request->data['User']['new'];
			$mail=$this->request->data['User']['mail'];
			$code=$usr['User']['activationcode'];
			$bool=0;
			$this->User->id=$usr['User']['id'];
			if($usr['User']['password']==AuthComponent::password($old)){
				$this->User->saveField('password',$new);
				$bool=1;
			}	
			if($mail!=NULL && $mail!=$usr['User']['email']){
				$this->User->saveField('email',$mail);
				$this->User->saveField('activated',0);
				$this->__sendActivationEmail($code,$mail);
				$bool=1;
			}
	
		if($bool)
		  $this->Session->SetFlash('Les modifications ont été sauvegardées');
		  else
		  $this->Session->SetFlash("Rien n'est modifié");		
		
		return $this->redirect(array('controller'=>'users','action' => 'profile'));
		} 
		
	
} 
    

    
public function initDB()
{
    $group = $this->User->Group;
    
    $group->id = 4;//admin
    $this->Acl->allow($group, 'controllers');
    
    $group->id = 3; //etudiant
   	$this->Acl->deny($group, 'controllers');
    $this->Acl->allow($group, 'controllers/users/profile');
    $this->Acl->allow($group, 'controllers/dossiers/blancform');
    $this->Acl->allow($group, 'controllers/uploads/index');
    $this->Acl->allow($group, 'controllers/dossiers/attachments');
    $this->Acl->allow($group, 'controllers/dossiers/delete');
    $this->Acl->allow($group, 'controllers/Ecolessecondaires/find');
    $this->Acl->allow($group, 'controllers/creerdossiers/index');
    $this->Acl->allow($group, 'controllers/dossiers/valider');
    $this->Acl->allow($group, 'controllers/dossiers/dossierpdf');
	$this->Acl->allow($group, 'controllers/dossiers/getmissingfields');
   //$this->Acl->allow($group, 'controllers/users/viewinfo');
    //we add an exit to avoid an ugly "missing views" error message
    echo "all done";
    exit;
}
   public function beforeFilter()
{
    parent::beforeFilter();
 $this->Auth->allow('logout','login','initdb','register','activate','changeAccountSettings','changePassword');
//	$this->Auth->deny('profile','login','initdb'); 
    //$this->Auth->allow('pdf','pdf2','register','attachments','logout','login','initdb','activate','pdf3','newuser','profile');

}
	}
