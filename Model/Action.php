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
            	'rule' => 'isDateOrDatetime',
            	'message' => 'Enter a valid date'
            )
        )
    );

    public function isDateOrDatetime($check) {
        $value = array_values($check);
        $value = $value[0];

        if ($value === date('Y-m-d', strtotime($value)) || $value === date('Y-m-d H:i:s', strtotime($value))) { 
            return true;
        }
    }
}

?>