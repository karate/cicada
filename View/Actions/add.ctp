<h1>Add Transaction</h1>
<?php
	echo $this->Form->create('Action');
	echo $this->Form->input('type', array('type'=>'select','options'=>$action_type));
	echo $this->Form->input('account', array('type'=>'select','options'=>$accounts));
	echo $this->Form->input('ammount');
	echo $this->Form->input('date');
	echo $this->Form->end('Save Transaction');
?>