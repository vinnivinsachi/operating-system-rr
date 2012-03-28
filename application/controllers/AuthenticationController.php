<?php

class AuthenticationController extends Custom_Zend_Controller_Action
{

    public function init() {
        parent::init();  // Because this is a custom controller class
    	$this->_ajaxContext->addActionContext('changepassword', 'json')
						   ->addActionContext('authenticate', 'json')
			 			   ->initContext();
    }

    public function indexAction() {}
    public function loginAction() {}

	public function authenticateAction() {
		$form = new Application_Form_Authentication_Login(); // get login form
		$request = $this->getRequest(); // get request
      	if($request->isPost()) { // IF form was submitted (via POST)
			if($form->isValid($request->getPost('login'))) { // IF the form is valid
				$loginValues = $form->getValues(); // get user info (includes any filters)
	        	if($this->_validLogin($loginValues['email'], $loginValues['password'])) { // IF user is authenticated
	            	/*$usersMapper = new Application_Model_Mapper_Users_UsersMapper;
	            	$user = $usersMapper->findByUsername($this->_auth->getIdentity()->username);
	            	$user->lastLogin = date('Y-m-d H:i:s');
	            	$usersMapper->save($user);
	           		$this->addScript('top.location.reload()');*/
					// TODO update last login time
					$this->view->loggedInUser = $this->getLoggedInUser();
					$this->view->success = true; // login success
					if(!$this->isJsonContext()) { // IF NOT a JSON call
						$sessionNamespace = new Zend_Session_Namespace('DR'); // get the session namespace
						if($authRedirect = $sessionNamespace->authRedirect) { // IF a redirect was provided
							$this->redirect($authRedirect['action'], $authRedirect['controller'], $authRedirect['params']); // redirect
						}
					}
				}
				else $this->view->success = false; // login failure if user can't be authenticated
			}
			else $this->view->success = false; // login failure if form is not valid
       }
	}

	public function logoutAction() {
        $this->_logoutUser(); // erase user info from SESSION
        $this->redirect('index', 'index'); // back to home page
    }

    // an ajax function to change the logged in user's password
    public function changepasswordAction() {
		// TODO update changepassword Action
		// set up the usersMapper and
		// get the logged in user's info from the database
		$this->getLoggedInUser();
			
		$request = $this->getRequest();
		$form = new Application_Form_Authentication_ChangePassword();

		if($form->isValid($request->getPost())) { // IF form is valid
			// check the old password
				$adapter = self::_getAuthAdapter();
		        $adapter->setIdentity($this->user->username); // set username to check
		        $adapter->setCredential($form->getValue('oldPassword')); // set password to check
		        if(!$adapter->authenticate()->isValid()) { // IF wrong password
		        	$this->errorAndRedirect('Could not verify your old password, please try again', 'editbasicinfo', 'account');
		        }
			
            // save the user info
               	$this->user->setOptions($form->getValues());
                $this->usersMapper->save($this->user);      
            // display success message
                $this->msg('New password has been saved!');
                $this->redirect('editbasicinfo', 'account');       	
            }
		else $this->errorAndRedirect('Your submission was not valid', 'editbasicinfo', 'account'); // If form is NOT valid	
	}
	
	public function forgotPasswordAction() {
		// IF POST
			// IF form valid
				// IF create member password reset security key (process) successful
					// get security key from result
					// send email with security key
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (invalid form)
				// process failure
		// ELSE (not POST)
			// nothing
	}
	
	public function resetpasswordAction() {
		// IF GET
			// get security key from GET
			// pass security to view
		// ELSE IF POST
			// IF form valid
				// IF reset password (process) successful
					// get email from result
					// send confirmation email
					// pass success to view
				// ELSE (process failure)
					// process failure
			// ELSE (invalid form)
				// process failure
		// ELSE (not POST)
			// nothing
	}
    
    
    // ---------------------------------- HELPER METHODS ------------------------------------
    // logout the current user
	private function _logoutUser() {
		// TODO MARK: make sure this function also clears Controller Action $this->loggedInUser
    	Zend_Auth::getInstance()->clearIdentity(); // erase user info from the SESSION
		$this->redirect('index', 'index');
    }
    
    // Are login credentials valid?
    private function _validLogin($identity, $credentials) {
    	//$this->_logoutUser(); // clear current user info
    		
        $adapter = $this->_getAuthAdapter(); // Get our authentication adapter
        $adapter->setIdentity($identity); // set email to check
        $adapter->setCredential($credentials); // set password to check

        $result = Zend_Auth::getInstance()->authenticate($adapter); // authenticate the user info

		// TODO move storage to separate function in Controller Action Abstract (savedLoggedInUser())
        if ($result->isValid()) { // IF the user has been authenticated successfully
            Zend_Auth::getInstance()->getStorage()->write($adapter->getResultRowObject(array( // store info about the user in the SESSION
            	'member_ID',
            	'display_name',
            	'role',
            	'email',
            	'status',
            )));
            return true; // return successful authentication
        }
        return false; // return authentication failed
    }
    
    // Get the Zend_Auth_Adapter using the current database connection type (probably PDO_MYSQL)
    private function _getAuthAdapter() {
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter(); // get database adapter
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter); // create Auth Adaapter
        
        $authAdapter->setTableName('members') // set table name
        			->setIdentityColumn('email') // set identity column
        			->setCredentialColumn('password') // set password column
        			->setCredentialTreatment('SHA1(CONCAT(?,salt))'); // encrypt password
        
        return $authAdapter;
    }

}

