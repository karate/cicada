<?php
class StatsController extends AppController{
	public function index(){
		$this->loadModel('Account');

		$stats['acc_count'] = $this->Account->find('count');
		$accounts = $this->Account->find('all');
		$stats['acc_total_bal'] = 0;

		foreach ($accounts as $account):
			$stats['acc_total_bal'] += $account['Account']['balance'];
		endforeach;

		$this->loadModel('Action');
		$stats['act_count'] = $this->Action->find('count');
		if ($this->request->data)
			$stats['spend'] = $this->request->data['stats']['I want my money to last'];
		else
			$stats['spend'] = null;
		
		$this->set('data', $stats);
	}

}

?>
