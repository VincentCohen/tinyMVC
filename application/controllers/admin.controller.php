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
		$title = $this->model->getIndexTitle();
		$content = " kontjes " ;	
		
		$this->assign('title', $title);
		$this->assign('content', $content);
		$this->setView('index');
	}
	
	function about_us(){
		echo ' a b c d e f g ' ;
	}
}