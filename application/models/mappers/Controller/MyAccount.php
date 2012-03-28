<?php

class Application_Model_Mapper_Controller_MyAccount extends Custom_Model_Mapper_Controller_Abstract
{
	static public function getUserMemberInfo($memberID) {
		// TODO don't get password or salt from DB
		$select = self::getDb()->select();
		$select->from(array('m' => 'members'))
			   ->join(array('u' => 'users'), 'u.member_ID = m.member_ID')
			   ->where('m.member_ID = ?', $memberID);
		return self::fetchOneByQuery($select);
	}
	
}