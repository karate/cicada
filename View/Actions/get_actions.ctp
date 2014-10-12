<?php if(empty($data)): ?>

	<div class="alert alert-warning">Sorry, no transactions :(</div>

<?php else: ?>
	<table class="table table-hover">
		<tr>
			<th>Type</th>
			<th>Account</th>
			<th>Ammount</th>
			<th>Description</th>
			<th>Tags</th>
			<th>Date / Time</th>
			<th colspan=2>Actions</th>
		</tr>
		<?php foreach ($data as $action): ?>
			<tr class="action-row" data-action="<?php echo $action['Action']['id']; ?>">
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
					echo $this->Form->postButton(
						'<span class="glyphicon glyphicon-pencil"></span>', 
						array('action' => 'edit', $action['Action']['id']), 
						array('class' => 'btn btn-warning btn-xs')
					); 
				?>
				</td>
				<td class="action-column">
					<button type="button" class="btn btn-danger btn-xs delete-action" data-action="<?php echo $action['Action']['id']; ?>">
						<span class="glyphicon glyphicon-remove"></span>
					</button>
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
		array('class' => 'btn btn-primary invisible', 'escape' => false, 'id' => 'add-action')
	);
?>

<script>	
$('.delete-action').click(function() {
	  var conf = confirm('Are you sure you want to delete this transaction?');
	  if (conf == true) {
	  	var action = $(this).data('action');
	  	$('tr.action-row[data-action='+action+']').fadeOut(function() {
		    	console.error('deleting action ' + action);
		    	$.ajax({
					dataType: "html",
					type: "POST",
					cache: false,
					url: '<?php echo Router::url(array('controller'=>'actions','action'=>'delete'));?>/' + action,
		  		});
			});
		}
});
</script>