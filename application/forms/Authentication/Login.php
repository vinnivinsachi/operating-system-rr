<?php

class Application_Form_Authentication_Login extends Zend_Form
{

    public function init()
    {
    	// Set form options
		$this->setName('login');

		// Email
		$email = new Zend_Form_Element_Text('email');
		$email->setRequired(true)
				 	->addFilter('StringTrim')
				 	->addFilter('StringToLower');

		// Password
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(true);
		
		// Add all the elements to the form
		$this->addElement($email)
			 ->addElement($password);
    }


}

