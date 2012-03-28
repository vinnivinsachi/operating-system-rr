<div class='padding-top-large'>
	
	<div class='page-title-left'>Register</div>

	<div class='spacer-medium'></div>

	<form id='form-register' class='rialtoForm rialtoAjaxForm' rCallback='formRegisterCallback' method='post' enctype='multipart/form-data' action='{$this->getUrl("registration", "register-new-user")}'>
	    <div>
	       	<label class='required' for='form-register-email'>Email</label>
	        <input class='validate[required]' type='text' id='form-register-email' name='formRegister[email]' />
	    </div>
	    <div>
	       	<label class='required' for='form-register-display-name'>Display Name</label>
	        <input class='validate[required]' type='text' id='form-register-display-name' name='formRegister[display_name]' />
	    </div>
		<div>
	       	<label class='required' for='form-register-password'>Password</label>
	        <input class='validate[required]' type='password' id='form-register-password' name='formRegister[password]' />
	    </div>
		<div>
	       	<label class='required' for='form-register-password-confirm'>Password Confirmation</label>
	        <input class='validate[required]' type='password' id='form-register-password-confirm' name='formRegister[password_confirm]' />
	    </div>
		<div>
	       	<label class='required'><input class='validate[required]' type='checkbox' id='form-register-read-terms' name='formRegister[read_terms]' /></label>
			I have read and agree to the <a href='javascript:;'>terms and conditions</a>
		</div>

		<div class='spacer-small'></div>

		<div>
			<label>&nbsp;</label>
			<input type='submit' value='Save' />
		</div>
	</form>
	
</div>

{literal}
<script type='text/javascript'>
	function formRegisterCallback(data, elmt) {
		if(data.error) alert('error!');
		else alert('success!');
	}
</script>
{/literal}