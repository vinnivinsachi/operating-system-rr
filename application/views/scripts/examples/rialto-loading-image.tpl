{rialtoExample}

<div id='loadingImageParent' style='height:200px;'></div>

<button onclick='showLoading()'>Show the loading image</button>
&nbsp;&nbsp;&nbsp;
<button onclick='hideLoading()'>Hide the loading image</button>

{literal}
<script type='text/javascript'>	
	window.addEvent('domready', function(){

		rialtoLoadingImage = $Rialto.getPlugin('RialtoLoadingImage');
		parent = $('loadingImageParent');
		
	});
	
	function showLoading() {
		rialtoLoadingImage.show(parent);
	}
	
	function hideLoading() {
		rialtoLoadingImage.hide(parent);
	}
</script>
{/literal}

{/rialtoExample}