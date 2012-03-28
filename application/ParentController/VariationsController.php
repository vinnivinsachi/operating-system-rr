<?php

class Application_ParentController_VariationsController extends Custom_Zend_Controller_Action
{

	protected $ownerID;
	protected $setID;
	protected $setValueID;
	protected $setModelClass;
	protected $setValueModelClass;
	protected $formSetClass; 
	protected $formValueClass; // the form class that is repsonsible for editing the variation set values
	protected $setsMapperClass;
	protected $setValuesMapperClass;
	
	
	public function indexAction(){
		$variationSetMapper = new $this->setsMapperClass();
		$sets = $variationSetMapper->fetchAllForOwner($this->ownerID);
		//Zend_Debug::dump($sets);
		$this->view->variationSets = $sets;
		
	}
	
	public function newVariationSetAction() {
		
		if($this->_request->isPost()) { // IF POST
			$formVariationSet = new Application_Form_VariationSet_VariationSet($this->_request->getPost('newVariationSet')); // create form
				// TODO Variation set need a customize validation for unique set_names
				// TODO Add display name to form processing
			if($formVariationSet->drIsValid()) { // IF form valid
				$variationSetModel = $this->variationSetMapper->getModelInstance($this->_request->getPost('newVariationSet')); // instantiate the model from form
				$processResult = Application_Process_Main::runProcess('Application_Process_Variation::newSet', array($variationSetModel, $this->variationSetMapper, $this->associatedColumn, $this->associatedID));
				if($processResult->success) { // IF process Variation::newSet($set, $mapper) successful
					$this->view->success = true; // pass success to view
				}else{
					
					$this->processFailure($processResult->errorMessage, false); // process failure
				}  
				//Zend_Debug::dump($variationSetModel);
				// ELSE (process failure)
					// process failure
			} else { //(if form not valid)
				// process error
				echo 'not valid';
			}
			
		}
	}
	
	public function editVariationSetAction() {
		// IF POST
			// fill form with POST values
			// IF form is valid				
				// create variation set model
				// IF owner owns variation set
					// IF process Resource::save($set) successful
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (no permission)
					// process failure
			// ELSE (form not valid)
				// process error
		// ELSE IF GET
			// get variation set ID from GET
			// IF owner owns variation set
				// get variation set from DB
			// ELSE (no permission)
				// process failure
	}
	
	public function editVariationSetsOrderAction() {
		// IF GET
			// get variation set orders for GET
			// IF process Variation::updateSetsOrder(array($setID => $newOrderNum), $mapper) successful
				// pass success to view
			// ELSE (process failure)
				// process failure				
		// ELSE (not GET)
			// nothing
	}
	
	public function deleteVariationSetAction() {
		// IF GET
			// create variation set model
			// IF process Resources::DeleteViaMapper($set, $mapper) successful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE
			// nothing
	}
	
	public function getValuesForVariationSetAction(){
		$variationSetID = $this->_request->getParam('variationSetID'); // get variation set ID from GET
		if($variationSetID) { // IF variation ID passed
			$this->setsMapper = new $this->setsMapperClass();
			if(Application_Model_Acl_Assert::ownerOwnsVariationSet($this->ownerID, $variationSetID, $this->setsMapper)){ // IF owner owns variation set
			$this->setValuesMapper = new $this->setValuesMapperClass();
				 $values = $this->setValuesMapper->fetchAllForSetID($variationSetID, null, 'array');
					$valuesFormated = array();
					if(count($values)>0){
						foreach($values as $value){ // organizing the array into default values and group values
							// TODO is there a better way to organzie arrays to this format?  (ORDER BY?)
							if(!$value['group_name']){
								$valuesFormated['setValues'][]=$value;
							}else{
								$valuesFormated['groupValues'][$value['group_name']][]=$value;
							}
						}
					}
					$this->view->variationSetValues = $valuesFormated;
				$this->view->variationSetID = $variationSetID;
			} else {
				$this->errorAndRedirect(Application_Constants_Errors::NO_PERMISSION, 'index', 'index'); // redirect to index/index with error message
			}
		} 
	}
	
	
	/**
	 * return a processResult from adding new varation set values
	 * Although this acts like a process, it is an controller action because it utilizes Zend_Form
	 */
	public function newVariationSetValueAction() {
		$formVariationSetValues = new Application_Form_VariationSet_VariationSetValue($this->_request->getPost('newVariationSetValue'));
		if($formVariationSetValues->drIsValid()) { // IF form valid
			$variationSetValueModel = $this->variationSetValueMapper->getModelInstance($this->_request->getPost('newVariationSetValue')); // instantiate the model from form
			//Zend_Debug::dump($variationSetValueModel);
			$processResult = Application_Process_Main::runProcess('Application_Process_Variation::newSetValue', array($variationSetValueModel, $this->variationSetValueMapper, $this->associatedSetColumn, $this->associatedSetID)); // this returns the process result
			
		} else {
			$processResult = new Application_Process_Result('false', null, $formVariationSetValues->getErrors());			
		}
		
		return $processResult;
	}
	
	public function editVariationSetValueAction() {
		// IF POST
			// fill form with POST values
			// IF form is valid				
				// create variation set model
				// IF owner owns variation set value
					// IF process Resource::save($set) successful
						// pass success to view
					// ELSE (process failure)
						// process failure
				// ELSE (no permission)
					// process failure
			// ELSE (form not valid)
				// process error
		// ELSE IF GET
			// get variation set value ID from GET
			// IF owner owns variation set value
				// get variation set value from DB
			// ELSE (no permission)
				// process failure
	}
	
	public function editVariationSetValuesOrderAction() {
		// IF GET
			// get variation set value orders for GET
			// IF process Variation::updateValuesOrder(array($valueID => $newOrderNum), $mapper) successful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE (not GET)
			// nothing
	}
	
	public function deleteVariationSetValueAction() {
		// IF GET
			// create variations set value model from form
			// IF process Resource::deleteViaMapper($setValue, $mapper) successful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE
			// nothing
	}
	
	public function editVariationSetValueGroupAction() {
		// IF POST
			// IF form valid
				// get variation set value from DB
				// IF process Resource::saveViaMapper($variation, $mapper) successful
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (form not valid)
				// process failure
		// ELSE (not POST)
			// nothing
	}
	
	public function editVariationSetGroupNameAction() {
		// IF POST
			// IF form valid
				// IF Variation::editSetGroupName($setID, $oldGroupName, $newGroupName) successful
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (form not valid)
				// process failure
		// ELSE (not POST)
			// nothing
	}
	
	public function deleteVariationSetGroupAction() {
		// IF GET
			// IF process　VariationSet::deleteSetGroup($setID, $groupName) successful
				// pass success to view
			// ELSE (process failure)
				// process failure
		// ELSE (not GET)
			// nothing
	}
		
}
