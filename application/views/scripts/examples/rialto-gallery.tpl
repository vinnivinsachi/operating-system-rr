{rialtoExample}

<div class='RialtoGallery'>
	<div class='rialtoGallery-main-image'></div>
	<ul>
		{foreach from=$images item=image}
			<li class='RialtoGallery:li' rialtoGallerySrc='{$image}'></li>
		{/foreach}
	</ul>
</div>

{/rialtoExample}