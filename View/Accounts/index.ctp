<h1>Accounts</h1>
<div id="accounts">
	<div class="loading-icon">
		<img src="<?php echo $this->webroot; ?>/img/loading.gif" alt="loading" height="32" width="32"/>
	</div>
</div>

<script>
		$.ajax({
			dataType: "html",
			type: "POST",
			cache: false,
			evalScripts: true,
			url: '<?php echo Router::url(array('controller'=>'accounts','action'=>'get_accounts'));?>',
			data: ({type:'original'}),
			success: function (data, textStatus){
				if (data.length == 0) {
					$("#accounts").html('<div class="error">Sorry, no accounts :(</div>');
				}
				else {
					$("#accounts").hide().html(data);
				}
				
				$('.delete-account').click(function() {
					  return confirm('Are you sure you want to delete this account?');
				});
			},
			complete: function (data) {
						
				var $button = $('<?php 
					echo $this->Html->link(
						'<span class="glyphicon glyphicon-plus"></span> Add Account',
						array('controller' => 'accounts', 'action' => 'add'), 
						array('class' => 'btn btn-primary invisible', 'escape' => false)
					);
				?>');

				$("#accounts").append($button);
				$("#accounts").slideDown(400);

				setTimeout(function(){
					$button.hide().removeClass('invisible').fadeIn();
				}, 400);
			}
		});
</script>