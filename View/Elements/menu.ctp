<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo $this->webroot; ?>">Cicada</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><?php echo $this->Html->link('Accounts', '/accounts'); ?></li>
				<li><?php echo $this->Html->link('Transactions', '/actions'); ?></li>
				<li><?php echo $this->Html->link('Tags', '/tags'); ?></li>
				<li><?php echo $this->Html->link('Information', '/stats'); ?></li>
			</ul>
		</div>
	</div>
</nav>