<h1>Add Transaction</h1>
<?php
<<<<<<< HEAD
	echo $this->Form->create('Action', array('class' => 'form form-horizontal'));
=======
	echo $this->Form->create('Action', array('class' => 'form'));
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a

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
			'div' => array('class' => 'form-group'),
		)
	);

	echo $this->Form->input(
		'date', 
		array(
			'class' => 'form-control datepicker',
			'div' => array('class' => 'form-group'), 
			'type' => 'text', 
<<<<<<< HEAD
			'label' => false,
			'default' => date('Y-m-d H:i:s', time())
=======
			'label' => false
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
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
<<<<<<< HEAD
</script>
=======
</script>
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
