<?php
Interface IcHModel {
	public function save();
	public function delete();
    public function update($new_object);
    public function validationErrors();
    public static function create($new_object=null);
    public static function find();
    public static function find_by_id($id);
    public static function flash($message="");
    public static function error($message="");
}
?>