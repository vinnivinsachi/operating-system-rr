<?php

class OnlineChatController extends Application_Controller
{
	
	//public static $Server;
	
	public function init(){
		parent::init();  // Because this is a custom controller class

		$this->_ajaxContext->addActionContext('join-chat', 'json')
						   ->addActionContext('chat-with', 'json')
			 			   ->initContext();
		
	}
	
	public function indexAction(){
		// start the server
		$this->_logger->info('online chat stuff'); 
		
	}
	
	public function joinChatAction(){
		$uniqueName = $this->_request->getPost('uniqueName');
		
		if($this->_request->isPost()){
			$partialInjectionVariable = array('uniqueName' => $uniqueName);
	        $this->view->returnData = $partialInjectionVariable; 
	        $this->view->joined = true;
	        $this->view->uniqueName = $uniqueName;
	    	$this->view->partialInjectSetValue = $this->evalPartial('online-chat/partials/_user.tpl', $partialInjectionVariable); // passing injection li into view
		}	
	}
	
	public function chatWithAction(){
		$fromName = $this->_request->getParam('fromName');
		$toName = $this->_request->getParam('toName');
		if($fromName && $toName){
			$partialInjectionVariable = array('toName' => $toName, 'fromName' =>$fromName);
	        $this->view->returnData = $partialInjectionVariable;
	    	$this->view->partialInjectSetValue = $this->evalPartial('online-chat/partials/_chat.tpl', $partialInjectionVariable); // passing injection li into view
		}	
	}
	
	public function serverAction(){
		// start the server
		
		$this->noRender();
		
		set_time_limit(0);
		
		//global $Server;
		$Server = new Custom_WebSocket();
		
		$Server->bind('message', 'Application_Process_WebSocket::wsOnMessage');
		$Server->bind('open', 'Application_Process_WebSocket::wsOnOpen');
		$Server->bind('close', 'Application_Process_WebSocket::wsOnClose');
		$Server->bind('connecting', 'Application_Process_WebSocket::wsOnConnecting');
		$Server->bind('chatWith', 'Application_Process_WebSocket::chatWithUser');
		$Server->bind('setUpUniqueName', 'Application_Process_WebSocket::setUpUniqueName');
		// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
		// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
		$Server->wsStartServer('localhost', 9300); // start listening on port 9300.	
	}
	
	public function debugserverAction(){
		//global $Server;
		echo 'here at debugging';
		
		//self::$server->wsStopServer();
		//echo self::$Server->getClients();
	}
	
	
	
	
	
}


