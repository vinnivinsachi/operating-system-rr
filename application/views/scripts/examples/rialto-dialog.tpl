{rialtoExample}

<a href='javascript:;' class='RialtoDialog RialtoDelete' rialtoDialogShowCheckCB='dialogShowCheck' rialtoDialogTitle='Are You Sure?' rialtoDialogHTML='<b>Are you sure you want to do this!?</b>' rialtoClosureCB='closure'>Delete Me!</a>

{literal}
<script>
	function dialogShowCheck(elmt) {
		//alert('check');
		return true;
	}
	
	function closure(elmt) {
		alert('I have been deleted...  :\'(');
	}
</script>
{/literal}

{/rialtoExample}