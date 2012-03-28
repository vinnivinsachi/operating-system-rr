<?php
class Application_Model_Mapper_Controller_Variations
{
	/**
	 * 
	 * Enter this fetches all variations for a particulare variations owning entity.
	 * @param integer $associatedID, such as the value for memberID, designID, designCategoryID, itemID
	 * @param $associatedModel, such as memberVariationModel, designVariationModel, designCategoryVariationModel, itemVariationModel
	 */
	static public function getAllVariations(integer $associatedID,  $associatedModel){
		$variationSets = $associatedModel->fetchAllByColumn(array($associatedModel->_primaryKey => $associatedID));
		Zend_Debug::dump($variationSets);
		return;
		//get all variationSets for associatedID
		//
	
	}
}
