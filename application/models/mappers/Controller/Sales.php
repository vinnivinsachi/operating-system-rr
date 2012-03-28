<?php

class Application_Model_Mapper_Controller_Sales
{
	static public function getSoldOrdersForMember($memberID, $status) {
		// get sold orders, 
		// order items,
		// and design image for member from DB where $status
		// return array
	}
	
	static public function getOrderItemPackagingInfo($orderItemID) {
		// get order item info,
		// and seller address from DB
		// create order item model
		// add seller address to model
		// return order item model
	}
	
	static public function getShippingAddresses($orderItemID) {
		// get order item shipping address
		// get seller shipping address
		// return array
	}
	
	static public function getOrder($orderID) {
		// get order info,
		// and order items from DB
		// create order model
		// create order item models for each order item
		// add order items to order
		// return order
	}
	
	static public function getOrderItem($orderItemID) {
		// get order item info,
		// order item details,
		// and order item messages for DB
		// create order item model
		// add order item message to model
		// return order item model
	}
	
}