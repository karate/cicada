<?php

class AccountsController extends AppController {
	public $helpers = array ('Html', 'Form', 'Session');
	public $components = array('Session');

	public function index() {
		$accounts = $this->Account->find('all');

		$this->set('data', $accounts);
	}

	public function add() {
		if ($this->request->is('post')) {
            $this->Account->create();
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash(__('Your account has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to add your account.'));
        }
	}

	public function delete($id) {
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Account->delete($id)) {
	        $this->Session->setFlash(
	            __('Account has been deleted.')
	        );
	        return $this->redirect(array('action' => 'index'));
	    }

	}

	public function edit($id = NULL) {
		 if (!$id) {
	        throw new NotFoundException(__('Invalid account'));
	    }

	    $account = $this->Account->findById($id);
	    if (!$account) {
	        throw new NotFoundException(__('Invalid account'));
	    }

	    if ($this->request->is(array('account', 'put'))) {
	        $this->Account->id = $id;
	        if ($this->Account->save($this->request->data)) {
	            $this->Session->setFlash(__('Your account has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your account.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $account;
	    }
	}

	public function view($id) {
		if (!$id) {
        	throw new NotFoundException(__('Invalid account'));
        }

        if (is_null($id)) {
        	$account = $this->Account->find('all');
        }
        else {
			$account = $this->Account->findById($id);
        }

		if (!$account) {
        	throw new NotFoundException(__('Invalid account'));
        }

		$this->set('data', $account['Account']);
	}


}

?>