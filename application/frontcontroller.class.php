<?php 
class FrontController 
{ 
	
    public function __construct (){ 
    
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
         
         
        /*
        	If router returns false dispatch controller/action
        		else,see router
        */
        if(!$this->router($_SERVER['PATH_INFO'])){
        	$this->dispatch($controller, $action);    
        }  	
        
    }
    
    /*
    	Router
    		Check if current url call refers to a different controller class and method.
    */
    public function router($path){
    	
    	//allowed routes
    	$routes = array ( 
    		/*'/news/items/(id)' => array ( 'controller' => 'news', 'action' => 'items' ), 
    		'/products/item/(id)' => array ( 'controller' => 'news', 'action' => 'items' ),    */	
    		'/news/<action>/<id>' => array ( 'controller' => 'news', 'action' => 'items' ),
    		'a' => array ( 'controller' => 'news', 'action' => 'items' )
    	);
    	
   		$array = preg_match('^\/.*^', '/news/items',$matches);
		var_dump($matches);
    	
    	return false;
    }    
    
    /**
    *	Dispatch
    		does things.. include controller class & execute requested action
    **/
    public function dispatch ($controller, $action){
		
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
    
    public function throw404($controller,$action){
    	die('<pre>Le 404! - controller:' . $controller . ' action: ' . $action . '  </pre>');
    } 
    
}