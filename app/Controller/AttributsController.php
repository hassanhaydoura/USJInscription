<?php
App::uses('AppController', 'Controller');
/**
 * Attributs Controller
 *
 * @property Attribut $Attribut
 * @property PaginatorComponent $Paginator
 */
class AttributsController extends AppController {

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
		$this->Attribut->recursive = 0;
		$this->set('attributs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Attribut->exists($id)) {
			throw new NotFoundException(__('Invalid attribut'));
		}
		$options = array('conditions' => array('Attribut.' . $this->Attribut->primaryKey => $id));
		$this->set('attribut', $this->Attribut->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Attribut->create();
			if ($this->Attribut->save($this->request->data)) {
				$this->Session->setFlash(__('The attribut has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribut could not be saved. Please, try again.'));
			}
		}
		$sections = $this->Attribut->Section->find('list');
		$this->set(compact('sections'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Attribut->exists($id)) {
			throw new NotFoundException(__('Invalid attribut'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Attribut->save($this->request->data)) {
				$this->Session->setFlash(__('The attribut has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attribut could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Attribut.' . $this->Attribut->primaryKey => $id));
			$this->request->data = $this->Attribut->find('first', $options);
		}
		$sections = $this->Attribut->Section->find('list');
		$this->set(compact('sections'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Attribut->id = $id;
		if (!$this->Attribut->exists()) {
			throw new NotFoundException(__('Invalid attribut'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Attribut->delete()) {
			$this->Session->setFlash(__('The attribut has been deleted.'));
		} else {
			$this->Session->setFlash(__('The attribut could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
