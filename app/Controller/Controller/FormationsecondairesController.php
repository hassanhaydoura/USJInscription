<?php
App::uses('AppController', 'Controller');
/**
 * Formationsecondaires Controller
 *
 * @property Formationsecondaire $Formationsecondaire
 * @property PaginatorComponent $Paginator
 */
class FormationsecondairesController extends AppController {

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
		$this->Formationsecondaire->recursive = 0;
		$this->set('formationsecondaires', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Formationsecondaire->exists($id)) {
			throw new NotFoundException(__('Invalid formationsecondaire'));
		}
		$options = array('conditions' => array('Formationsecondaire.' . $this->Formationsecondaire->primaryKey => $id));
		$this->set('formationsecondaire', $this->Formationsecondaire->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Formationsecondaire->create();
			if ($this->Formationsecondaire->save($this->request->data)) {
				$this->Session->setFlash(__('The formationsecondaire has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formationsecondaire could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Formationsecondaire->exists($id)) {
			throw new NotFoundException(__('Invalid formationsecondaire'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Formationsecondaire->save($this->request->data)) {
				$this->Session->setFlash(__('The formationsecondaire has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The formationsecondaire could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Formationsecondaire.' . $this->Formationsecondaire->primaryKey => $id));
			$this->request->data = $this->Formationsecondaire->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Formationsecondaire->id = $id;
		if (!$this->Formationsecondaire->exists()) {
			throw new NotFoundException(__('Invalid formationsecondaire'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Formationsecondaire->delete()) {
			$this->Session->setFlash(__('The formationsecondaire has been deleted.'));
		} else {
			$this->Session->setFlash(__('The formationsecondaire could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeFilter() 
{
    parent::beforeFilter();
}
	}
