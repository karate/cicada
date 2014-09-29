<h1>Edit Account</h1>
<div class="row">
	<?php
		echo $this->Form->create('Account', array('class' => 'form col-md-3'));

		// Description
		echo $this->Form->input(
			'description', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control',
			)
		);

		// IBAN
		echo $this->Form->input(
			'iban', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control',
			)
		);

		// Balance
		echo $this->Form->input(
			'balance',
			array(
				'div' => array('class' => 'form-group'),
				'class' => 'form-control',
				'readonly' => true,
				'type' => 'text',
			)
		);

		// Submit
		echo $this->Form->submit('Save Account', array('class' => 'btn btn-success col-xs-7'));
		
		// Cancel
		echo $this->Html->link(
			'Cancel', 
			array('action' => 'index'), 
			array('class' => 'btn btn-default col-xs-4 col-xs-offset-1')
		);

		echo $this->Form->end();
	?>
</div>