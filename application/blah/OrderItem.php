<?php

class Application_Blah_OrderItem extends Application_Process_Abstract
{
	
	// RETURN $status
	public function updateStatus(Application_Model_OrderItemStatu $status) {
		// start DB transaction
		// TRY
			// get status mapper from status
			// save status via mapper
			// get order item mapper
			// update order item status
		// CATCH(error)
			// return self::catchError(error)
		// end DB transaction
		// create ProcessResult(true, $item)
		// return ProcessResult
	}
	
	
	public static function newF($a, $b) {
		print("arg 1: $a, arg 2: $b");
	}
	
	
	// MAIN PROCESS
	public function cancelOrder($id) {
		// start DB transaction
		// TRY
			// create status model from id
			// self::updateStatus($status)
			// TransactionsProcess::refund($id)
		// CATCH(error)
			// return self::catchError(error)
		// end DB transaction
		// create ProcessResult(true, )
		// return ProcessResult
	}
	
	
	// SUB PROCESS
	/*public function updateStatus(Application_Model_OrderItemStatu $status) {
		// get status mapper from status
		// save status via mapper
		// get order item mapper
		// update order item status
	}*/
	
	
}
