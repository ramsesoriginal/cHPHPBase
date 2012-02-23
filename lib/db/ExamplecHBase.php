<?php
class cHBase implements IcHModel{
	
    private static $flash_Messages;
    private static $error_Messages;

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
    public static function create($new_object){
        $this->flash("successfully created"); 
        // static::Doesn't work until php 5.3
        $classname=self::className();
        return new $classname;
    }
    public static function find($query=null) {
        $classname=self::className();
        $$query="";
        // static::Doesn't work until php 5.3
        return array(new $classname, new $classname, new $classname);
    }
    public static function find_by_id($id) {
        $classname=self::className();
        $$id="";
        // static::Doesn't work until php 5.3
        return new $classname;
    }

    public static function flash($message="") {
        return "staticflash_Messages".$message;
    }

    public static function error($message="") {
        return "staticerror_Messages".$message;
    }

    public static function className() {
        return get_called_class();
    }

    public static function __callStatic($name, $arguments)
    {
        echo "Calling undefined method";
    }
}
?>