	<?php if (isset($account)): ?>
		<h2><?php echo $account['description']; ?></h2>
	<?php endif; ?>

<?php if (count($actions) == 0) : ?>
	<div class="error">Sorry, no transactions :(</div>
<?php else: ?>

	<table>
	<tr>
		<th>Type</th>
		<th>Account</th>
		<th>Ammount</th>
		<th>Date / Time</th>
		<th colspan=2>Actions</th>
	</tr>
	<?php foreach ($actions as $action): ?>
		<tr>
			<td><?php echo $action['Types']['description']; ?></td>
			<td><?php echo $this->Html->link($action['Accounts']['description'], '/accounts/view/' . $action['Action']['account']); ?></td>
			<td class="<?php echo ($action['Action']['ammount'] < 0) ? 'red' : ''; ?>"><?php echo $action['Action']['ammount']; ?></td>
			<td><?php echo $this->Time->format('l, F j', $action['Action']['date']); ?></td>
			<td><?php echo $this->Html->link('edit', array('action' => 'edit', $action['Action']['id'])); ?></td>
			<td>
				<?php 
					echo $this->Form->postLink(
		                'Delete',
		                array('action' => 'delete', $action['Action']['id']),
		                array('confirm' => 'Are you sure you want to delete this transaction?')
		            );
	            ?>
	        </td>
		</tr>

	<?php endforeach; ?>
	
	<?php if (isset($account)): ?>
		<tr><th>Total</th><th><?php echo $account['description']; ?></th><th><?php echo $account['balance']; ?><th><th colspan=2>&nbsp;</th></tr>
	<?php endif; ?>

	</table>

<?php endif; ?>

<?php 
	echo $this->Html->link(
	    'New Transaction',
	    array('controller' => 'actions', 'action' => 'add')
	);
?>