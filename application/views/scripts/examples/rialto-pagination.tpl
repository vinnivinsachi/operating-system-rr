{rialtoExample}

<div id='elements-list' rialtoPaginationInjectionMethod='instant'>
{foreach from=$elmts item=elmt}
	<div class='sample {if isset($elmt.class)}{$elmt.class}{/if}' {if isset($elmt.class)}rialtoPaginationPage='{$elmt.page}'{/if} style='background-color:#{$elmt.color}'>PAGE: {$elmt.page}</div>
{/foreach}
</div>

<div class='rPagination' href='{$siteRoot}/examples/rialto-pagination-load' rialtoPaginationListID='elements-list'>
	<div class='rPaginationViewportCurrent'></div>
	<a id='rPaginationFirst'>&lt;&lt;</a>
	&nbsp;
	<a id='rPaginationPrev'>&lt;</a>
	<div class='rPaginationViewport'>
		<ul>
			<li><a>1</a></li>
			<li><a>2</a></li>
			<li><a>3</a></li>
			<li><a>4</a></li>
			<li><a>5</a></li>
			<li><a>6</a></li>
			<li><a>7</a></li>
			<li><a>8</a></li>
			<li><a>9</a></li>
			<li><a>10</a></li>
			<li><a>11</a></li>
			<li><a>12</a></li>
			<li><a>13</a></li>
			<li><a>14</a></li>
			<li><a>15</a></li>
		</ul>
	</div>
	<a  id='rPaginationNext'>&gt;</a>
	&nbsp;
	<a  id='rPaginationLast'>&gt;&gt;</a>
</div>

{literal}
<style>
	.sample {
		height: 60px;
		margin: 20px 0px;
	}
</style>
{/literal}

{/rialtoExample}