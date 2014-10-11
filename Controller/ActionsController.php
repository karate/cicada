<?php

class ActionsController extends AppController {
	public $helpers = array ('Html', 'Session');
	public $components = array('Session', 'RequestHandler');

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

		$this->loadModel('Tag');
		$this->set('tags', $this->Tag->find('list', array('fields' => array('id', 'name'))));

	}

	public function delete($id = NULL) {
		if (!$id) {
			throw new NotFoundException(__('Invalid transaction'));
		}

		if ($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		$this->autoRender = false;

		if ($this->_delete_transaction($id)) {
			return true;
		}
		return false;
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

		$this->loadModel('ActionTag');
		$selected_tags = $this->ActionTag->find('all', array('fileds' => array('id', 'name'), 'conditions' => array('ActionTag.action_id' => $id)));
		foreach ($selected_tags as $selected_tag) {
			$this->request->data['Action']['tags'][] = $selected_tag['ActionTag']['tag_id'];
		}
		
		$this->loadModel('Tag');
		$tags = $this->Tag->find('list', array('fields' => array('id', 'name')));
		$this->set('tags', $tags);
	}

	public function view($account = NULL) {
		/* 
			Prints default layout (header, footer etc).
			Actual data are fetched via Ajax (see get_actions)
		*/
	}

	public function get_actions($account = null, $limit = null, $tag = null) {
        $actions = $this->_get_transactions($account);
		$this->set('data', $actions);
	}


	/* * * * * * * * * * * * *
	 *   PRIVATE FUNCTIONS   *
	 * * * * * * * * * * * * */
	private function _get_transactions($account = null, $tag = null) {
		$query = array(
			'fields' => array('Type.id', 'Type.description', 'Account.description', 'Account.balance', 'Action.*',),
			'joins' => array(
				array(
					'table' => 'action_types',
					'alias' => 'Type',
					'type' => 'left',
					'conditions'=> array('Action.type = Type.id'),
				),
				array(
					'table' => 'accounts',
					'alias' => 'Account',
					'type' => 'left',
					'conditions'=> array('Action.account = Account.id'),
				),
			),
			'order' => array('Action.date DESC'),
		);

		if (!is_null($account)) {
			$query['conditions'] = array('Action.account' => $account);
			$this->loadModel('Account');
			$account = $this->Account->find('first', array('conditions' => array('Account.id' => $account)));
			$this->set('account', $account['Account']);
		}

		if (!is_null($tag)) {
			// Implement filter by tag...
		}

		$actions = $this->Action->find('all', $query);

		
		foreach ($actions as &$action) { 
			if ($action['Type']['id'] == 1) {
				$action['Action']['ammount'] *= -1;
			}
		}

		$this->loadModel('ActionTags');
		foreach ($actions as &$action) {
			$action_id = $action['Action']['id'];
			$query = array(
				'fields' => array('ActionTags.*', 'Tag.id', 'Tag.name'),
				'joins' =>array(
					array(
						'table' => 'tags',
						'alias' => 'Tag',
						'type' => 'left',
						'conditions'=> array('Tag.id = ActionTags.tag_id'),
					),
				),
				'conditions' => array(
					'ActionTags.action_id' => $action_id,
				),
			);

			$tag = $this->ActionTags->find('all', $query);
			if ($tag) {
				$action['Tag'] = $tag;	
			}

		}
		return $actions;
	}

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

			// Delete action-tag associations
			$this->loadModel('ActionTag');
			$this->ActionTag->deleteAll(array('ActionTag.action_id' => $transaction_id));

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

			return true;
		}
		else {
			return false;
		}
	}

	private function _create_transaction($details) {
		if ($this->Action->save($details)) {
			$account_id = $details['Action']['account'];


			// Save action-tag association in action_tags table
			$this->loadModel('ActionTag');
			foreach ($details['Action']['tags'] as $tag) {
				$this->ActionTag->create();
				$this->ActionTag->saveField('action_id', $this->Action->getLastInsertId());
				$this->ActionTag->saveField('tag_id', $tag);
			}

			$this->loadModel('Account');
			$account = $this->Account->find('first', array('conditions' => array('id' => $account_id)));
			$balance = $account['Account']['balance'];

			$type = $this->request->data['Action']['type'];

			if ($type == '1') {
				$balance -= $details['Action']['ammount'];
			}
			elseif ($type == '2' || $type == '3') {
				$balance += $details['Action']['ammount'];  
			}

			// Save account balance in transaction
			$this->Action->saveField('balance', $balance);

			// Update balance in account
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
