<?php 

class indexController extends Controller{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$this->redireccionar('frontend/index');
		
	}
	
	
}


?>