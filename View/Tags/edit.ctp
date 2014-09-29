<h1>Edit Tag</h1>
<div class="row">
	<?php
		echo $this->Form->create('Tag', array('class' => 'form col-md-3'));
		
		// Name
		echo $this->Form->input(
			'name', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);

		// Description
		echo $this->Form->input(
			'description', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);

		// Submit
		echo $this->Form->submit('Save Tag', array('class' => 'btn btn-success col-xs-7'));
		
		// Cancel
		echo $this->Html->link(
			'Cancel', 
			array('action' => 'index'), 
			array('class' => 'btn btn-default col-xs-4 col-xs-offset-1')
		);

		echo $this->Form->end();
	?>
</div>