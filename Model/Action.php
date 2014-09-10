<?php

class Action extends AppModel {
	public $validate = array(
        'ammount' => array(
            'rule' => 'notEmpty'
        )
    );
}

?>