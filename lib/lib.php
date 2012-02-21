<?php

class lib {

	private $content;
	private $fields;

    protected function root() {
        return dirname(__FILE__);
    }


    protected function render($file_name, $variables_array = null, $template = "application", $returnString = false) {

        if($variables_array)
            extract($variables_array);  
        $fields=array();
		ob_start();
        require($this->root() . '/../views/' . $file_name . '.php');
        $this->content = ob_get_contents();
        ob_end_clean();
		if ($returnString)
			return $content;
		if (!empty($template))
			require($this->root() . '/../views/templates/' . $template . '.php');
		else
			echo $content;
		ob_end_flush();
    }

    protected function yield($item = "content", $defaultvalue="") {
    	if ($item==="content")
    		echo  $this->content;
    	if (!empty($fields[$item]))
    		echo $fields[$item];
    	else
    		echo $defaultvalue;
    }
}
?>