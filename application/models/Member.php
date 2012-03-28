<?php

class Application_Model_Member extends Custom_Model_Abstract implements Zend_Acl_Role_Interface
{
	// setup
	protected $_primaryKeyColumn = 'member_ID';
	protected $_mapperClass = 'Application_Model_Mapper_Members';
	
	// columns
	public $member_ID;
	public $email;
	public $password;
	public $salt;
	public $status;
	public $display_name;
	public $role;
	public $time_created;
	public $time_updated;
	
	// associated models
	
	// used with Zend_Acl
	public function getRoleId() {
		return $this->role; // return the role
	}
}
