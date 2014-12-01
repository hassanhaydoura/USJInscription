<?php
App::uses('AppController', 'Controller');
/**
 * Fichiers Controller
 *
 */
class FichiersController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */


  public function beforeFilter()
{
    parent::beforeFilter();
    $this->Auth->allow('index','edit','add','delete','deletefichier');
}

 	public function SaveByNomDossierAttribut($nomFichier,$dossierid,$attributid)
	{
	    $param = array (
   						 	"Fichier"  => array("nom" => $nomFichier, "dossier_id" => $dossierid,"attribut_id"=>$attributid)
   				   );
   				 
   		$this->Fichier->create();
			if (($res = $this->Fichier->save($param)))
			{
				return $res;
			} 
	}
	


public function deletefichier($id)
{

 $this->autoRender = false;
  if($this->request->is('delete'))
    {
    $this->Fichier->id = $id;
    	if (!$this->Fichier->exists()) {
			 echo json_encode(array("result"=>"error"));
			 return;
		}
		$dossierid =  $this->Fichier->Field("dossier_id");
		$nomfichier = $this->Fichier->Field("nom");
  if($this->Fichier->delete())
      {
        echo json_encode(array("result"=>"success"));
      }
      else
         echo json_encode(array("result"=>"error"));
     }
    else 
      echo json_encode(array("result"=>"error"));
//     

}

}

