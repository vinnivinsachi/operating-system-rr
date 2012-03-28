{rialtoExample}

<div id='example-container'>
	<div class='example'>Example</div>
	<div class='spacer-large'></div>
	<div class='example'>Example</div>
</div>

<div class='spacer-large'></div>

<button onclick='testHighlight()'>Highlight</button>

{literal}
<script type='text/javascript'>
	function testHighlight() {
		$Rialto.fx.highlight($$('.example'), {
			startColor: '#fff',
			endColor: '#987809',
			endTransparent: true
		});
	}
</script>

<style>
	#example-container {
		background-color: #850394;
		height: 100px;
	}
	
	.example {
		//background-color: inherit;
	}
</style>
{/literal}

{/rialtoExample}