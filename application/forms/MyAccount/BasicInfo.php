<?php

class Application_Form_MyAccount_BasicInfo extends Custom_Zend_Form
{

    public function init()
    {
		$this->setName('form-basic-info');

		$phone = new Zend_Form_Element_Text('phone');
		$firstName = new Zend_Form_Element_Text('first_name');
		$lastName = new Zend_Form_Element_Text('last_name');
		$birthDate = new Zend_Form_Element_Text('birth_date');
		$postalCode = new Zend_Form_Element_Text('postal_code');
		$country = new Zend_Form_Element_Text('country');
		$danceExperience = new Zend_Form_Element_Text('dance_experience');

		
		// Add all the elements to the form
		$this->addElement($phone)
			 ->addElement($firstName)
			 ->addElement($lastName)
			 ->addElement($birthDate)
			 ->addElement($postalCode)
			 ->addElement($country)
			 ->addElement($danceExperience);
    }


}

