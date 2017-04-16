<?php

class loginhelper {

	protected $CI;
	
	// Stores copy of user db object
	private $loginInfo;
	
	// True only if user just finished logging in.
	private $freshLogin;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
		
		$this->loginInfo = NULL;
		$this->freshLogin = false;
		
		$this->loadSession();
		$this->notFresh();
	}

	// Builds User Info via Session Variables.
	private function loadSession()
	{
		if ($this->CI->session->has_userdata('loginhelper'))
		{
			$loginData = $this->CI->session->loginhelper;
			
			// Retrieve user info from database
			$this->CI->load->model('Reg_User');
			try
			{
				$info = $this->CI->Reg_User->findUser($loginData['userID']);
				if (isset($info))
					$this->loginInfo = $info;
			}
			catch (Exception $e)
			{
				return;
			}
			
			// Remember if this is a fresh login.
			$this->freshLogin = $loginData['freshLogin'];
		}
	}
	
	// Checks whether user is logged in.
	public function isRegistered()
	{
		if($this->loginInfo != NULL)
			return true;
		return false;
	}
	
	
	
	/*
	getLoginData()
	
	Returns array with data of current user login.
	Array keys: username, email, userID
	
	Example:
	$user = $this->loginhelper->getLoginData();
	echo $user['user_id'];
	echo $user['username'];
	echo $user['name'];
	echo $user['sfsu_email'];
	echo $user['mobile'];
	echo $user['biography'];
	echo $user['password']; // Hashed
	echo $user['major_id'];
	echo $user['registration_date'];
	echo $user['status'];
	*/
	public function getLoginData()
	{
		return $this->loginInfo;
	}
	
	// Returns true if user just logged in.
	public function isNewLogin()
	{
		return $this->freshLogin;
	}
	
	
	/*
	Sets this user as logged in.
	Future implementation will only require userID.
	
	Example:
	$this->loginhelper->login($userID);
	*/
	public function login($userID = NULL)
	{
		// Check if userID is numerical
		if (!is_numeric($userID))
			return;
		
		$loginData['userID'] = $userID;
		$loginData['freshLogin'] = true;
		
		$this->CI->session->loginhelper = $loginData;
		
		// Show welcome messages
		$this->CI->session->set_flashdata('login_success', 'Welcome Gator, you are now logged in.');
		
		$this->loadSession();
	}
	
	// Sets user as logged out.
	public function logout()
	{
		// Destroy session data
		$this->CI->session->unset_userdata('loginhelper');
		
		$this->loginInfo = NULL;
		$this->freshLogin = false;
	}
	
	// Marks a login as no longer fresh
	private function notFresh()
	{
		$loginData = $this->CI->session->loginhelper;
		
		if ($this->freshLogin)
		{
			// Next access is not a fresh login.
			$loginData['freshLogin'] = false;
		}
		
		// Set changed session data
		$this->CI->session->loginhelper = $loginData;
	}
}

?>
