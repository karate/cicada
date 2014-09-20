<h1>Edit Transaction</h1>
<?php
	echo $this->Form->create('Action', array('class' => 'form'));

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
<script>
	(function($) {
    $(document).ready(function() {

        $(".datepicker").datepicker()
         //       .on('show', function(ev) {
        //    var today = new Date();
        //   var t = today.getDate() + "-" + (today.getMonth() + 1) + "-" + today.getFullYear();
        //    $('.datepicker').data({date: t}).datepicker('update');
       // });
    });
})(jQuery);
</script>