<?php

class ActionsController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session');

	public function index() {
		$this->redirect(array('controller' => 'actions', 'action' => 'view'));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->_create_transaction($this->request->data);
        }

        $this->loadModel('Account');
	    $this->set('accounts', $this->Account->find('list', array('fields' => array('id', 'description'))));

	    $this->loadModel('ActionType');
	    $this->set('action_type', $this->ActionType->find('list', array('fields' => array('id', 'description'))));
	}

	public function delete($id = NULL) {
		if (!$id) {
			throw new NotFoundException(__('Invalid transaction'));
	    }

		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    $this->_delete_transaction($id);
	    return $this->redirect(array('action' => 'index'));
	}

	public function edit($id = NULL) {
		 if (!$id) {
	        throw new NotFoundException(__('Invalid transaction'));
	    }

	    $action = $this->Action->findById($id);

	    if (!$action) {
	        throw new NotFoundException(__('Invalid transaction'));
	    }

	    if ($this->request->is(array('action', 'put'))) {
	    	// delete transaction
	    	$this->_delete_transaction($id);

	    	// add new transaction
	    	$this->_create_transaction($this->request->data);
	    	
	    }

	    if (!$this->request->data) {
	        $this->request->data = $action;
	    }
	    $this->loadModel('Account');
	    $this->set('accounts', $this->Account->find('list', array('fields' => array('id', 'description'))));

	    $this->loadModel('ActionType');
	    $this->set('action_type', $this->ActionType->find('list', array('fields' => array('id', 'description'))));
	}

	public function view($account = NULL) {
		$query = array(
			'fields' => array('Types.id', 'Types.description', 'Accounts.description', 'Action.*'),
			'joins' => array(
			    array(
			        'table' => 'action_types',
			        'alias' => 'Types',
			        'type' => 'left',
			        'conditions'=> array('Action.type = Types.id'),
			    ),
			    array(
			        'table' => 'accounts',
			        'alias' => 'Accounts',
			        'type' => 'left',
			        'conditions'=> array('Action.account = Accounts.id'),
			    )
			),
			'order' => array('Action.date DESC')
		);
		if (!is_null($account)) {
			$query['conditions'] = array('Action.account' => $account);
		}

		$actions = $this->Action->find('all', $query);

		
		foreach ($actions as &$action) { 
			if ($action['Types']['id'] == 1) {
				$action['Action']['ammount'] *= -1;
			}
		}

		$this->set('actions', $actions);
	}

	private function get_transactions($account = NULL) {
		

		return $actions;
	}


	/* * * * * * * * * * * * *
	 *   PRIVATE FUNCTIONS   *
	 * * * * * * * * * * * * */
	private function _delete_transaction($transaction_id) {
		// Load transaction details
	    $action = $this->Action->find('first', array('conditions' => array('Action.id' => $transaction_id)));
	    $ammount = $action['Action']['ammount'];
	    $account_id = $action['Action']['account'];
	    
	    if ($action['Action']['type'] == 1) {
			$ammount *= -1;
		}

    	// If transaction was deleted successfully, update account balance
	    if ($this->Action->delete($transaction_id)) {

	    	// Load account details
	    	$this->loadModel('Account');
	    	$account = $this->Account->find('first', array('conditions' => array('Account.id' => $account_id)));

	    	$balance = $account['Account']['balance'];

	    	// This works even when deleting withdraws ($ammount is negative)
	    	$updated_balance = $balance - $ammount;
	    	
	    	// Update account with new balance
	    	$this->Account->id = $account;
	    	$this->Account->saveField('balance', $updated_balance);

	    	$account_name = $account['Account']['description'];
	        $this->Session->setFlash(
	            __("Transaction has been deleted. New balance of $account_name is: $updated_balance")
	        );
	    }
	}

	private function _create_transaction($details) {
		$this->Action->create();
		if ($this->Action->save($details)) {
			$account_id = $details['Action']['account'];

			$this->loadModel('Account');
			$account = $this->Account->find('first', array('conditions' => array('id' => $account_id)));
			$balance = $account['Account']['balance'];

			$type = $this->request->data['Action']['type'];

			if ($type == '1') {
				$balance -= $details['Action']['ammount'];
			}
			elseif ($type == '2') {
				$balance += $details['Action']['ammount'];	
			}

			$this->Account->id = $account_id;
			if ($this->Account->saveField('balance', $balance)) {
		        $this->Session->setFlash(__('Transaction has been saved. New balance is '. $balance));
		        return $this->redirect(array('action' => 'index'));
			}
		}

		$this->Session->setFlash(__('Unable to save transaction.'));
	}
}

?>