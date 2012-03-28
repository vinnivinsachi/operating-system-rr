<?php

class Application_Model_Mapper_Controller_MyOrders
{
	static public function getOrdersForUser($userID, $status) {
		// get all orders,
		// associated order items,
		// and image for order item design from DB where $status
		// return array of arrays of orders
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
	
	static public function getOrderItemReturnPackagingInfo($orderItemID) {
		// get order item info,
		// and seller address from DB
		// create order item model
		// add seller address to model
		// return order item
	}
	
}