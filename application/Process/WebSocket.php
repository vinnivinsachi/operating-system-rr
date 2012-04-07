<?php

class Application_Process_WebSocket
{
	const DATA_TYPE_GLOBAL = 'global';
	const DATA_TYPE_SYSTEM = 'system';
	const DATA_TYPE_CHATWITH = 'chatWith';
	const DATA_TYPE_INDIVIDUAL = 'individual';
	
	static public function wsOnMessage($clientID, $message, $messageLength, $binary, $Server) {
		$ip = long2ip( $Server->wsClients[$clientID][6] );
		//global $Server;
		
		// check if message length is 0
		if ($messageLength == 0) {
			$Server->wsClose($clientID);
			return;
		}
	
		//The speaker is the only person in the room. Don't let them feel lonely.
		if ( sizeof($Server->wsClients) == 1 )
			$Server->wsSend($clientID, "There isn't anyone else in the room, but I'll still listen to you. --Your Trusty Server");
		else
			//Send the message to everyone but the person who said it
			foreach ( $Server->wsClients as $id => $client )
				if ( $id != $clientID )
					$Server->wsSend($id, "Visitor $clientID ($ip) said \"$message\"");
	}
	
	static public function wsOnConnecting($clientID, $Server){
		$logger = Zend_Registry::get('logger');
		
		$data = self::constructMessage(null, null, $clientID, null, null, 'connectingUser');
		$logger->info('line 30:'.$data);
		$Server->wsSend($clientID, $data);
	}
	
	static public function setUpUniqueName($clientID, $data, $Server){
		$logger = Zend_Registry::get('logger');
		$logger->info('line 39 setting up unique name, clientID :'.$clientID);
		$Server->wsClients[$clientID][12] = $data['uniqueName'];
		if(!in_array($clientID, $Server->uniqueNameSocketSearch[$data['uniqueName']])){
			$Server->uniqueNameSocketSearch[$data['uniqueName']][]=$clientID;
		}
		$logger->info('uniqueNameSocketSearch is: '.Zend_Debug::dump($Server->uniqueNameSocketSearch));
		
		self::wsOnOpen($clientID, $Server, $data['uniqueName']);
	}
	
	static public function chatWithUser($clientID, $data, $Server){	
		$logger = Zend_Registry::get('logger');
		$logger->info('line 47 chat with user from clientID :'.$clientID);
		$from = $data['from'];
		$to = $data['to'];
		
		if(!isset($Server->chatRooms[$from][$to])){ // if not set, then set them up.
			$Server->chatRooms[$from][$to] = &$Server->uniqueNameSocketSearch[$to];
			$Server->chatRooms[$to][$from] = &$Server->uniqueNameSocketSearch[$from];
		}
		
		$logger->info('server chat rooms are '.Zend_Debug::dump($Server->chatRooms));
		
		
		foreach($Server->chatRooms[$from][$to] as $id => $toClientID){
			// for each to client, construct the template div// this isn't really the best case. 
			$partialInjectionVariable = array('toName' => $from, 'fromName' =>$to);
			self::appendPathConstants($partialInjectionVariable);
			$template = Custom_Process_Partials::evalPartial('online-chat/partials/_chat.tpl', $partialInjectionVariable);
			
			$newData = self::constructMessage($data['type'], $data['message'], $from, $to, null, null, $template);
			
			$Server->wsSend($toClientID, $newData); // send to all the receipient
		}
		
		$newData = self::constructMessage($data['type'], $data['message'], $from, $to);
		$logger->info('server sent info from user chat ------>'.$newData);
		$Server->wsSend($clientID, $newData); // send to self
		
		
	}
	
