	<?php if (isset($account)): ?>
		<h2><?php echo $account['description']; ?></h2>
	<?php endif; ?>

<?php if (count($actions) == 0) : ?>
	<div class="error">Sorry, no transactions :(</div>
<?php else: ?>

	<table class="table table-hover transactions">
	<tr>
		<th>Type</th>
		<th>Account</th>
		<th>Ammount</th>
		<th>Description</th>
		<th>Tags</th>
		<th>Date / Time</th>
		<th colspan=2>Actions</th>
	</tr>
	<?php foreach ($actions as $action): ?>
		<tr>
			<td><?php echo $action['Type']['description']; ?></td>
			<td><?php echo $this->Html->link($action['Account']['description'], '/accounts/view/' . $action['Action']['account']); ?></td>
			<td class="<?php echo ($action['Action']['ammount'] < 0) ? 'red' : ''; ?>"><?php echo $action['Action']['ammount']; ?></td>
			<td><?php echo $action['Action']['description']; ?></td>
			<td><?php 
					if (isset($action['Tag'])){
						foreach ($action['Tag'] as $tag) {
							echo '<span class="tag">'.$tag['Tag']['name'].'</span>';
						}
					}
				?>
			</td>
			<td><?php echo $this->Time->format('l, F j', $action['Action']['date']); ?></td>
			<td class="action-column">
				<?php 
				// Do not allow edit in corrective transaction types
					if ($action['Type']['id'] != '3') {
						echo $this->Form->postButton(
							'<span class="glyphicon glyphicon-pencil"></span>', 
							array('action' => 'edit', $action['Action']['id']), 
							array('class' => 'btn btn-warning btn-xs', )
						);
					}
				?>
			</td>
			<td class="action-column">
				<?php 
					echo $this->Form->postButton(
						'<span class="glyphicon glyphicon-remove"></span>',
						array('action' => 'delete', $action['Action']['id']),
						array('class' => 'btn btn-danger btn-xs delete-transaction')
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
		'<span class="glyphicon glyphicon-plus"></span> New Transaction',
		array('controller' => 'actions', 'action' => 'add'),
		array('class' => 'btn btn-default', 'escape' => false)
	);
?>

<script>
	$(document).ready(function() {
		$('.delete-transaction').click(function() {
			  return confirm('Are you sure you want to delete this transaction?');
		});
	});
</script>