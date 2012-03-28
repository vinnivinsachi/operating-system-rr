{foreach from=$elmts item=elmt}
	<div class='sample rPaginationElement {if isset($elmt.class)}{$elmt.class}{/if}' {if isset($elmt.class)}rialtoPaginationPage='{$elmt.page}'{/if} style='background-color:#{$elmt.color}'>PAGE: {$elmt.page}</div>
{/foreach}