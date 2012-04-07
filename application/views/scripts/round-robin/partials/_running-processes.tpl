{foreach from=$processes item='process'}
<div class='running-process title-box ' >
	<h1>{$process.name}</h1>
	<div class='title-box-content'>
		Process time: <span class='process_time'>{$process.process_time}</span> sec<br/>
		Time left: <span class='time-left'>{$process.process_time}</span> sec
	</div>
</div>
{/foreach}