<h1>Add Account</h1>
<?php
	echo $this->Form->create('Account');
	echo $this->Form->input('description');
	echo $this->Form->input('iban');
	echo $this->Form->input('balance');
	echo $this->Form->end('Save Account');
?>