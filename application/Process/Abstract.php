<?php

abstract class Application_Process_Abstract
{
	
	//public function init() {}
	
	public function catchError($error, $data=null) {
		// rollback changes
		// get error message
		// get error code
		// build process result(false, error)
		// return process result
	}
	
}
