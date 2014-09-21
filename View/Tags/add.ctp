<h1>Add Tag</h1>
<div class="row">
	<?php
		echo $this->Form->create('Tag', array('class' => 'form col-md-3'));
		echo $this->Form->input(
			'name', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);
		echo $this->Form->input(
			'description', 
			array(
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);
		echo $this->Form->end(array('label' => 'Save Tag', 'class' => 'btn btn-default'));
	?>
</div>