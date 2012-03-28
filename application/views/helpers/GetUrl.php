<?php

class Zend_View_Helper_GetUrl extends Zend_View_Helper_Abstract
{
    public function getUrl($controller, $action='index', $routeName=null, $reset=true) {		
		$helper = Zend_Controller_Action_HelperBroker::getStaticHelper('url'); // get helper from Zend
		print $helper->url(array('controller'=>$controller, 'action'=>$action), $routeName, $reset); // 
	}

}
