<?php

class Application_Process_Result
{
	public $success; // true / false
	public $errorMessage;
	public $data;
	
	/**
	 * @param bool $success
	 * @param unkown_type $data
	 * @param string $errorMessage
	 */
	public function __construct($success, $data=null, $errorMessage=null) {
		$this->success = $success;
		$this->errorMessage = $errorMessage;
		$this->data = $data;
	}
	
}
