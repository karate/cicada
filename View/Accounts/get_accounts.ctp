<?php
	if(empty($accounts)) {
		return;
	}
	$total_balance = 0;
?>
<table class="table table-hover">
<tr>
	<th>Accounts (<?php echo count($accounts); ?>)</th>
	<th>Balance</th>
	<th colspan=2>Actions</th>
</tr>
<?php foreach ($accounts as $account): ?>
	<?php $total_balance += $account['Account']['balance']; ?>
	<tr>
		<td>
			<?php 
				echo $this->Html->link($account['Account']['description'],'/accounts/view/'.$account['Account']['id']);
			?>
		</td>
		<td><?php echo $account['Account']['balance']; ?></td>
		<td class="action-column">
			<?php 
				echo $this->Form->postButton(
					'<span class="glyphicon glyphicon-pencil"></span>', 
					array('action' => 'edit', $account['Account']['id']), 
					array('class' => 'btn btn-warning btn-xs')
				); 
			?>
		</td>
		<td class="action-column">
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