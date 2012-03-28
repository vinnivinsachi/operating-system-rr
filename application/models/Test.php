<?php

class Application_Model_Test extends Custom_Model_Abstract
{
	// setup
	protected $_primaryKeyColumn = 'test_ID';
	protected $_mapperClass = 'Application_Model_Mapper_Tests';
	
	// columns
	public $test_ID;
	public $name;
	public $value;
	public $time_created;
	public $time_updated;
	
	// associated models
}
