<?php

class Application_ParentController_Settings extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    }

	public function indexAction() { // notification settings
		// get all notification settings for memberID from DB
		// pass settings to view
	}
		
	public function saveNotificationSettingsAction() {
		// TODO add save button for settings
		// IF form valid
			// get model from DB via $this->mapper
			// update model
			// IF process Resource::save($model) successful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE (form not valid)
			// process failure
	}
	
	public function deactivateAccountAction() {
		// get member mapper
		// update status of member to 'deactivated' via member mapper for memberID
	}
		
}
