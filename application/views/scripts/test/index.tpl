
<div id='flash'>FLASH ME!</div>

<button onclick='switchStates(1);'>GO TO 1</button>
<button onclick='switchStates(2);'>GO TO 2</button>
<button onclick='switchStates(3);'>GO TO 3</button>

<br /><br />
<button onclick='goBack()'>BACK</button>
<button onclick='goForward()'>FOWARD</button>


{literal}
<script type='text/javascript'>
	var history = [];
	var future = [];
	
	var state1;
	var state2;
	var state3;
	
	window.addEvent('domready', function(){
		console.log(javascript:history);
		
		state1 = Elements.from("<div class='state' id='state'><button id='flash-it'>FLASH IT FROM 1!</button></div>")[0];
		state2 = Elements.from("<div class='state' id='state'><button id='flash-it'>FLASH IT FROM 2!</button></div>")[0];
		state3 = Elements.from("<div class='state' id='state'><button id='flash-it'>FLASH IT FROM 3!</button></div>")[0];
		setupState(state1);
		setupState(state2);
		setupState(state3);
		switchStates(1);
	});
	
	function addState(state) {
		var contentWrapper = $('content-wrapper');
		state.inject(contentWrapper, 'top');
	}
	
	function setupState(state) {
		state.getElement('#flash-it').addEvent('click', flashIt);
	}
	
	function flashIt(event) {
		$('flash').highlight();
	}
	
	function removeMe(event) {
		var state = event.target.getParent('.state');
		states.push(state.dispose());
	}
	
	function switchStates(num) {
		if(num == 1) var newState = state1;
		if(num == 2) var newState = state2;
		if(num == 3) var newState = state3;
				
		var oldState = $('state');
		if(oldState) history.push(oldState.dispose());
		
		var wrapper = $('content-wrapper');
		newState.inject(wrapper, 'top');
	}
	
	function goBack() {
		future.unshift($('state').dispose());
		
		var previousState = history.pop();
		var wrapper = $('content-wrapper');
		previousState.inject(wrapper, 'top');
	}
	
	function goForward() {
		history.push($('state').dispose());
		
		var nextState = future.shift();
		var wrapper = $('content-wrapper');
		nextState.inject(wrapper, 'top');	
	}
	
</script>
{/literal}