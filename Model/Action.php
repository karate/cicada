<?php

class Action extends AppModel {
	public $validate = array(
		'ammount' => array(
			'notempty' => array (
				'rule' => 'notEmpty',
				'message' => 'Enter a valid ammount'
			),
			'isnumber'=> array(
				'rule' => 'numeric',
				'message' => 'Enter a valid ammount'  
			)
		),
		'date' => array(
			'notempty' => array(
				'required' => true,
				'rule' => 'notEmpty',
				'message' => 'Enter a valid date'
			),
			'isdate' => array (
				'rule' => 'isDateOrDatetime',
				'message' => 'Enter a valid date'
			)
		)
	);

	public function isDateOrDatetime($check) {
		$value = $check['date'];

		if ($value === date('Y-m-d', strtotime($value)) || $value === date('Y-m-d H:i:s', strtotime($value))) { 
			return true;
		}
	}
}

?>