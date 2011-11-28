<?php
Class Controller{

	private $tplHeader = "";
	private $tplFooter = "";
	private $data		= array();
	private $template   = '';
	
	function __construct($header = '', $footer = ''){
		
		//header & footer tplts
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
	
	function assign($var, $value){
		//set data
		$this->data[$var]	= $value;
	}
	
	function setView($tpl){
		$this->template = $tpl . '.view.php';
	}
	
	public function __destruct(){
		//get data
		$data = $this->data;
			
		//render view
		include('./views/' . $this->template);
	}
	
}

?>