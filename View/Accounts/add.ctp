<h1>Add Account</h1>
<?php
	echo $this->Form->create('Account', array('class' => 'form'));
	echo $this->Form->input(
		'description', 
		array(
			'div' => array('class' => 'form-group'), 
			'class' => 'form-control'
		)
	);
	echo $this->Form->input(
		'iban', 
		array(
			'div' => array('class' => 'form-group'), 
			'class' => 'form-control'
		)
	);
	echo $this->Form->input(
		'balance', 
		array(
			'div' => array('class' => 'form-group'), 
			'class' => 'form-control'
		)
	);
	echo $this->Form->end(array('label' => 'Save Account', 'class' => 'btn btn-default'));
?>
