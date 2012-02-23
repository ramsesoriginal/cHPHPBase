<?php
class Example extends cHBase{
	public $value;
	function __construct() {
        parent::__construct();
        $this->value=rand();
     }
}
?>