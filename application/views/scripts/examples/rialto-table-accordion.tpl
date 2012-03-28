{rialtoExample}

<table class='rialtoTableAccordion'>
	<thead>
		<tr>
			<th scope='col'>Row<span class='icon icon-arrwo-up'></span></th>
			<th scope='col'>Info<span class='icon icon-arrwo-up'></span></th>
			<th scope='col'>More Info<span class='icon icon-arrwo-up'></span></th>
		</tr>
	</thead>
	<tbody>
		
		<tr class='RialtoTableAccordion'>
			<td>Loads a Load Replaces</td>
			<td>Some Info</td>
			<td>More Info</td>
		</tr>
		<tr class='rialtoTableAccordionHidden'>
			<td colspan=3>
				<div class='rTableAccordionContent'>
					<span class='rialtoLoadReplaces' rialtoLoadReplacesURL='{$siteRoot}/partials/content'>DOES NOT  CURRENTLY SUPPORT LOAD REPLACES</span>
				</div>
			</td>
		</tr>
		
		<tr class='RialtoTableAccordion' rialtoTableURL='{$siteRoot}/partials/content'>
			<td>Loads a URL</td>
			<td>Some Info</td>
			<td>More Info</td>
		</tr>
		<tr class='rialtoTableAccordionHidden'>
			<td colspan=3>
				<div class='rTableAccordionContent'>
					<div>CONTENT 2!</div>
				</div>
			</td>
		</tr>
		
		<tr class='RialtoTableAccordion' rialtoTableURL='{$siteRoot}/partials/content' rialtoTableFormID='example-form'>
			<td>Loads example form</td>
			<td>Some Info</td>
			<td>More Info</td>
		</tr>
		<tr class='rialtoTableAccordionHidden'>
			<td colspan=3>
				<div class='rTableAccordionContent'></div>
			</td>
		</tr>
		
	</tbody>
</table>

<form id='example-form'>
	Example Text: <input type='text' name='exampleText' />
</form>

{/rialtoExample}