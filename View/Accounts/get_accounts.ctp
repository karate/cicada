<?php
	if(empty($data)) {
		return;
	}
	$total_balance = 0;
?>

<table class="table table-hover">
<tr>
	<th>Account name</th>
	<th>Balance</th>
	<th colspan=2>Actions</th>
</tr>
<?php foreach ($data as $account): ?>
	<?php $total_balance += $account['Account']['balance']; ?>
	<tr class="account-row" data-account="<?php echo $account['Account']['id']; ?>">
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
			<button type="button" class="btn btn-danger btn-xs delete-account" data-account="<?php echo $account['Account']['id']; ?>">
				<span class="glyphicon glyphicon-remove"></span>
			</button>
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
		array('class' => 'btn btn-primary invisible', 'escape' => false, 'id' => 'add-account')
	);
?>

<script>	
$('.delete-account').click(function() {
	  var conf = confirm('Are you sure you want to delete this account?');
	  if (conf == true) {
	  	var account = $(this).data('account');
	  	$('tr.account-row[data-account='+account+']').fadeOut(function() {
		    	console.error('deleting account ' + account);
		    	$.ajax({
					dataType: "html",
					type: "POST",
					cache: false,
					url: '<?php echo Router::url(array('controller'=>'accounts','action'=>'delete'));?>/' + account,
		  		});
			});
		}
});
</script>