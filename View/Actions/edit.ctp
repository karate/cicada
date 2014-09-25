<h1>Edit Transaction</h1>
<div class="row">
	<?php
		echo $this->Form->create('Action', array('class' => 'form col-md-3'));

		echo $this->Form->input(
			'type', 
			array(
				'type'=>'select',
				'options'=>$action_type, 
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);
		
		echo $this->Form->input(
			'account', 
			array(
				'type'=>'select',
				'options'=>$accounts, 
				'div' => array('class' => 'form-group'), 
				'class' => 'form-control'
			)
		);

		echo $this->Form->input(
			'ammount', 
			array(
				'class' => 'form-control',
				'div' => array('class' => 'form-group')
			)
		);

		echo $this->Form->input(
			'description', 
			array(
				'class' => 'form-control',
				'div' => array('class' => 'form-group'),
			)
		);
		
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

		echo $this->Form->input(
			'date', 
			array(
				'class' => 'form-control datepicker',
				'div' => array('class' => 'form-group'), 
				'type' => 'text', 
				'label' => false
			)
		);

		echo $this->Form->end(array('label' => 'Save Transaction', 'class' => 'btn btn-default'));


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