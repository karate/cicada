<table class="table table-hover">
<tr>
	<th>Name</th>
	<th>Description</th>
	<th colspan=2>Actions</th>
</tr>
<?php foreach ($data as $tag): ?>
	<tr>
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
			<?php 
					echo $this->Form->postButton(
						'<span class="glyphicon glyphicon-remove"></span>',
						array('action' => 'delete', $tag['Tag']['id']),
						array('class' => 'btn btn-danger btn-xs delete-tag')
					);
				?>
		 </td>
	</tr>
<?php endforeach; ?>
</table>