<?php

class RegistrationController extends Custom_Zend_Controller_Action
{
	public function preDispatch() {
		parent::preDispatch();
		$this->_ajaxContext->addActionContext('register-new-user', 'json')
			 			   ->initContext();
	}
	
    public function indexAction() {
		// nothing
	}
	
	public function registerNewUserAction() {
		$this->noRender(); // no view for this action
		if($this->_request->isPost()) { // IF POST
			$formRegister = new Application_Form_Registration_Register($this->_request->getPost('formRegister')); // create form
			if($formRegister->drIsValid()) { // IF form valid
				$modelMember = new Application_Model_Member($formRegister->getValues()); // create member model from form
				$processResult = Application_Process_Main::runProcess('Application_Process_NewUser::register', array($modelMember)); // IF process NewUser::register(member) successful
				if($processResult->success) {
					$this->view->success = true; // pass success to view
				} else { // ELSE (process failure)
					$this->processFailure($processResult->errorMessage, false); // process failure
				}
			} else { // ELSE (invalid form)
				$this->processFailure(Application_Constants_Errors::FORM_INVALID, false, $formRegister->getMessages()); // process failure
			}
		}
	}
	
	public function verifyEmailAction() {
		// IF GET
			// get email and verification key from GET
			// get members mapper
			// IF verify member email (process(NewUser::verifyEmail)) successful
				// log the user in
				// pass sucess to view
			// ELSE (process failure)
				// process failure
		// ELSE (not GET)
			// nothing
	}
	
	public function checkEmailAvailabilityAction() {
		// IF GET
			// get email from GET
			// IF email valid
				// instantiate member mapper
				// IF mapper->emailAvailable
					// pass available=true to view
				// ELSE (email not available)
					// pass avilable=false to view
			// ELSE (invalid email)
				// process failure
		// ELSE (not GET)
			// nothing
	}
	
	public function checkDisplayNameAvailabilityAction() {
		// IF GET
			// get display name from GET
			// IF display name valid
				// instantiate member mapper
				// IF mapper->displayNameAvailable
					// pass available=true to view
				// ELSE (displayName not available)
					// pass avilable=false to view
			// ELSE (invalid display name)
				// process failure
		// ELSE (not GET)
			// nothing
	}
	
	public function registerNewStoreAction() {
		// IF POST
			// IF for valid
				// create store model from form
				// create member model from form
				// attach member to store
				// IF process NewStore::register(store) successful
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (invalid form)
				// process failure
		// ELSE (not POST)
			// nothing
	}
  
}
