<?php

class Account extends AppModel {
	public $validate = array(
		'description' => array(
			'required' => true,
			'rule' => 'notEmpty'
		),
		'balance' => array(
			'required' => true,
			'rule' => 'notEmpty'
		)
	);
}

?>