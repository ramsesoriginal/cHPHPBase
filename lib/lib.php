<?php
function __autoload($name) {
	if (file_exists(dirname(__FILE__). '/../models/' . $name . '.php'))
		require_once(dirname(__FILE__). '/../models/' . $name . '.php');
    throw new Exception("Unable to load $name.");
}


class lib {

	private $content;
	private $fields;
	public $returnString;
	public $noTemplate;
	public $respond_to;
    public $params;
    public $preParams;
    private $flash_Messages;
    private $error_Messages;

	public function __construct($returnString=false, $noTemplate=false, $respond_to="html", $params=array(), $preParams = array()) {
	    $this->returnString = $first;                
	    $this->noTemplate = $last;          
        $this->respond_to = $respond_to;    
        $this->params = $params;    
        $this->preParams = $preParams;            
	  }

    protected function root() {
        return dirname(__FILE__);
    }

    protected function model() {
    	$classname = get_class($this);
    	$modelname = str_replace("Controller", "", $classname);
    	if (file_exists($this->root(). '/../models/' . $modelname  . '.php'))
    		require_once($this->root(). '/../models/' . $modelname  . '.php');
    	return $modelname;
    }

    protected function preRender() {
    }

    protected function render($file_name, $variables_array = null, $template = "application") {
        $this->preRender();
        if($variables_array)
            extract($variables_array);  
        $fields=array();

		ob_start();
        require($this->root() . '/../views/' . $file_name . '.php');
        $this->content = ob_get_contents();
        ob_end_clean();
		if ($this->returnString)
			return $content;
		if (!$this->noTemplate)
			require($this->root() . '/../views/templates/' . $template . '.php');
		else
			echo $this->content;
		ob_end_flush();

    }

    protected function content_for($field, $string=""){
    	$this->fields[$field]=$string;
    }

    protected function yield($item = "content", $defaultvalue="") {
    	if ($item==="content")
    		echo  $this->content;
    	if (!empty($this->fields[$item]) || $this->fields[$item] != '')
    		echo $this->fields[$item];
    	else
    		echo $defaultvalue;
    }

    public function flash($message) {
        if (!empty($message))
            $this->flash_Messages[] = $message;
        return $this->flash_Messages;
    }

    public function error($message) {
        if (!empty($message))
            $this->flash_Messages[] = $message;
        return $this->flash_Messages;
    }
}
?>