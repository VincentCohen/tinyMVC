<?php 
class FrontController 
{ 
	
	var $routes = array();
    
    public function __construct ($routes)
    {
    	$this->routes = $routes; 
    
        if (isset($_SERVER['PATH_INFO'])){ 
            $parts = explode ('/',strtolower(trim($_SERVER['PATH_INFO'], '/' ))); 
            
            /** 
             * $parts is nu dan dus array ( [0] => 'guestbook', [1] => 'showlist' ); 
             */ 
            $controller = (current($parts)) ? array_shift ($parts)	:'default'; 
            $action 	= (current($parts)) ? array_shift ($parts) 	: 'index'; 

        }else{ 
            $controller = 'default'; 
            $action = 'index'; 
        }
         
        //	If router returns false dispatch controller/action else,see router
        if(!$this->router($_SERVER['PATH_INFO'])){
        	$this->dispatch($controller, $action);    
        }  	
        
    }
    
    /**
    *	Router
    *	By default the url news/items will load the controller news and method items
    *	When the routemap is set and default routing(thus news controller and method items) comes with no results 
    	the router is called. It takes the parts of the url and finds the apropriate controller & methods 
    *
    */
    public function router($requestUrl)
    {
    	$routeMap 	  = $this->routes;
    	$currentRoute = '';	
		
		//Check if current route exists in array key
		if(array_key_exists($requestUrl,$routeMap)){
			$currentRoute = $routeMap[$requestUrl];
			echo '1' ;
		}else{
			echo '2' ;
			//nope it does not.. 
			$requestParts = explode ('/',strtolower(trim($requestUrl, '/' ))); 
			$mapKey		  = '/'.$requestParts[0].'/<action>/<id>';
			
			if(array_key_exists($mapKey,$routeMap)){
				$currentRoute = $routeMap[$mapKey];
			}
		}
		
		var_dump($currentRoute);
       	return false;
    }    
    
    /*
    *	Dispatch
    *		does things.. include controller class & execute requested action
    */
    public function dispatch ($controller, $action)
    {
		
        if (file_exists('./application/controllers/' . $controller . '.controller.php')){ 
            require_once('./application/controllers/'.$controller . '.controller.php'); 

            $controllername = ucfirst($controller) . 'Controller'; 
            
            if (class_exists($controllername)) { // bestaat de class
                if (in_array($action, get_class_methods ($controllername))){ 

                    /** Action(method) exists, call it. */ 
                    $objController = new $controllername(); 
                    $objController->$action(); 
                    
                    //succesfully called, return
                    return; 
                } 
            } 
        }  
         
        //only thrown when there is no return @LINE:63.
        #Should be error handler..
        $this->throw404($controller,$action); 
    }
    
    public function throw404($controller,$action)
    {
    	die('<pre>Le 404! - controller:' . $controller . ' action: ' . $action . '  </pre>');
    } 
}