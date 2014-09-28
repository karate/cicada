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
		echo $this->Html->link(
			'Cancel', 
			array('action' => 'index'),
			array('class' => 'btn btn-default col-xs-4 col-xs-push-8')
		);
		
		echo $this->Form->end(array('label' => 'Save Tag', 'class' => 'btn btn-success col-xs-7 col-xs-pull-4'));
	?>
</div>