<?php
Class Controller{
	private $tplHeader = "";
	private $tplFooter = "";
	private $data		= array();
	private $template   = '';
	
	function __construct($header = '', $footer = ''){
		// terugkomende shit
		
		if($header == ''){
			$this->viewHeader = '<h1>HEDR</h1>' ;
		}else{
			$this->tplHeader = $header;
		}
		
		if($footer == ''){
			$this->tplFooter = '<h1>FOOTR</h1>' ;
		}else{
			$this->tplFooter = $footer;
		}
		
	}
	
	/**function render($view,$data){
		if(is_array($data)) {
			extract($data);
		}
		
		$viewPath = "./views/$view.php";
		if(file_exists($viewPath)){
			require($viewPath);
		}else{
			die("404 view not found . " . $viewPath);
		}
	}**/
	
	
	function assign($var, $value){
		//set data
		$this->data[$var]	= $value;
	}
	
	function setView($tpl){
		$this->template = $tpl . '.view.php';
	}
	
	public function __destruct(){
		echo 'destruct';
		//get data
		$data = $this->data;
		
		var_dump($this->template);
		
		//render
		include('./views/' . $this->template);
		
	}
	
}

?>