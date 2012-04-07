<?php

class RoundRobinController extends Application_Controller
{
	
	public function init(){
		parent::init();  // Because this is a custom controller class

		$this->_ajaxContext->addActionContext('index', 'json')
			 			   ->initContext();
		
	}
	
	public function indexAction(){
		$numberOfProcesses = $this->_request->getParam('number_of_processes');
		$timeQuantum = $this->_request->getParam('time_quantum');
		if($this->_request->isPost()){
			
			for($i = 0; $i< $numberOfProcesses; $i++){
				$processes[$i]['name'] = 'Process '.$i;
				$processes[$i]['process_time'] = rand(1,20);
			}
			
			$partialInjectionVariable = array( 'processes' => $processes,
											   'time_quantum' => $timeQuantum
               								 );
           	$this->view->returnData = $partialInjectionVariable; 
           	$this->view->partialInjectSetValue = $this->evalPartial('round-robin/partials/_running-processes.tpl', $partialInjectionVariable); // passing injection li into view
			
		}
	}	
}