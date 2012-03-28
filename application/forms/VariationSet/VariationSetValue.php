<?php

class Application_Form_VariationSet_VariationSetValue extends Custom_Zend_Form
{
	// TODO make sure this form input validations are correct
    public function init()
    {
		$this->setName('form-new-variation-set-value');

		$value = new Zend_Form_Element_Text('value');
		$value->setRequired(true);
		
		$memberVariationSetID = new Zend_Form_Element_Text('member_variation_set_ID');
		$memberVariationSetID->setRequired(true);
		
		
		
		$priceOffset= new Zend_Form_Element_Text('price_offset');
		$priceOffset->setRequired(true);
		
		
		// Add all the elements to the form
		$this->addElement($value)
			 ->addElement($memberVariationSetID)
			 ->addElement($priceOffset);
    }
}

