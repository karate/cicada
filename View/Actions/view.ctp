	<?php if (isset($account)): ?>
		<h2><?php echo $account['description']; ?></h2>
	<?php endif; ?>

	<div id="transactions">
		<div class="loading-icon">
			<img src="<?php echo $this->webroot; ?>/img/loading.gif" alt="loading" height="32" width="32"/>
		</div>
	</div>

<?php 
	echo $this->Html->link(
		'<span class="glyphicon glyphicon-plus"></span> New Transaction',
		array('controller' => 'actions', 'action' => 'add'),
		array('class' => 'btn btn-default', 'escape' => false)
	);
?>

<script>
	$(document).ready(function() {

		$.ajax({
			dataType: "html",
			type: "POST",
			cache: false,
			evalScripts: true,
			url: '<?php echo Router::url(array('controller'=>'actions','action'=>'get_actions'));?>',
			data: ({type:'original'}),
			success: function (data, textStatus){
				if (data.length == 0) {
					$("#transactions").html('<div class="error">Sorry, no transactions :(</div>');
				}
				else {
					$("#transactions").html(data);
				}
				
				$('.delete-transaction').click(function() {
					  return confirm('Are you sure you want to delete this transaction?');
				});
			}
		});
	});
</script>