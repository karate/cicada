<h1>Edit Transaction</h1>
<div class="row">
	<?php
		echo $this->Form->create('Action', array('class' => 'form col-md-3'));

		// Action type
		echo $this->Form->input(
			'type', 
			array(
				'type' => 'select',
				'options'=> $action_type, 
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);
		
		// Account
		echo $this->Form->input(
			'account', 
			array(
				'type' => 'select',
				'options'=> $accounts, 
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);

		// Ammount
		echo $this->Form->input(
			'ammount', 
			array(
				'class' => 'form-control',
				'div' => array('class' => 'form-group'),
				'type' => 'text',
			)
		);

		// Transaction description
		echo $this->Form->input(
			'description', 
			array(
				'class' => 'form-control',
				'div' => array('class' => 'form-group'),
			)
		);
		
		// Tags
		echo $this->Form->input(
			'tags', 
			array(
				'type' => 'select',
				'options'=> $tags, 
				'multiple' => true,
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);

		// Date
		echo $this->Form->input(
			'date', 
			array(
				'class' => 'form-control datepicker',
				'div' => array('class' => 'form-group'), 
				'type' => 'text', 
				'label' => false
			)
		);

		// Submit
		echo $this->Form->submit('Save Transaction', array('class' => 'btn btn-success col-xs-7'));
		
		// Cancel
		echo $this->Html->link(
			'Cancel', 
			array('action' => 'view'), 
			array('class' => 'btn btn-default col-xs-4 col-xs-offset-1')
		);

		echo $this->Form->end();

		echo $this->Html->css('bootstrap-datepicker');
		echo $this->Html->script('datepicker');
	?>
</div>

<script>
	(function($) {
	$(document).ready(function() {
		$(".datepicker").datepicker();
	});
})(jQuery);
</script>