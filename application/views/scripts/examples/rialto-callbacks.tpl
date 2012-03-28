{rialtoExample}

<a href='{$siteRoot}/partials/empty' class='RialtoLink:json' rialtoInitCB='init' rialtoClosureCB='closure' >CLICK ME!</a>

{literal}
<script type='text/javascript'>	
	function init(elmt) {
		alert('init');
		return true;
	}

	function closure() {
		alert('closure');
		return false;
	}
</script>
{/literal}

{/rialtoExample}