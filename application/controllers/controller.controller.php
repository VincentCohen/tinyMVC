<?php
Class Controller{
	public $viewHeader = "";
	public $viewFooter = "";
	
	function __construct(){
		// terugkomende shit
		$this->viewHeader = '<h1>HEDR</h1>' ;
		$this->viewFooter = '<h1>FOOTR</h1>' ;
	}
	
	function render($view,$data){
		if(is_array($data)) {
			extract($data);
		}
		
		$viewPath = "./views/$view.php";
		if(file_exists($viewPath)){
			require($viewPath);
		}else{
			die("404 view not found . " . $viewPath);
		}
	}
}

?>