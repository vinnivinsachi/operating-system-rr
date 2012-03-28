<?php
class Application_Acl_Assert
{
	
	/**
	 * This verifies whether a particular LIU has permission to manage a store with store display name $storeDN
	 * 
	 * @param Application_Model_Member $member stuff
	 * @param string $storeDN
	 * @return bool
	 */
	static public function memberManagesStore($member, $storeDN) {
		if($member->display_name == $storeDN) return true; // IF $memberDN is same as $storeDN
		$select = self::getDb()->select();
		$select->from(array('uhs' => 'users_has_stores'), 'uhs.user_ID')
			   ->join(array('u' => 'members'), 'uhs.user_ID = u.member_ID', null)
			   ->join(array('s' => 'members'), 'uhs.store_ID = s.member_ID', null)
			   ->where('s.display_name = ?', $storeDN)
			   ->where('uhs.user_ID = ?', $member->member_ID)
			   ->where('s.status = ?', Application_Constants_Statuses::$ACTIVE)
			   ->where('u.status = ?', Application_Constants_Statuses::$ACTIVE);
		return self::queryReturnsOne($select);
	}
	
	
	/**
	 * This verifies whether a store has permission to manage a variation set and all of its values
	 * 
	 * @param id $storeName
	 * @param id $variationSetID
	 * @param Application_Model_Mapper_Abstract $setsMapperClass
	 * @return bool
	 */
	static public function ownerOwnsVariationSet($ownerID, $variationSetID, $setsMapperClass){
		if($setsMapperClass->fetchOneByColumn(array($setsMapperClass->ownerIDColumn => $ownerID, $setsMapperClass->getPrimaryKeyColumn() => $variationSetID)))
			return true;
		return false; 
	}
	
	
	// returns a single result from a custom query
	private function queryReturnsOne($query) {
		// TODO make sure Exception goes to error controller
		
		$db = self::getDb(); // get default adapter
		$rowset = $db->query($query)->fetchAll(); // query db using provided query
		
		if(count($rowset) == 0) return false; // return false if nothing found
		else if(count($rowset) == 1) return true; // return true if one found
		else if(count($rowset) > 1) throw new Exception("More than one result found from query: $query"); // throw error if more than one found				
	}
	
	private function getDb() {
		return Zend_Db_Table::getDefaultAdapter(); // get db adapter
	}

}
