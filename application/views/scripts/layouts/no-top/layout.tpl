{include file='layouts/partials/_html-top.tpl'}
	
	{include file='layouts/partials/_head.tpl'}
	{include file='layouts/partials/_body-top.tpl'}
	
		{literal}
			<style>
				#content-wrapper{
					padding: 0px;
				}
			</style>
		{/literal}

		{include file='layouts/partials/_content-top.tpl'}

			{$this->flashMessenger()}<!-- PHP FLASH MESSENGER -->
			{$layout->content}<!-- PAGE CONTENT -->
	
		{include file='layouts/partials/_content-bottom.tpl'}
		{include file='layouts/partials/_footer.tpl'}
		
	{include file='layouts/partials/_body-bottom.tpl'}

{include file='layouts/partials/_html-bottom.tpl'}
