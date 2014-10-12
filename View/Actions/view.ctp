<h1>Transactions</h1>
<div id="transactions">
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
		url: '<?php echo Router::url(array('controller'=>'actions','action'=>'get_actions'));?>',
		data: ({type:'original'}),
		success: function (data, textStatus){
			$("#transactions").hide().html(data);
		},
		complete: function (data) {
			$("#transactions").slideDown(400);

			setTimeout(function(){
				$('#add-action').hide().removeClass('invisible').fadeIn();
			}, 400);
		}
	});
</script>