<?php

class Application_Model_Mapper_Controller_Balance
{
	static public function getDRCTransactionsForUser($userID) {
		// get all pending DRC transactions for $userID from DB
		// get some completed DRC transactions for $userID from DB
		// get available RC for $userID from DB
		// return array
	}
	
	static public function getDRCTransactionsForStore($storeID, $status) {
		// get all pending DRC transactions for $storeID from DB where $status
		// get available RC for $storeID from DB
		// return array
	}
	
	static public function getDRCTransactionsForMemberByDate($memberID, $status, $dates) {
		// get transactions for member where $status in date range via mapper
		// return array
	}
	
	static public function getRPTransactionsForUser($userID) {
		// get all pending RP transactions for userID from DB
		// get some completed RP transactions for userID from DB
		// get available RP for userID from DB
		// return array of arrays
	}
	
	static public function getRPTransactionsForUserByDate($userID, $status, $dates) {
		// get all RP transactions for user where $status in $dates via mapper
		// return array
	}
	
	static public function getGCTransactionsForUser($userID) {
		// get all pending GC transactions for $userID from DB
		// get some completed GC transactions for $userID from DB
		// get available GC for $userID from DB
		// return array
	}
	
	static public function getGCTransactionsForUserByDate($userID, $status, $dates) {
		// get all GC transactions for user where $status in $dates via mapper
		// return array
	}
	
}