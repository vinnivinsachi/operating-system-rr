<?php
class Zend_View_Helper_GetIdentity extends Zend_View_Helper_Abstract
{
    public function getIdentity() {
	$this->gogo = 'gogoo';
    	$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()) return $auth->getIdentity();
		return null;
    }

}
