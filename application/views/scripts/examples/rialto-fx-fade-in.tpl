{rialtoExample}

<div id='example' class='example-block'></div>
<div class='example-block'></div>

<br /><br />

<button onclick='fadeIn()'>Fade In</button>

{literal}
<script type='text/javascript'>

	function fadeIn() {
		$Rialto.fx.fadeIn($$('.example-block'), {
			//startOpacity: 0.5,
			//duration: 5000
		});
	}

</script>

<style>
	.example-block {
		opacity: 0;
	}
</style>
{/literal}

{/rialtoExample}