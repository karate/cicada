<?php
	//debug($data);
?>

<h2><?php echo $data['description']; ?></h2>

<table class="table table-hover">
<tr><th>Name</th><td><?php echo $data['description']; ?></td></tr>
<tr><th>IBAN</th><td><?php echo $data['iban']; ?></td></tr>
<tr><th>Balance</th><td><?php echo $data['balance']; ?></td></tr>
</table>

<?php
	echo $this->Html->link(
		'Edit account',
		array('action' => 'edit', $data['id']),
		array('class' => 'glyphicon glyphicon-pencil btn btn-default'));

	echo $this->Html->link(
		'View Transactions', 
		array('controller' => 'actions', 'action' => 'view/' . $data['id']),
		array('class' => 'glyphicon glyphicon-list btn btn-default')
	);
?>