{rialtoExample}

<div id='book' class='rialtoImageBook rib-medium'>
	<div class='rialtoImageBook-main-image'>
		<img src='{$dirImages}/rialtoImageBook/1/1_medium.jpg' />
	</div>
	<ul id='rialto-image-book-medium-thumbs'>
		<li>
			<a>
				<img src='{$dirImages}/rialtoImageBook/2/2_small.jpg' rialtoImageBookLargeImageURL='{$dirImages}/rialtoImageBook/2/2_medium.jpg' />
			</a>
		</li>
		<li>
			<a>
				<img src='{$dirImages}/rialtoImageBook/3/3_small.jpg' rialtoImageBookLargeImageURL='{$dirImages}/rialtoImageBook/3/3_medium.jpg' />
			</a>
		</li>
		<li>
			<a>
				<img src='{$dirImages}/rialtoImageBook/4/4_small.jpg' rialtoImageBookLargeImageURL='{$dirImages}/rialtoImageBook/4/4_medium.jpg' />
			</a>
		</li>
	</ul>
</div>


<div class='spacer-large'></div>

<button onclick='addImage()'>Add One</button>

{literal}
<script type='text/javascript'>
	function addImage() {
		$Rialto.getPlugin('RialtoImageBook').addImageToBook(
			$('book'),
			'{/literal}{$dirImages}/rialtoImageBook/5/5_medium.jpg{literal}',
			'{/literal}{$dirImages}/rialtoImageBook/5/5_small.jpg{literal}'
		);
	}
</script>
{/literal}

{/rialtoExample}