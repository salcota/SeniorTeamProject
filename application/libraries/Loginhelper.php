<?php

class loginhelper {

	protected $CI;
	
	private $loginInfo;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
		
		$this->loginInfo = NULL;
		
		$this->loadSession();
	}

	// Loads User info from database via lookup by userID.
	private function loadSession()
	{
		if ($this->CI->session->has_userdata('loginhelper'))
		{
			$loginData = $this->CI->session->loginhelper;
			
			// Retrieve user info from database
			$this->CI->load->model('Reg_User');
			try
			{
				$info = $this->CI->Reg_User->findUser($loginData);
				if (isset($info))
					$this->loginInfo = $info;
			}
			catch (Exception $e)
			{
			
			}
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
	
	
	/*
	Sets this user as logged in.
	Future implementation will only require userID.
	
	Example:
	$this->loginhelper->login("prateek", "pgupta2@mail.sfsu.edu", 1);
	*/
	public function login($userID = NULL)
	{
		$loginData = $userID;
		
		// Check if userID is numerical
		if (!is_numeric($loginData))
			return;
		
		$this->CI->session->loginhelper = $loginData;
		
		$this->loadSession();
	}
	
	// Sets user as logged out.
	public function logout()
	{
		// Destroy session data
		$this->CI->session->unset_userdata('loginhelper');
		
		$this->loginInfo = NULL;
	}
}

?>
