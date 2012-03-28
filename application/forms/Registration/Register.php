<?php

class Application_Form_Registration_Register extends Custom_Zend_Form
{

    public function init()
    {
		$this->setName('form-register');

		// Email
		$email = new Zend_Form_Element_Text('email');
		$email->addFilter('StringTrim')
		  	  ->addFilter('StringToLower')
			  ->setRequired(true)
			  ->addValidator('EmailAddress')
			  ->addValidator(new Application_Form_Validator_UniqueInDB(new Application_Model_Mapper_Members, 'email'));

		// Display Name
		$displayName = new Zend_Form_Element_Text('display_name');
		$displayName->setRequired(true)
					->addValidator('StringLength', true, array(6, 20))
					->addValidator(new Application_Form_Validator_UniqueInDB(new Application_Model_Mapper_Members, 'display_name'), true);

		// Password
		$password = new Zend_Form_Element_Password('password');
		$password->setRequired(true)
				 ->addValidator('StringLength', true, array(6, 30));
		
		// Password Confirm
		$passwordConfirm = new Zend_Form_Element_Password('password_confirm');
		$passwordConfirm->setRequired(true)
						->addValidator('Identical', true, 'password');
		
		// Read Terms
		$readTerms = new Zend_Form_Element_Checkbox('read_terms');
		$readTerms->setRequired(true);
		
		// Add all the elements to the form
		$this->addElement($email)
			 ->addElement($displayName)
			 ->addElement($password)
			 ->addElement($passwordConfirm)
			 ->addElement($readTerms);
    }


}

