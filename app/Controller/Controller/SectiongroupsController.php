<?php
App::uses('AppController', 'Controller');
/**
 * Sectiongroups Controller
 *
 * @property Sectiongroup $Sectiongroup
 * @property PaginatorComponent $Paginator
 */
class SectiongroupsController extends AppController {

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
	
//	    $this->Sectiongroup->recursive=2;
//		$this->Sectiongroup->id='1';
//		  print_r($this->Sectiongroup->read());
//exit;
	
		$this->Sectiongroup->recursive = 0;
		$this->set('sectiongroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Sectiongroup->exists($id)) {
			throw new NotFoundException(__('Invalid sectiongroup'));
		}
		$options = array('conditions' => array('Sectiongroup.' . $this->Sectiongroup->primaryKey => $id));
		$this->set('sectiongroup', $this->Sectiongroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sectiongroup->create();
			if ($this->Sectiongroup->save($this->request->data)) {
				$this->Session->setFlash(__('The sectiongroup has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sectiongroup could not be saved. Please, try again.'));
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
		if (!$this->Sectiongroup->exists($id)) {
			throw new NotFoundException(__('Invalid sectiongroup'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Sectiongroup->save($this->request->data)) {
				$this->Session->setFlash(__('The sectiongroup has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sectiongroup could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Sectiongroup.' . $this->Sectiongroup->primaryKey => $id));
			$this->request->data = $this->Sectiongroup->find('first', $options);
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
		$this->Sectiongroup->id = $id;
		if (!$this->Sectiongroup->exists()) {
			throw new NotFoundException(__('Invalid sectiongroup'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sectiongroup->delete()) {
			$this->Session->setFlash(__('The sectiongroup has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sectiongroup could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
