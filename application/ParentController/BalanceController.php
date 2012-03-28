<?php

class Application_ParentController_BalanceController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    }
	
	public function completedDanceRialtoCreditTransactionsByDateAction() {
		// IF form valid
			// get completed DRC transactions in date range for membderID (Application_Model_Mapper_Controller_Balance::getDRCTransactionsForMemberByDate($memberID, $status, $dates))
			// pass transactions to view
			// pass success to view
		// ELSE (form not valid)
			// process failure
	}
	
	public function withdrawDanceRialtoCreditAction() {
		// IF POST
			// IF form valid
				// IF process TransactionDRC::withdrawal($memberID, $amount) successful
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (form not valid)
				// process failure
		// ELSE IF GET
			// get available DRC for LIU
			// pass available DRC to view
			// pass success to view
	}

}