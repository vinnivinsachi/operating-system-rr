{rialtoExample}

<div id='example' class='example-block'></div>
<div class='example-block'></div>

<br /><br />

<button onclick='fadeOut()'>Fade Out</button>

{literal}
<script type='text/javascript'>

	function fadeOut() {
		$Rialto.fx.fadeOut($$('.example-block'), {
			hide: true,
			destroy: true,
			//startOpacity: 0.5,
			//endOpacity: 0,
			//duration: 5000,
			//onComplete: function(elmt){alert(elmt)},
			onAllComplete: function(elmts){ alert('faded '+elmts); }
		});
	}
</script>
{/literal}

{/rialtoExample}