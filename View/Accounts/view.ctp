<?php
	echo $this->Html->script('Chart.js/Chart.Core');
	echo $this->Html->script('Chart.js/Chart.Line');
?>

<h2><?php echo $data['description']; ?></h2>

<div class="row">
	<div class="account-info col-md-3">
		<table class="table table-hover">
		<tr><th>Name</th><td><?php echo $data['description']; ?></td></tr>
		<tr><th>IBAN</th><td><?php echo $data['iban']; ?></td></tr>
		<tr><th>Balance</th><td><?php echo $data['balance']; ?></td></tr>
		</table>
		<?php
			echo $this->Html->link(
				'<span class="glyphicon glyphicon-pencil"></span> Edit account',
				array('action' => 'edit', $data['id']),
				array('class' => 'btn btn-default', 'escape' => false));

			echo $this->Html->link(
				'<span class="glyphicon glyphicon-list"></span> View Transactions', 
				array('controller' => 'actions', 'action' => 'view/' . $data['id']),
				array('class' => 'btn btn-default', 'escape' => false)
			);
		?>
		
	</div>
	<div class="account-graphs col-md-9">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
</div>


<script>
	var data = {
		labels: [
		<?php 
			foreach ($data['history'] as $transaction) {
				echo '"' . $transaction['Action']['date'] . '",';
			}
		?>
		],
		datasets: [
			{
				label: "History",
				fillColor: "rgba(20,250,40,0.2)",
				strokeColor: "rgba(220,220,220,1)",
				pointColor: "rgba(220,220,220,1)",
				pointStrokeColor: "#fff",
				pointHighlightFill: "#fff",
				pointHighlightStroke: "rgba(220,220,220,1)",
				data: [
				<?php 
					foreach ($data['history'] as $transaction) {
						echo $transaction['Action']['balance'] . ',';
					}
				?>
				],
				descriptions: [
				<?php 
					foreach ($data['history'] as $transaction) {
						echo '"' . $transaction['Action']['description'] . '",';
					}
				?>
				]
			},
		],
	};

	var options = {
		tooltipTemplate: "<%= value %>: \"<%= description %>\"",
	};

	// Get context with jQuery - using jQuery's .get() method.
	var ctx = $("#myChart").get(0).getContext("2d");
	// This will get the first returned node in the jQuery collection.

	var myNewChart = new Chart(ctx).Line(data, options);

</script>
