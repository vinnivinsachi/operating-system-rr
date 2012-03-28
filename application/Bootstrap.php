<?php

require_once APPLICATION_PATH.'/../library/Custom/Zend/Application/Bootstrap.php';
class Bootstrap extends Custom_Zend_Application_Bootstrap
{
	// set up routes for pretty urls
	public function _initRoutes(){
		$front = Zend_Controller_Front::getInstance();
		
		//$front = addControllerDirectory(APPLICATION_PATH.'/controllers')
		
		// example route
			//$route = new Zend_Controller_Router_Route('partials/:partialName/layout/none/*', array('controller'=>'partials', 'action'=>'index'));
			$storeAccountRoute = new Zend_Controller_Router_Route('store-account/:action/:storeDisplayName/*', array('controller'=>'store-account'));
			$storeVariationsRoute = new Zend_Controller_Router_Route('store-variations/:action/:storeDisplayName/*', array('controller'=>'store-variations'));
			
		// add routes
			$front->getRouter()->addRoute('storeVariations', $storeVariationsRoute)
							   ->addRoute('storeAccount', $storeAccountRoute);
	}
}
