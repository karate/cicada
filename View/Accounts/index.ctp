<?php
	$total_balance = 0;
?>

<table class="table table-hover">
<tr>
	<th>Accounts (<?php echo count($data); ?>)</th>
	<th>Balance</th>
	<th colspan=2>Actions</th>
</tr>
<?php foreach ($data as $account): ?>
	<?php $total_balance += $account['Account']['balance']; ?>
	<tr>
		<td>
			<?php 
				echo $this->Html->link($account['Account']['description'],'/accounts/view/'.$account['Account']['id']);
			?>
		</td>
		<td><?php echo $account['Account']['balance']; ?></td>
		<td>
			<?php 
				echo $this->Form->postButton(
					'<span class="glyphicon glyphicon-pencil"></span>', 
					array('action' => 'edit', $account['Account']['id']), 
					array('class' => 'btn btn-warning btn-xs')
				); 
			?>
		</td>
		<td>
			<?php 
				 echo $this->Form->postButton(
					'<span class="glyphicon glyphicon-remove"></span>',
					array('action' => 'delete', $account['Account']['id']),
					array('class' => 'btn btn-danger btn-xs delete-account')
				);
			 ?>
		 </td>
	</tr>
<?php endforeach; ?>
	<tr>
		<th>Total</th>
		<th><?php echo $total_balance; ?></th>
		<th colspan=2>&nbsp;</th>
	</tr>
</table>

<?php 
	echo $this->Html->link(
		'<span class="glyphicon glyphicon-plus"></span> Add Account',
		array('controller' => 'accounts', 'action' => 'add'), 
		array('class' => 'btn btn-default', 'escape' => false)
	);
?>

<script>
	$(document).ready(function() {
		$('.delete-account').click(function() {
			return confirm('<?php echo 'Are you sure you want to delete "' . $account['Account']['description'] . '" account?' ?>');
		});
	});
</script>