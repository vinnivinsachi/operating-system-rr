{rialtoExample}
<form>
<ul>
	<ul class='rPalette rPaletteInverted rPaletteLarge' rPaletteMaxSelections='2' rPaletteClickElmtSelector='> li' rPalettePreDispatch='preDispatch' rPalettePostDispatch='postDispatch'>
		<li>
			<span class='rPaletteColor rPaletteColor-red' title='Red'></span>
			<input class='hidden' type='checkbox' name='filters[color][red]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-orange' title='Orange'></span>
			<input class='hidden' type='checkbox' name='filters[color][orange]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-yellow' title='Yellow'></span>
			<input class='hidden' type='checkbox' name='filters[color][yellow]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-green' title='Green'></span>
			<input class='hidden' type='checkbox' name='filters[color][green]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-blue' title='Blue'></span>
			<input class='hidden' type='checkbox' name='filters[color][blue]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-indigo' title='Indigo'></span>
			<input class='hidden' type='checkbox' name='filters[color][indigo]' />
		</li>
		<li>
			<span class='rPaletteColor rPaletteColor-violet' title='Violet'></span>
			<input class='hidden' type='checkbox' name='filters[color][violet]' />
		</li>
		<br />
		<li>
			<span class='rPaletteText'>Pinstripe</span>
			<input class='hidden' type='checkbox' name='filters[color][pinstripe]' />
		</li>
		<li>
			<span class='rPaletteText'>Pattern</span>
			<input class='hidden' type='checkbox' name='filters[color][pattern]' />
		</li>
		<li>
			<span class='rPaletteText'>Print</span>
			<input class='hidden' type='checkbox' name='filters[color][print]' />
		</li>
	</ul>			
</ul>

<input type='submit' value='sdf' />
</form>

{literal}
<script type='text/javascript'>
	function preDispatch(elmt) {
		return true;
	}
	
	function postDispatch(elmt) {
		return true;
	}
</script>
{/literal}

{/rialtoExample}