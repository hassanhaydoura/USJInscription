<?php
App::uses('AppController', 'Controller');
/**
 * Ecolessecondaires Controller
 *
 * @property Ecolessecondaire $Ecolessecondaire
 * @property PaginatorComponent $Paginator
 */
class EcolessecondairesController extends AppController
{
// /**
//  * Components
//  *
//  * @var array
//  */
// 	public $components = array('Paginator');
// 
// /**
//  * index method
//  *
//  * @return void
//  */
// 	public function index() {
// 		$this->Ecolessecondaire->recursive = 0;
// 		$this->set('ecolessecondaires', $this->Paginator->paginate());
// 	}
// 
// /**
//  * view method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function view($id = null) {
// 		if (!$this->Ecolessecondaire->exists($id)) {
// 			throw new NotFoundException(__('Invalid ecolessecondaire'));
// 		}
// 		$options = array('conditions' => array('Ecolessecondaire.' . $this->Ecolessecondaire->primaryKey => $id));
// 		$this->set('ecolessecondaire', $this->Ecolessecondaire->find('first', $options));
// 	}
// 
// /**
//  * add method
//  *
//  * @return void
//  */
// 	public function add() {
// 		if ($this->request->is('post')) {
// 			$this->Ecolessecondaire->create();
// 			if ($this->Ecolessecondaire->save($this->request->data)) {
// 				$this->Session->setFlash(__('The ecolessecondaire has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The ecolessecondaire could not be saved. Please, try again.'));
// 			}
// 		}
// 	}
// 
// /**
//  * edit method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function edit($id = null) {
// 		if (!$this->Ecolessecondaire->exists($id)) {
// 			throw new NotFoundException(__('Invalid ecolessecondaire'));
// 		}
// 		if ($this->request->is(array('post', 'put'))) {
// 			if ($this->Ecolessecondaire->save($this->request->data)) {
// 				$this->Session->setFlash(__('The ecolessecondaire has been saved.'));
// 				return $this->redirect(array('action' => 'index'));
// 			} else {
// 				$this->Session->setFlash(__('The ecolessecondaire could not be saved. Please, try again.'));
// 			}
// 		} else {
// 			$options = array('conditions' => array('Ecolessecondaire.' . $this->Ecolessecondaire->primaryKey => $id));
// 			$this->request->data = $this->Ecolessecondaire->find('first', $options);
// 		}
// 	}
// 
// /**
//  * delete method
//  *
//  * @throws NotFoundException
//  * @param string $id
//  * @return void
//  */
// 	public function delete($id = null) {
// 		$this->Ecolessecondaire->id = $id;
// 		if (!$this->Ecolessecondaire->exists()) {
// 			throw new NotFoundException(__('Invalid ecolessecondaire'));
// 		}
// 		$this->request->onlyAllow('post', 'delete');
// 		if ($this->Ecolessecondaire->delete()) {
// 			$this->Session->setFlash(__('The ecolessecondaire has been deleted.'));
// 		} else {
// 			$this->Session->setFlash(__('The ecolessecondaire could not be deleted. Please, try again.'));
// 		}
// 		return $this->redirect(array('action' => 'index'));
// 	}
// 	
// 	
// 	 

 
	
public function find()
{
	  if($this->request->is('ajax'))
  	{
	 $this->loadModel("Ecolessecondaire");
  	  $this->autoRender = false;
      $this->layout = 'ajax'; 
//      header('Access-Control-Allow-Origin: *');         
       echo $this->Ecolessecondaire->findEcoleByQuery($this->request->query['term']);
      }
}

    
public function beforeFilter()
{
    parent::beforeFilter();
}

	
}
