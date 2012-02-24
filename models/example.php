<?php
class Example extends cHBase{
	public $value;
	function __construct() {
        parent::__construct();
        $this->value=rand();
     }

     // can be delited when php 5.3
    public static function create($new_object=null){
        self::flash("successfully created"); 
        return new Example;
    }

     // can be delited when php 5.3
    public static function find() {
        return array(self::create(), self::create(), self::create());
    }

     // can be delited when php 5.3
    public static function find_by_id($id) {
        $$id="";
        return self::create();
    }
}	
?>