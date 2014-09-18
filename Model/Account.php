<?php

class Account extends AppModel {
	public $validate = array(
        'description' => array(
<<<<<<< HEAD
        	'required' => true,
            'rule' => 'notEmpty'
        ),
        'balance' => array(
        	'required' => true,
=======
>>>>>>> d306149d8cd0f6837b711844470b8ccb0ddf871a
            'rule' => 'notEmpty'
        )
    );
}

?>