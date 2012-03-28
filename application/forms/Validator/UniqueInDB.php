<?php

class Application_Form_Validator_UniqueInDB extends Zend_Validate_Abstract
{
	private $_mapper;
	private $_column;
	
	const IN_USE = 'inUse';
	
	// Zend Interface message template
	protected $_messageTemplates = array(
	       self::IN_USE => "'%value%' is already taken"
    );
	
	
	public function __construct($mapper, $column){
		$this->_mapper = $mapper;
		$this->_column = $column;
	}
	
	public function isValid($value) {
		$this->_setValue($value); // set value for retrieval by error message (mandetory by interface)
		if($this->_mapper->fetchOneByColumn($this->_column, $value, array('include' => array($this->_column)))) {
			$this->_error(self::IN_USE); // create error message
			return false; // query mapper
		}
		else return true;
	}

}

