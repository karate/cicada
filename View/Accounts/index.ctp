<?php
	$total_balance = 0;
?>

<table>
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
		<td><?php echo $this->Html->link('edit', array('action' => 'edit', $account['Account']['id'])); ?></td>
		<td>
			<?php 
				 echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $account['Account']['id']),
                    array('confirm' => 'Are you sure you want to delete '.$account['Account']['description'].'?')
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
	    'Add Account',
	    array('controller' => 'accounts', 'action' => 'add')
	);
?>