	// when a client connects
	static public function wsOnOpen($clientID, $Server, $fromUniqueName=null)
	{
		
		$logger = Zend_Registry::get('logger');
		
		//global $Server;
		$ip = long2ip( $Server->wsClients[$clientID][6] );
	
		$logger->info('wsOnOpen - '.$fromUniqueName);
		
		//$Server->log( "$ip ($clientID) has connected." );
	
		//Send a join notice to everyone but the person who joined
		
		//$logger->info('server clients ');
		//$logger->info(Zend_Debug::dump($Server->wsClients));
		
		foreach ( $Server->wsClients as $id => $client ){
			$logger->info('sending join notice after uniquename has been set - '.$fromUniqueName);
			
			$userDiv = array();
			if ( $id != $clientID ){ // foreach other clients that are open send his list
				$logger->info('Here is for every one else : 68 : '.$Server->wsClients[$clientID][12]);
				
				$partialInjectionVariable = array('uniqueName' => $Server->wsClients[$clientID][12],
												  'fromName' => $Server->wsClients[$id][12]);
				self::appendPathConstants($partialInjectionVariable);
				$template = Custom_Process_Partials::evalPartial('online-chat/partials/_user.tpl', $partialInjectionVariable);
				$logger->info('line 47 : '.$template);
				$userDiv[] = (string)$template;
				//$logger->info('line 50 message is :'.$message);
				$from = $clientID;
				$type = self::DATA_TYPE_GLOBAL;		
				$data = self::constructMessage($type, $userDiv, $from);
				$logger->info('line 55 message is :'.$data);
				$Server->wsSend($id, $data);
			}else{ // if it is the id person, send all current users.
				$logger->info('Here is for himself');
				
				foreach ($Server->wsClients as $id => $client){
					$partialInjectionVariable = array('fromName' => $Server->wsClients[$clientID][12],
													   'uniqueName' => $client[12]);
					self::appendPathConstants($partialInjectionVariable);
					$template = Custom_Process_Partials::evalPartial('online-chat/partials/_user.tpl', $partialInjectionVariable);
					$logger->info('line 60 :'.$template);
					$userDiv[] = $template;
				}
				$from = $id;
				$type = self::DATA_TYPE_GLOBAL;		
				$data = self::constructMessage($type, $userDiv, $from, null, $fromUniqueName);
				$logger->info('line 70 :'.$data);
				$Server->wsSend($clientID, $data);
			}
		}
		$logger->info('wsOnOpen end uniqueName : '.$fromUniqueName);
		
	}
	
	// when a client closes or lost connection
	static public function wsOnClose($clientID, $status, $Server) {
		//global $Server;
		$ip = long2ip( $Server->wsClients[$clientID][6] );
	
		//$Server->log( "$ip ($clientID) has disconnected." );
	
		//Send a user left notice to everyone in the room
		foreach ( $Server->wsClients as $id => $client )
			$Server->wsSend($id, "Visitor $clientID ($ip) has left the room.");
	}
	
	static public function constructMessage($type, $message, $from, $to=null, $fromUniqueName, $func=null, $divs=null){
		$newMessage = array('type' => $type, 'from' => $from, 'to' =>$to, 'message'=>$message, 'fromUniqueName'=>$fromUniqueName, 'func'=>$func, 'divs'=>$divs);
		return $encodedMessage = json_encode($newMessage);
	}
	
	static function appendPathConstants(array &$array) {
		$array['siteRoot'] = SITE_ROOT; // public folder
		$array['documentRoot'] = DOCUMENT_ROOT; // document root on server
		$array['dirPartials'] = DIR_PARTIALS; // partials
		$array['dirCSS'] = DIR_CSS; // CSS
		$array['dirImages'] = DIR_IMAGES; // IMAGES
		$array['dirJS'] = DIR_JS; // JAVASCRIPT
		$array['dirScript'] = DIR_RIALTO_SCRIPT_LIBRARY;
		$array['dirUploads'] = DIR_UPLOADS;
		$array['dirRialtoPublicLibrary'] = DIR_RIALTO_PUBLIC_LIBRARY;
	}
	
	
	
}
