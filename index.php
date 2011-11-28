<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
	ROUTER Functions 
READ
:http://johnsquibb.com/tutorials/mvc-framework-in-1-hour-part-one
:https://github.com/robap/php-router/blob/master/lib/Router.php
**/

/*
* Set Routes
* Example: $routes['news'], $routes['news']['view'], $routes['news']['archive']
*			
*/

$routes = array ( 	
	'/news/<action>/<id>' => array ( 'controller' => 'news', 'action' => 'archive' ),
	'/news/different/5' => array ( 'controller' => 'different', 'action' => 'special' ),
	'/blog/<action>/<id>' => array ( 'controller' => 'blog', 'action' => 'index' ),
	'/forum/<action>/<id>' => array ( 'controller' => 'forum', 'action' => 'index' ),
	'/register/<action>/<id>' => array ( 'controller' => 'register', 'action' => 'account' ),
);

echo '<pre>';
new FrontController($routes);