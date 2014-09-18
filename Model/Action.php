<?php

class Action extends AppModel {
	public $validate = array(
        'ammount' => array(
        	'required' => true,
            'rule' => 'notEmpty'
        ),
        'date' => array(
        	'notempty' => array(
        		'required' => true,
            	'rule' => 'notEmpty'
            ),
            'isdate' => array (
            	'rule' => 'date',
            	'message' => 'Enter a valid date'
            )
        )
    );
}

?>