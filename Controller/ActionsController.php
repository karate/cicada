<?php

class ActionsController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session');

	public function index() {
		$this->redirect(array('controller' => 'actions', 'action' => 'view'));
	}

	public function add() {
		if ($this->request->is('post')) {
            $this->Action->create();
            if ($this->Action->save($this->request->data)) {
            	$acc_id = $this->request->data['Action']['account'];

            	$this->loadModel('Account');
            	$this->Account->id = $acc_id;
            	$account = $this->Account->find('first', array('conditions' => array('id' => $acc_id)));
            	$balance = $account['Account']['balance'];

            	$type = $this->request->data['Action']['type'];

            	if ($type == '1') {
            		$balance -= $this->request->data['Action']['ammount'];
            	}
            	elseif ($type == '2') {
            		$balance += $this->request->data['Action']['ammount'];	
            	}

            	if ($this->Account->saveField('balance', $balance)) {
	                $this->Session->setFlash(__('Transaction has been saved. New balance is '. $balance));
	                return $this->redirect(array('action' => 'index'));
            	}
            }
            $this->Session->setFlash(__('Unable to save transaction.'));
        }

        $this->loadModel('Account');
	    $this->set('accounts', $this->Account->find('list', array('fields' => array('id', 'description'))));

	    $this->loadModel('ActionType');
	    $this->set('action_type', $this->ActionType->find('list', array('fields' => array('id', 'description'))));
	}

	public function delete($id, $account, $ammount) {
		if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

    	// If transaction was deleted successfully, update account balance
	    if ($this->Action->delete($id)) {

	    	$this->loadModel('Account');
	    	$account = $this->Account->find('first', array('conditions' => array('Account.id' => $account)));

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
	        $this->Action->id = $id;
	        if ($this->Action->save($this->request->data)) {
	            $this->Session->setFlash(__('Transaction has been updated.'));
	            return $this->redirect(array('action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update transaction.'));
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
}

?>