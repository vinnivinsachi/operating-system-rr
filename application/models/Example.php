<?php

class Application_Model_Example extends Custom_Model_Abstract
{
	// setup
	protected $_primaryKeyColumn = 'example_ID';
	protected $_mapperClass = 'Application_Model_Mapper_Examples';
	
	// columns
	public $example_ID;
	
	// associated models
	private $otherModels;
}
