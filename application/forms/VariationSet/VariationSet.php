<?php

class Application_Form_VariationSet_VariationSet extends Custom_Zend_Form
{

    public function init()
    {
		$this->setName('form-new-variation-set');

		$name = new Zend_Form_Element_Text('set_name');
		$name->setRequired(true);
		
		$displayName = new Zend_Form_Element_Text('display_name');
		$displayName->setRequired(true);
		
		$storeID = new Zend_Form_Element_Text('member_ID');
		$storeID->setRequired(true);
		
		
		// Add all the elements to the form
		$this->addElement($name)
			 ->addElement($displayName)
			 ->addElement($storeID);
    }


}

