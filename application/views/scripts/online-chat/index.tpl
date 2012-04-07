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
		
		Server = new FancyWebSocket('ws://localhost:9300/');

		$j('#main-chat').delegate(".message", "keypress", function(e){
			if ( e.keyCode == 13 && this.value ) {
				currentElement = $(e.currentTarget);

				var from = currentElement.get('fromName');
				var to = currentElement.get('toName');
				var message = currentElement.get('value');

				data = {
						type: 'chatWith',
						message: message,
						from:	from,
						to:		to,						
					};

					//server.send(JSON.encode(data));
					Server.send('message', JSON.encode(data));
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
			}else if (data.type=='chatWith'){
				console.log('return data with cath with: ');
				console.log(data);
				console.log('here at chat with friend : '+Server.uniqueName);
				//if(data.message != ''){
					if(data.from == Server.uniqueName){ // message sent to self
						var messageElement = $('with-'+data.to);
						var message = Elements.from('<li>You : '+data.message+'</li>');
					}else{
						var messageElement = $('with-'+data.from);
						if(!messageElement){
							messageElement = Elements.from(data.divs)[0];
							console.log('here at messageElment received:');
							$('main-chat').adopt(messageElement);
						}
						var message = Elements.from('<li>From '+data.from+' : '+data.message+'</li>');
						
					}
					messageElement.getElement('.log').adopt(message[0]);
					
			

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

		var userElement = $('users-online').getElements("li[uniqueName="+data.from+"]")[0];
		//userElment 
		console.log('trying to set up connecting user');
		var uniqueName = $('connectingUser').get('connectedAs');

		data = {
			type: 'setUpUniqueName',
			message: '',
			from:	'',
			to:		'',
			uniqueName:	uniqueName
		};
		server.uniqueName = uniqueName;
		//server.send(JSON.encode(data));
		server.send('message', JSON.encode(data));
	}

	function statusLog(text){
		var $log = $('connecting-status');
		//Add text to log
		$log.set('text', text);
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
	
		
	