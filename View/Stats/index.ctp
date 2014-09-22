<h3>The home of every useless information</h3>
<?php
	echo 'You \'re currently an owner of <b>' . $data['acc_count'] . '</b> account(s),';
	echo 'with a total balance of <b>' . $data['acc_total_bal'] . '</b> &euro;.<br>';
	echo 'You made a total of <b>' . $data['act_count'] . '</b> transaction(s) through all your accounts.<br><br>';
	echo 'You can spend <b>' . number_format($data['acc_total_bal']/365, 2, ',', '.') . '</b> &euro; per day for a whole year, before all your money is gone.<br>';

	echo '<div class="row">';
		echo $this->Form->create('stats', array('class' => 'col-md-3 form'));
		echo $this->Form->input(
			'I want my money to last',
			array(
				'div' => array('class' => 'form-group'),
				'class' => 'form-control',
				'placeholder' => 'days'
			)
		);
		echo $this->Form->end(array('label' => 'OK', 'class' => 'btn btn-default'));
	echo '</div>';
	if ($data['spend']) {
	  echo 'You are allowded to spend <b>' . number_format($data['acc_total_bal']/$data['spend'], 2, ',', '.') . '</b> &euro; per day before you are broke.<br>';

	}
?>
