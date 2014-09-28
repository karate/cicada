<h1>Edit Account</h1>
<div class="row">
	<?php
		echo $this->Form->create('Account', array('class' => 'form col-md-3'));
		echo $this->Form->input(
			'description', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control',
			)
		);
		echo $this->Form->input(
			'iban', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control',
			)
		);
		echo $this->Form->input(
			'balance',
			array(
				'div' => array('class' => 'form-group'),
				'class' => 'form-control',
				'readonly' => true,
				'type' => 'text',
			)
		);
				echo $this->Html->link(
			'Cancel', 
			array('action' => 'index'),
			array('class' => 'btn btn-default col-xs-4 col-xs-push-8')
		);
		
		echo $this->Form->end(array('label' => 'Save Account', 'class' => 'btn btn-success col-xs-7 col-xs-pull-4'));
	?>
</div>