<?php

require('lib/lib.php');


class Application extends lib {

    public function run() {

        $var = '1st variable to use in a template';
        $var2 = '2nd variable to use in a template';

        $this->render('example', compact('var', 'var2'),"application");
    }

}

$app = new Application();

$app->run();  
?>