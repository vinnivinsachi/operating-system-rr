<h1 class='align-center' >Round Robin Simulation</h1>

<form class='RialtoForm:json' method='post' action='{$siteRoot}/round-robin/index' rialtoFormPostDCB='instantiateRunningProcessTemplates'>
	<label>Number of processes</label>
	<input type='number' name='number_of_processes' min='1' max='20' style='margin-bottom: 4px;'>
	<label>Time quantum</label>
	<input type='number' name='time_quantum' min='1' max='20' style='margin-bottom: 4px;'>
	<span class='spacer-hor-large'></span>
	<span class='spacer-hor-large'></span>
	<button class='positive'>Generate</button>
</form>


<div class='flex-box' id='round-robin-simulation'>
	<div class='box-ver width-100' >
		<div class='box-hor padding-medium '>
			<div class='bordered box-flex-2 rounded title-box' style='max-width:640px;'>
				<h1>Running Process(es) <button class='' style='margin-top: -4px;'>Run</button></h1>
				<div class='title-box-content' id='running-processes'>
				
					<div class='running-process bordered title-box left margin-right-small margin-bottom-small active' style='height: 100px; width: 150px;'>
						<h1>Process 1</h1>
						<div class='title-box-content'>
							Process time: <span class='process_time'>3</span> sec<br/>
							Time left: <span class='time-left'>3</span> sec
						</div>
					</div>
					<div class='running-process bordered title-box left margin-right-small margin-bottom-small' style='height: 100px; width: 150px;'>
						<h1>Process 1</h1>
						<div class='title-box-content'>
							Process time: <span class='process_time'>7</span> sec<br/>
							Time left: <span class='time-left'>7</span> sec
						</div>
					</div>
					<div class='running-process bordered title-box left margin-right-small margin-bottom-small' style='height: 100px; width: 150px;'>
						<h1>Process 1</h1>
						<div class='title-box-content'>
							Process time: <span class='process_time'>7</span> sec<br/>
							Time left: <span class='time-left'>7</span> sec
						</div>
					</div>
					<div class='running-process bordered title-box left margin-right-small margin-bottom-small' style='height: 100px; width: 150px;'>
						<h1>Process 1</h1>
						<div class='title-box-content'>
							Process time: <span class='process_time'>7</span> sec<br/>
							Time left: <span class='time-left'>7</span> sec
						</div>
					</div>
					<div class='running-process bordered title-box left margin-right-small margin-bottom-small' style='height: 100px; width: 150px;'>
						<h1>Process 1</h1>
						<div class='title-box-content'>
							Process time: <span class='process_time'>7</span> sec<br/>
							Time left: <span class='time-left'>7</span> sec
						</div>
					</div>
				</div>
			</div>
			<div class='box-ver box-flex-1' style='height: 500px;'>
				<div class='bordered margin-left-medium box-flex-1 rounded title-box'>
			
					<h1>Current process</h1>
					<div class='title-box-content'>
						Current running process:<br/>
							<h1 class='align-center' id='current-running-process'>Process 1</h1>
						Running time countdown:<br/>
							<h1 class='align-center' id='time-countdown'>4.3</h1>
						Total run time:<br/>
							<h1 class='align-center' id='time-count'>7.8</h1>
					</div>
				</div>
				<div class='bordered margin-top-medium margin-left-medium box-flex-1 rounded title-box'>
					<h1>Stats</h1>
					<div class='title-box-content'>
						Average processing time: <span id='average-processing-time'>3</span> sec <br/>
						Longest wait time: <span id='longest-wait-time'>8</span>
					</div>
				</div>	
			</div>
		</div>
		<div class='padding-medium' style=''>
			<div class='title-box bordered'>
				<h1>Finished Process(es)</h1>
				<div class='title-box-content inline-block' style='min-height: 50px;' id='finished-processes'>
					
				</div>
			</div>
		</div>
	</div>
	
	
	<div class='hidden' >
	
		<div id='ending-process-tmplate' class='bordered title-box inline-block margin-right-small margin-bottom-small' style='height: 100px; width: 150px;'>
			<h1>Process <span data-bind='process_id'></span></h1>
			<div class='title-box-content'>
				Process time: <span class='process-time' data-bind='process_time'></span> sec<br/>
				Start time: <span class='start-time' data-bind='start_time'></span> sec<br/>
				End time: <span class='start-time' data-bind='end_time'></span> sec<br/>
			</div>
		</div>
	</div>
	
</div>

<script src="{$dirRialtoPublicLibrary}/js/mootools/plugins/MTE/mte.js"></script> 
<script src="{$dirRialtoPublicLibrary}/js/mootools/plugins/MTE/mte.markup.js"></script> 
<script src="{$dirRialtoPublicLibrary}/js/mootools/plugins/MTE/mte.observables.js"></script> 
<script src="{$dirScript}/RoundRobin.js"></script>

{literal}

<script>

	
	$RR = new RoundRobin();

	$RR.debug();

	
	function instantiateRunningProcessTemplates(data, elmt){
		console.log(data);
		console.log(elmt);
	}
	
	
	

</script>
		

{/literal}
