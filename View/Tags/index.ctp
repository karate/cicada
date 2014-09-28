<h1>Tags</h1>

<div id="tags">
	<div class="loading-icon">
		<img src="<?php echo $this->webroot; ?>/img/loading.gif" alt="loading" height="32" width="32"/>
	</div>
</div>

<?php 
	echo $this->Html->link(
		'<span class="glyphicon glyphicon-plus"></span> Add Tag',
		array('controller' => 'tags', 'action' => 'add'), 
		array('class' => 'btn btn-default', 'escape' => false)
	);
?>

<script>
	$.ajax({
			dataType: "html",
			type: "POST",
			cache: false,
			evalScripts: true,
			url: '<?php echo Router::url(array('controller'=>'tags','action'=>'get_tags'));?>',
			data: ({type:'original'}),
			success: function (data, textStatus){
				if (data.length == 0) {
					$("#tags").html('<div class="error">Sorry, no tags :(</div>');
				}
				else {
					$("#tags").hide().html(data).slideDown();
				}

				$('.delete-tag').click(function() {
					return confirm('Are you sure you want to delete this tag?');
				});
			}
		});
</script>