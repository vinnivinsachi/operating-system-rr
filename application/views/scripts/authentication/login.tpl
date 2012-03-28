<div class='border-bottom'>
	
	<div class='page-title-left'>Login</div>

	<div class='spacer-medium'></div>

	<form class='rialtoForm rialtoJsonForm' rialtoResponseCallback='loginCallback' action='{$siteRoot}/authentication/authenticate' method='post'>

	    <div>
	       	<label class='required' for='login-email'>Email</label>
	        <input class='required' type='text' id='login-email' name='login[email]' value='markisacat@gmail.com' />
	    </div>
		<div>
	       	<label class='required' for='login-password'>Password</label>
	        <input class='validate[required]' type='password' id='login-password' name='login[password]' value='111' />
	    </div>
		<div>
			<label></label>
			<a href='javascript:;'>I forgot my password</a>
		</div>

		<div class='spacer-small'></div>

		<div>
			<label></label>
			<input type='submit' value='Login' loadingText='Logging in...' />
	    </div>

		<div class='spacer-large'></div>
		<div class='spacer-large'></div>

		<!-- <div><a class='rialtoPopup' href='{$siteRoot}/popups/register'>I want to register a new account</a></div> -->

	</form>
	
</div>

{$this->partial('registration/index.tpl')}

{literal}
<script>
	function loginCallback(data, elmt) {
		if(data.success) {
			$j.fancybox.close(); // close fancybox
			authLogin(data.loggedInUser);
		}
		else {
			$Rialto.getPlugin('RialtoFlashMessage').show('Incorrect email / password combination');	// flash error message
			elmt.getElements('#login-password').set('value', ''); // reset password field
		}
	}
</script>
{/literal}
