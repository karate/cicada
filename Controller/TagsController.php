<?php
class TagsController extends AppController{
	public $components = array('Session', 'RequestHandler');

	public function index() {
		/* 
			Prints default layout (header, footer etc).
			Actual data are fetched via Ajax (see get_tags)
		*/
	}

	public function get_tags() {
		$tags = $this->Tag->find('all');
		$this->set('data', $tags);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Tag->save($this->request->data);
			return $this->redirect(array('action' => 'index'));
		}
	}
	
	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid tag'));
		}

		$tag = $this->Tag->findById($id);
		if (!$tag) {
			throw new NotFoundException(__('Invalid tag'));
		}

		if ($this->request->is(array('account', 'put'))) {
			$this->Tag->id = $id;
			if ($this->Tag->save($this->request->data)) {
				$this->Session->setFlash(__('Tag "'.$this->request->data['Tag']['name'].'" has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update tag.'));
		}

		if (!$this->request->data) {
			$this->request->data = $tag;
		}
	}

	public function delete($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid transaction'));
		}

		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}
		
		$this->autoRender = false;

		if ($this->Tag->delete($id)) {
			return true;
		}
		return false;
	}
}

?>
