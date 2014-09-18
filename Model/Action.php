<?php

class Action extends AppModel {
	public $validate = array(
        'ammount' => array(
<<<<<<< HEAD
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
=======
            'rule' => 'notEmpty'
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
        )
    );
}

?>