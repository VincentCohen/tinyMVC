<?php 
class FrontController 
{ 
    public function __construct () 
    { 
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
        
        $this->dispatch($controller, $action); 
    }    
    
    /**
    *	@ PARAMS, controller / action
    *		Search for requested controller,
    			search for matching controller
    				execute controller
    **/
    public function dispatch ($controller, $action){
		
        if (file_exists('./application/controllers/' . $controller . '.controller.php')){ 
            require_once('./application/controllers/'.$controller . '.controller.php'); 

            $controllername = ucfirst($controller) . 'Controller'; 
            
            if (class_exists($controllername)) { // bestaat de class
                if (in_array($action, get_class_methods ($controllername))){ 
                    /** Actie bestaat ook, dus uitvoeren. */ 
                    $objController = new $controllername(); 
                    $objController->$action(); 
                    return; 
                } 
            } 
        }  
         
        // hmmm.. geen return dus er is iets mis
        die ($this->throw404($controller,$action)); 
    }
    
    public function throw404($controller,$action){
    	die('<pre>Le 404! - controller:' . $controller . ' action: ' . $action . '  </pre>');
    } 
    
}