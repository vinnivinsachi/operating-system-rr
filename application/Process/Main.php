<?php

class Application_Process_Main
{
	// wraps a process in a DB transaction and TRY CATCH block
	static public function runProcess($processFunctionName, $paramsArray) {
		Zend_Db_Table::getDefaultAdapter()->beginTransaction(); // start DB transaction
		try { // TRY
			$processResult = call_user_func_array($processFunctionName, $paramsArray); // get $result from call_user_func_array($processFunctionName, $paramsArray);
			Zend_Db_Table::getDefaultAdapter()->commit(); // end DB transaction
			return $processResult; // return $result
		} catch(Exception $exception) { // CATCH(error)
			return self::catchException($exception); // self::catchError(error)
		}
	}
	
	static public function catchException(Exception $exception, $data=null) {
		Zend_Db_Table::getDefaultAdapter()->rollBack(); // rollback changes
		$errorMessage = $exception->getMessage(); // get error message
		$userErrorMessage = Application_Constants_Errors::SQL_ERROR; // generate a message for the end user
		// ??? get error code
		return new Application_Process_Result(false, $data, $userErrorMessage); // build process result(false, error)
	}

}
