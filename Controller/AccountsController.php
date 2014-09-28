<?php

class AccountsController extends AppController {
	public $helpers = array ('Html', 'Form', 'Session');
	public $components = array('Session', 'RequestHandler');

	public function index() {
		/* 
			Prints default layout (header, footer etc).
			Actual data are fetched via Ajax (see get_accounts)
		*/
	}

	public function get_accounts() {
	    $accounts = $this->Account->find('all');
		$this->set('accounts', $accounts);
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

		// Delete all transactions assosiated with this account.
		$this->loadModel('Action');
		$actions = $this->Action->find('all', array('conditions' => array('Action.account' => $id)));
		foreach ($actions as $action) {
			$this->Action->delete($action['Action']['id']);
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

	public function view($id = NULL) {

		if (!is_null($id)) {
			$account = $this->Account->findById($id);
			if (!$account) {
					throw new NotFoundException(__('Invalid account'));
			}

			// Get full account history
			$this->loadModel('Action');
			$account['Account']['history'] = $this->Action->find('all', array('conditions' => array('Action.account' => $id)));
		}
		else {
			$accounts = $this->Account->find('all');
			$this->set('data', $accounts);
			$this->render('index');
		}
		$this->set('data', $account['Account']);
	}
}

?>
