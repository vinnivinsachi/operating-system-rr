<?php

class Application_ParentController_ListingsController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    }
	
	//public function managestockAction(){}
	
	public function editQuantityForItemsAction() {
		// IF form is valid
			// FOR EACH item IN form
				// IF $this->memberID has permission to edit item
					// IF process Item::editQuantity($itemID, $qty) successful
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (no permission)
					// process failure
		// ELSE (form not valid)
			// process failure
	}
	
	public function editItemStatusAction() {
		// get status from POST
		// get item public ID from POST
		// get item from DB
		// IF $this->memberID has permission to edit item
			// SWITCH to private function based on type of action submitted in POST
		// ELSE (no permission)
			// process failure
	}
	
	private function listItem($item) {
		// set item status
		// IF process Resource::save($item) successful
			// pass success to view
		// ELSE (process failure)
			// process failure
	}
	
	private function unlistItem($item) {
		// set item status
		// IF process Resource::save($item) successful
			// pass success to view
		// ELSE (process failure)
			// process failure
	}
	
	private function deleteItem($item) {
		// set item status
		// IF process Resource::save($item) successful
			// pass success to view
		// ELSE (process failure)
			// process failure
	}
		
}