<?php

class Application_ParentController_Notifications extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    }
	
	public function indexAction() {
		// call self::getMoreNotifications('all', 0)
	}
	
	public function getMoreNotificationsAction() {
		// IF GET
			// get $type and $paginationCounter from GET
			// call get more notifications($type, $paginationCounter)
		// ELSE
			// nothing
	}
	
	public function markNotificationAsReadAction() {
		// IF GET
			// IF memberID has permission to edit notification
				// IF process Notification::markAsRead($notificationID) successful
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (no permission)
				// process failure
		// ELSE
			// nothing
	}
	
	public function deleteNotificationAction() {
		// IF GET
			// get notification from DB
			// IF memberID has permission to delete notification
				// IF process Resource::delete($notification) success
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (no permission)
				// process failure
		// ELSE 
			// nothing
	}
	
	
	
	private function getMoreNotifications($type, $paginationCounter) {
		// get nitifications mapper
		// get some notifications from DB for memberID (using vars) via mapper
		// pass notifications to view
	}
		
}