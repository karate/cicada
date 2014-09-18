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
		
	</div>
	<div class="account-graphs col-md-9">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
</div>

<?php
	echo $this->Html->link(
		'Edit account',
		array('action' => 'edit', $data['id']),
		array('class' => 'glyphicon glyphicon-pencil btn btn-default'));

	echo $this->Html->link(
		'View Transactions', 
		array('controller' => 'actions', 'action' => 'view/' . $data['id']),
		array('class' => 'glyphicon glyphicon-list btn btn-default')
	);
?>

<script>

	var data = {
		<?php 
		echo 'labels: [';
		foreach ($data['history'] as $transaction) {
			echo '"' . $transaction['Action']['date'] . '",';
		}
		echo '],';
		?>
	    datasets: [
	        {
	            label: "My First dataset",
	            fillColor: "rgba(220,220,220,0.2)",
	            strokeColor: "rgba(220,220,220,1)",
	            pointColor: "rgba(220,220,220,1)",
	            pointStrokeColor: "#fff",
	            pointHighlightFill: "#fff",
	            pointHighlightStroke: "rgba(220,220,220,1)",
	            <?php 
					echo 'data: [';
					foreach ($data['history'] as $transaction) {
						$ammount = $transaction['Action']['ammount'];
						if ($transaction['Action']['type'] == "1")
							$ammount *= -1;
						echo $ammount . ',';
					}
					echo '],';
				?>
	        },
	    ]
	};

	var options = {};

	// Get context with jQuery - using jQuery's .get() method.
	var ctx = $("#myChart").get(0).getContext("2d");
	// This will get the first returned node in the jQuery collection.

	var myNewChart = new Chart(ctx).Line(data, options);

</script>