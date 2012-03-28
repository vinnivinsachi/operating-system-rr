<?php

class Application_Process_NewUser
{
	static public function register(Application_Model_Member $member) {
		Application_Process_Resource::save($member); // save via Resource process
		Application_Process_Email::send(Application_Constants_Emails::$REGISTER_VERIFY_EMAIL, array($member->email), $member); // send verify email email
		return new Application_Process_Result(true, $member); // return result
	}
	
	static public function verifyEmail($email, $key) {
		// get members mapper
		// get member from email and key from mapper->fetchOneByColumn()
		// get memberID from result
		// IF NOT member
			// create ProcessResult(false, errorMsg, null)
			// return result
		// set member status to 'active' via mapper->updateColumns()
		// self:initializeUser($member)
		// create ProcessResult(true, memberID)
		// return result
	}
	
	private function initializeUser($memberID) {
		// create user model with member_ID
		// Resource::save(user)
		// create member_current_balance model with member_ID
		// Resource::save(member_current_balance)
		// create user_shopping_cart model
		// Resource::save(user_shopping_cart)
	}
	
}
