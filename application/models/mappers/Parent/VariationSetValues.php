<?php

class Application_Model_Mapper_Parent_VariationSetValues extends Custom_Model_Mapper_Abstract
{
	/**
	 * This returns the next order position for a new variation set. 
	 * @param string $ownerColumn
	 * @param integer $ownerID
	 */
	public function fetchNextOrderPositionForVariationSetValue($ownerIDColumn, $ownerID){
		$select = $this->getDbTable()->select(); // get select object
		$select->from($this->getDbTable(), 'max(order_position)+1 as next_order_position')
			   ->where($ownerIDColumn.' = ? ', $ownerID);
			   
		$result = $this->fetchOneByQuery($select);
		return $result['next_order_position'];	
	}
	
	/**
	 * This return all the variation values for a given variation set ID
	 * @param integer $variationSetID
	 * @return array
	 */
	public function fetchAllForSetID($variationSetID){
		$result = $this->fetchAllByColumn(array($this->setIDColumn => $variationSetID), null, 'array');
		return $result;
	}
	
}
