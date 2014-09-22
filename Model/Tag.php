<?php

class Tag extends AppModel {
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => 'notEmpty',
				'message' => 'You have to give a name'

			),
			'maxlength' => array (
				'rule' =>  array('maxLength', 20),
				'message' => 'Tag name must be 20 characters length at most'
			)
		),
	);
}

?>