<?php
class DefaultController extends Controller{
	public $model;
	
	function __construct()
	{
		parent::__construct();
		$this->model = new Models_Default();
	}
	
	function index()
	{
		$data = array();
		$data["title"] = $this->model->indexTest();
		$data["content"] = " kontjes " ;
		
		return $this->render("index.view",$data);
	}
	
	function about_us(){
		echo ' a b c d e f g ' ;
	}
}