<?php
/* include all the libs */
array_walk(glob(dirname(__FILE__).'/lib/*.php'),create_function('$v,$i', 'return require_once($v);'));
//should require the right model base, in the meantime let's just require
require_once(dirname(__FILE__).'/lib/db/ExamplecHBase.php');

/* set the default controller */
$root = "example";

/* create the environment */ 
if (!isset($controller))
  $controller = "";
if (!isset($id))
  $id = 0;
if (!isset($action))
  $action = "";
if (!isset($method))
  $method = $_SERVER['REQUEST_METHOD'];
if (!isset($only_string))
  $only_string = false;
if (!isset($no_template))
  $no_template = false;
if (!isset($extension))
  $extension = "html";
if (!isset($object))
  $object = null;
if (!isset($params))
  $params = array();
if (!isset($preParams))
  $preParams = "";

 /* check if the file is being included or called through the browser
 if it's called from the browser, get the info from the environment
 if it's included, return only strings
  */ 
if (realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
  /*File is called directly */

  /* get the parts of the path */ 
  $request = explode('/', substr($_SERVER["ORIG_PATH_INFO"],1));

  /* check if using PJAX. Should this maybe be"X_PJAX" instead?*/ 
  if (!empty($_SERVER["HTTP_X_PJAX"]))
    $no_template = true;

  /*get File extension*/
  $extensions = explode('.',$request[count($request)-1]);
  if (count($extensions)>1 && !empty($extensions[count($extensions)-1]))
    $extension = $extensions[count($extensions)-1];

  /*Get the controller and if not present use the default controller*/
  if (count($request)>0 && !empty($request[0]) && $request[0]!==''){
  	$controller = $request[0]."Controller";
    $filename = dirname(__FILE__). "/controller/".$controller.".php";
  } else {
    $controller = $root."Controller";
  }

  /*get the id, and if the first parameter is not the id, set that to the action and the second to id */
  if (count($request)>1 && !empty($request[1])){
  	if (is_numeric($request[1]))
  		$id = $request[1];
  	else {
  		$action = $request[1];
  		if (count($request)>2 && !empty($request[2]))
  			$id = $request[2];
  	}
  }

   $params=$_GET;
   unset($params["preParams"]);
   if (isset($_GET["preParams"]) && !empty($_GET["preParams"]))
    $preParams=$_GET["preParams"];
} else {
  /*File is included*/
  $only_string = true;
}

/*Require the applicanController*/
require_once(dirname(__FILE__). "/controller/applicationController.php");

/*if the controlle exists, return that, else it's a 404*/
if ( file_exists(dirname(__FILE__). "/controller/".$controller.".php"))
  require dirname(__FILE__). "/controller/".$controller.".php";
else {
  header("HTTP/1.0 404 Not Found");
  exit;
}

$app = new $controller;
$app->returnString = $only_string;
$app->noTemplate = $no_template;
$app->respond_to = $extension;
$app->params = $params;
$app->preParams = $preParams;
//echo "$method\n$action\n$id\n$extension\n$preParams\n";
//print_r($params);
switch ($method) {
  case 'PUT':
    $action="Create";  
    break;
  case 'POST':
    if (empty($id))  
      $action="Index";
    else
      $action="Update";  
    break;
  case 'GET':
    if (empty($id) && empty($action) ) 
      $action="Index";
    elseif (!empty($i