<?php
ini_set('display_errors', 1);

require('application/controllers/controller.controller.php');
require('application/frontcontroller.class.php');

function __autoload($file) {
	if (!class_exists($file, false)) {
		
		$class_file_path = strtolower(str_replace('_', '/', $file) . '.php');
		$class_file_path = 'application/' . $class_file_path;
		
		if(file_exists($class_file_path)){
			require($class_file_path);
		}else{	
			throw new Exception("Unable to load $class_file_path.");
		}
	}
 
}

/**
@ TODO
	Page views
	MODELS 
**/
new FrontController();