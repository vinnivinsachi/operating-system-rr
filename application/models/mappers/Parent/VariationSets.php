<?php

class Application_Model_Mapper_Parent_VariationSets extends Custom_Model_Mapper_Abstract
{
	/**
	 * This returns the next order position for a new variation set. 
	 * @param integer $associatedID
	 */
	public function fetchNextOrderPositionForVariationSet($ownerID){
		$select = $this->getDbTable()->select(); // get select object
		$select->from($this->getDbTable(), 'max(order_position)+1 as next_order_position')
			   ->where($this->ownerIDColumn.' = ? ', $ownerID);
			   
		$result = $this->fetchOneByQuery($select);
		return $result['next_order_position'];	
	}
	
	/**
	 * This returns all variation sets for its respective owning entity with an ownerID
	 * @param integer $ownerID
	 * @return array
	 */
	public function fetchAllForOwner($ownerID){
		$select = $this->getDbTable()->select();
		$select->from($this->getDbTable(), '*')
			   ->where($this->ownerIDColumn.'= ?', $ownerID);

		$result = $this->fetchAllByQuery($select);
		return $result;
			   
	}
}
