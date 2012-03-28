<?php

class Application_ParentController_SalesController extends Custom_Zend_Controller_Action
{

    public function init() {
    	parent::init();  // Because this is a custom controller class
    }

	public function indexAction() { // open orders
		// get all open sold orders and order items for $this->memberID from DB (Application_Model_Mapper_Controller_Sales::getSoldOrdersForMember($memberID, 'open'))
		// pass orders to view
	}
	
	public function submitTrackingForOrderItemAction() {
		// IF form valid
			// IF $this->memberID has permission to send order item
				// create status for order item from form
				// IF submit tracking (process OrderItem::updateStatus($status)) successful
					// get $status from ProcessResult
					// generate notification $data array
					// IF notify (process Notifications::notify('orderItemTrackingSubmitted', $data)) successful
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (process failure)
					// process failure
			// ELSE (no permission)
				// process failure
		// ELSE (form not valid)
			// process failure
	}
	
	public function printOrderItemReceiptAction() {
		// get order item ID from GET
		// get $member from DB for $this->memberID
		// IF $member has permission to send order item
			// get order item / buyer address / $member address from DB (Application_Model_Mapper_Controller_Sales::getOrderItemPackagingInfo($orderItemID))
			// pass order item to view
			// pass buyer address to view
			// pass $member address to view
		// ELSE (no permission)
			// pass failure to view
			// pass failure message to view
	}
	
	public function printAddressLabelsAction() {
		// get order item ID from GET
		// get $member from DB for $this->memberID
		// IF $member has permission to send order item
			// get buyer address / $member address from DB (Application_Model_Mapper_Controller_Sales::getShippingAddresses($orderItemID))
			// pass buyer address to view
			// pass $member address to view
		// ELSE (no permission)
			// process failure
	}
	
	public function sendOrderItemMessageAction() {
		// IF form valid
			// IF $this->memberID has permission to submit message for order item
				// create orderItemMessage from form
				// IF send message (process Resource::save($message)) successful
					// get order_item_message from ProcessResult
					// generate notification $data array
					// IF notify (process Notification::notify('orderItemMessagePosted' $data)) successful
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (process failure)
					// process failure
			// ELSE (no permission)
				// process failure
		// ELSE (form not valid)
			// process failure
	}
	
	public function cancelOrderItemAction() {
		// IF POST
			// IF form is valid
				// IF $this->memberID has permission to cancel order item
					// IF process OrderItemProcess::cancel(orderItemID) successful
						// NotificationsProcess::notify();
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (no permission)
					// process failure
			// ELSE (form not valid)
				// process failure
		// ELSE IF GET
			// get order item ID from GET
			// IF LIU has permission to cancel order item
				// get order item from DB
				// pass order item to view
			// ELSE (no permission)
				// process failure
	}
	
	public function acceptReturnAction() {
		// get order item ID from GET
		// IF $this->memberID has permission to accept return for order item
			// IF process OrderItemProcess::acceptReturn($orderItemID) successful
				// pass success to view
			// ELSS (process failure)
				// process failure
		// ELSE (no permission)
			// process failure
	}
	
	public function getOrderItemStatusesAction() {
		// get order item ID from GET
		// IF $this->memberID has permission to see order item
			// get order item statuses from db
			// send statuses to view
			// pass success to view
		// ELSE (no permission)
			// pass failure to view
			// pass failure message to view
	}
	
	public function editOrderItemNotesAction() {
		// get order item ID from POST
		// get order item from DB
		// IF $this->memberID has permission to edit order item
			// set order item notes property
			// IF process Resource::save($orderItem) usccessful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE (no permission)
			// proccess failure
	}
	
	public function orderDetailsAction() {
		// get order public ID from form
		// IF $this->memberID has permission to view order (Application_Model_Mapper_Controller_Sales::getOrder($orderItemID))
			// get order from DB
			// pass order to view
			// pass success to view
		// ELSE (no permission)
			// proccess failure
	}
	
	public function orderItemDetailsAction() {
		// get order item public ID from form
		// IF $this->memberID has permission to view order item (Application_Model_Mapper_Controller_Sales::getOrderItem($orderItemID))
			// get order item from DB
			// pass order item to view
			// pass success to view
		// ELSE (no permission)
			// proccess failure
	}
	
	public function salesHistoryAction(){
		// get all sold orders for $this->memberID from DB (Application_Model_Mapper_Controller_Sales::getSoldOrdersForMember($memberID, 'completed'))
		// pass orders to view
	}
	
	public function viewOrderItemPaymentSummaryAction() {
		// get order item public ID from GET
		// IF $this->memberID has permission to view order item
			// get order item payment summary from DB
			// pass payment summary to view
		// ELSE (no permission)
			// process failure
	}
	
	public function reviews() {
		// get all reviews for memberID from DB via mapper
		// pass reviews to view
	}
	
	public function arbitrationsAction() {
		// get arbitrations for $this->memberID from DB
	}
		
}