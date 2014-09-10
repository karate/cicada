<?php

class Account extends AppModel {
	public $validate = array(
        'description' => array(
            'rule' => 'notEmpty'
        )
    );
}

?>