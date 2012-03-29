<?php

class RoundRobinController extends Application_Controller
{
	
	public function init(){
		parent::init();  // Because this is a custom controller class

		$this->_ajaxContext->addActionContext('index', 'json')
			 			   ->initContext();
		
	}
	
	public function indexAction(){
		
	}	
}