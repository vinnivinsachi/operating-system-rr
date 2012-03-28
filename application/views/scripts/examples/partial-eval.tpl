Evaluated Partial:
<br /><br />
{rialtoExample}
<div>
	{$evaluatedPartial}
</div>


$this->view->evaluatedPartial = $this->evalPartial('partials/example.tpl', array('example'=>'<div>GOGOGOGO</div>'));
{/rialtoExample}