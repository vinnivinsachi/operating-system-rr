<h1 class='align-center' >Online Chat HTML WebSockets & PHP Sockets</h1>


	<script src="{$dirScript}/fancywebsocket.js"></script>
{literal}
	<style>
		
		/*input, textarea {border:1px solid #CCC;margin:0px;padding:0px}*/

		/*#body {max-width:800px;margin:auto}*/
		/*#log {width:100%;height:400px}*/
		/*#message {width:100%;line-height:20px}*/
	</style>
	<script>

	var Server;
	function joinChatCallback(data, elmt){
		console.log('joined');
		var $uniqueName = data.uniqueName; 
		$('connectingUser').set('connectedAs', data.uniqueName);
		//element = Elements.from(data.partialInjectSetValue)[0];
		//console.log(element);
		statusLog('Connecting...');
		
		Server = new FancyWebSocket('ws://localhost:9300/?uniqueName=blahName');

		$j('#message').keypress(function(e) {
			if ( e.keyCode == 13 && this.value ) {
				//log( 'You: ' + this.value );
				Server.send( this.value );

				$j(this).val('');
			}
		});

		//Let the user know we're connected
		Server.bind('open', function() {
			statusLog( "Connected" );
			
			
		});

		//OH NOES! Disconnection occurred.
		Server.bind('close', function( data ) {
			statusLog( "Disconnected" );
		});

		//Log any messages sent from server
		Server.bind('message', function( data ) {
			console.log('here at binding message');
			if(data.type == 'global'){ // member join type
				console.log('here at global message');
				data.message.each(function(text){
					element = Elements.from(text);
					console.log(element);
					$('users-online').adopt(element);
				});
			}else{
				console.log(data);
			}

			if(data.func){
				window[data.func](data, Server);
			}
			//log( payload );
		});

		Server.connect();
	}

	function chatWithUser(data, elmt){
		console.log(data);
		element = Elements.from(data.partialInjectSetValue);
		$('main-chat').adopt(element);

		data = {
			type: 'chatWith',
			message: '',
			from:	data.returnData.fromName,
			to:		data.returnData.toName,
			uniqueName:	data.returnData.fromName
			
		};

		//server.send(JSON.encode(data));
		Server.send('message', JSON.encode(data));
		console.log('server message');
	}

	function connectingUser(data, server){

		userElement = $('users-online').getElements("li[uniqueName="+data.from+"]")[0];
		//userElment 
		console.log('trying to set up connecting user');
		uniqueName = $('connectingUser').get('connectedAs');

		data = {
			type: 'setUpUniqueName',
			message: '',
			from:	'',
			to:		'',
			uniqueName:	uniqueName
		};

		//server.send(JSON.encode(data));
		server.send('message', JSON.encode(data));
	}

	function statusLog(text){
		var $log = $('connecting-status');
		//Add text to log
		$log.set('text', text);
	}

	function startWebSocket(){
		var Server;

		function log( text ) {
			$log = $j('#log');
			//Add text to log
			$log.append(($log.val()?"\n":'')+text); // appending log information.
			//Autoscroll
			$log[0].scrollTop = $log[0].scrollHeight - $log[0].clientHeight;
		}

		function send( text ) {
			Server.send( 'message', text );
		}

		$j(document).ready(function() {
			log('Connecting...');
			Server = new FancyWebSocket('ws://localhost:9300');

			$j('#message').keypress(function(e) {
				if ( e.keyCode == 13 && this.value ) {
					log( 'You: ' + this.value );
					send( this.value );

					$j(this).val('');
				}
			});

			//Let the user know we're connected
			Server.bind('open', function() {
				log( "Connected." );
			});

			//OH NOES! Disconnection occurred.
			Server.bind('close', function( data ) {
				log( "Disconnected." );
			});

			//Log any messages sent from server
			Server.bind('message', function( payload ) {
				log( payload );
			});

			Server.connect();
		});

	}
	</script>

{/literal}

	<form class='RialtoForm:json' method='post' action='{$siteRoot}/online-chat/join-chat' rialtoFormPostDCB='joinChatCallback'>
		<label class='align-left'>Username</label>
		<input type='text' placeholder='uniquename' name='uniqueName' style='width: 150px;'/>
		<button type='submit' class='positive'>Join</button>
	</form>

	<div class='spacer-medium'></div>
	<div class='box-flex'>
		<div class='box-hor width-100'>
			<div class='bordered box-flex-3 rounded title-box' style='max-width:640px;'>
				<h1 id='connectingUser' connectedAs=''>Messages (<span id='connecting-status'></span>)</h1>
				<div id='main-chat' class='title-box-content width-100' >
					
					
				</div>
			</div>
			<div class='bordered margin-left-medium box-flex-1 rounded title-box'>
				<h1>Online Users</h1>
				<div class='title-box-content'>
					<ul id='users-online'>
						
					</ul>
				</div>
			</div>
		</div>
	</div>
	
		
	