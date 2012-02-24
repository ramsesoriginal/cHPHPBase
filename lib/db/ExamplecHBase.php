<?php
/*class cHBase  implements IcHModel*/// static::Doesn't work until php 5.3
abstract class cHBase{
	
    private static $flash_Messages = array();
    private static $error_Messages = array();

	public $id;

    function __construct() {
        $id=1;
     }

	public function save(){
     $this->flash("successfully saved");   
    }
	public function delete(){
     $this->flash("successfully deleted");   
    }
    public function update($new_object){
     $this->flash("successfully updated");   
    }
    public function validationErrors(){
     return;   
    }
   
    // static::Doesn't work until php 5.3
    abstract public static function create($new_object=null);/*{
        self::flash("successfully created"); 
        return new static::__CLASS__;
    }*/

    // static::Doesn't work until php 5.3
    abstract public static function find();/* {
        for ($i = 0;$i < func_num_args();$i++) {
          $field = func_get_arg($i);
          $value = func_get_arg($i+1);
          $i++;
        }
        return array(new static::create(), new static::create(), new static::create());
    }*/

    // static::Doesn't work until php 5.3
    abstract public static function find_by_id($id);/* {
        $$id="";
        return new static::create();
    }*/

    public static function flash($message="") {
        if (!empty($message))
            self::$flash_Messages[] = $message;
        return self::$flash_Messages;
    }

    public static function error($message="") {
        if (!empty($message))
            self::$error_Messages[] = $message;
        return self::$error_Messages;
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Calling ".$name." method";
    }
}
?>