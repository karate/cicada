<?php if(empty($data)): ?>

	<div class="alert alert-warning">Sorry, no tags :(</div>

<?php else: ?>

	<table class="table table-hover">
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th colspan=2>Actions</th>
	</tr>
	<?php foreach ($data as $tag): ?>
		<tr class="tag-row" data-tag="<?php echo $tag['Tag']['id']; ?>">
			<td><?php echo $tag['Tag']['name']; ?></td>
			<td><?php echo $tag['Tag']['description']; ?></td>
			<td class="action-column">
				<?php 
					echo $this->Form->postButton(
						'<span class="glyphicon glyphicon-pencil"></span>', 
						array('action' => 'edit', $tag['Tag']['id']), 
						array('class' => 'btn btn-warning btn-xs')
					); 
				?>
			</td>
			<td class="action-column">
				<button type="button" class="btn btn-danger btn-xs delete-tag" data-tag="<?php echo $tag['Tag']['id']; ?>">
					<span class="glyphicon glyphicon-remove"></span>
				</button>
			 </td>
		</tr>
	<?php endforeach; ?>
	</table>

<?php endif; ?>

<?php 
	echo $this->Html->link(
		'<span class="glyphicon glyphicon-plus"></span> Add Tag',
		array('controller' => 'tags', 'action' => 'add'), 
		array('class' => 'btn btn-primary invisible', 'escape' => false, 'id' => 'add-tag')
	);
?>

<script>	
$('.delete-tag').click(function() {
	  var conf = confirm('Are you sure you want to delete this tag?');
	  if (conf == true) {
	  	var tag = $(this).data('tag');
	  	$('tr.tag-row[data-tag='+tag+']').fadeOut(function() {
		    	console.error('deleting tag ' + tag);
		    	$.ajax({
					dataType: "html",
					type: "POST",
					cache: false,
					url: '<?php echo Router::url(array('controller'=>'tags','action'=>'delete'));?>/' + tag,
		  		});
			});
		}
});
</script>