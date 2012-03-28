{rialtoExample}

<a href='{$siteRoot}/partials/example' class='RialtoLink:ajax' rialtoLinkRespCB='response' rialtoAjaxReplaceTargetID='self'>AJAX LINK</a>

{literal}
<script type='text/javascript'>
	function response(response, elmt) {
		return true;
	}

</script>
{/literal}

{/rialtoExample}