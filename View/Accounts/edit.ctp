<h1>Edit Account</h1>
<?php
<<<<<<< HEAD
	echo $this->Form->create('Account', array('class' => 'form form-horizontal'));
=======
	echo $this->Form->create('Account', array('class' => 'form'));
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
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
<<<<<<< HEAD
?>
=======
?>
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
