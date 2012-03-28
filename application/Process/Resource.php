<?php

class Application_Process_Resource
{
	
	static public function save(Custom_Model_Abstract $resource) {
		$mapper = $resource->getMapperInstance(); // get mapper from resource
		$mapper->save($resource); // save resource via mapper
		return new Application_Process_Result(true, $resource);
	}
	
	static public function saveViaMapper(Custom_Model_Abstract $resource, Custom_Model_Mapper_Abstract $mapper) {
		$insertedID = $mapper->save($resource); // save resource via mapper
		$resource->_primaryKey = $insertedID; // setting the inserted ID to the resource
		return new Application_Process_Result(true, $resource);
	}
	
	static public function delete(Custom_Model_Abstract $resource) {
		$mapper = $resource->getMapperInstance(); // get mapper from resource
		$mapper->deleteModel($resource); // delete resource via mapper
		return new Application_Process_Result(true, $resource);
	}
	
	static public function deleteViaMapper(Custom_Model_Abstract $resource, Custom_Model_Mapper_Abstract $mapper) {
		$mapper->deleteModel($resource); // delete resouce via mapper
		return new Application_Process_Result(true, $resource);
	}
	
	static public function updateColumnsForIDViaMapper($id, array $data, Custom_Model_Mapper_Abstract $mapper) {
		$mapper->updateColumnsForID($id, $data); // update the columns
		return new Application_Process_Result(true, $data);
	}
	
}
	