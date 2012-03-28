{rialtoExample}

<div id='loadReplacesParent'>
	<span class='RialtoLoadReplaces' rialtoLoadReplacesURL='{$siteRoot}/partials/content'>Should be replaced...</span>
	
	<br />
	
	<button onclick='loadReplaces()'>Load Replaces</button>
</div>


{literal}
<script type='text/javascript'>		
	function loadReplaces() {
		$Rialto.getPlugin('RialtoLoadReplaces').load($('loadReplacesParent'));
	}
</script>
{/literal}

{/rialtoExample}