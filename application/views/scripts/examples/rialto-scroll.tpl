{rialtoExample}

<button onclick='scrollToBottom()'>Scroll To An Element At The Bottom</button>

<div style='height:2000px;'></div>

<button id='divAtBottom' onclick='scrollToTop()'>Scroll To The Top</button>

{literal}
<script type='text/javascript'>
	
	window.addEvent('domready', function(){
		rialtoScroll = $Rialto.getPlugin('RialtoScroll');
	});
	
	function scrollToBottom() {
		rialtoScroll.scrollWindow('divAtBottom');
	}
	
	function scrollToTop() {
		rialtoScroll.scrollWindow('top');
	}
	
</script>
{/literal}

{/rialtoExample}