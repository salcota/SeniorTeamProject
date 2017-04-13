<?php

class loginhelper {

	protected $CI;
	
	private $loginInfo;

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
		
		$this->loginInfo = array("username" => NULL,
			"email" => NULL,
			"userID" => NULL);
		
		$this->loadSession();
		
		if ($this->isRegistered())
		{
			echo "Logged in";
			$this->logout();
			exit;
		}
	}

	// Loads User info from session variable to local variable.
	private function loadSession()
	{
		if ($this->CI->session->has_userdata('loginhelper'))
		{
			$loginData = $this->CI->session->loginhelper;
			
			// Replicate array values from session data to local variable.
			$keys = array_keys($this->loginInfo);
			foreach ($keys as $key)
			{
				if (array_key_exists($key, $loginData))
					$this->loginInfo[$key] = $loginData[$key];
			}
		}
	}
	
	// Checks whether user is logged in.
	public function isRegistered()
	{
		return $this->CI->session->has_userdata('loginhelper');
	}
	
	
	/*
	Sets this user as logged in.
	Future implementation will only require userID.
	
	Example:
	$this->loginhelper->login("prateek", "pgupta2@mail.sfsu.edu", 1);
	*/
	public function login($username = NULL, $email = NULL, $userID = NULL)
	{
		$loginData = array("username" => $username,
			"email" => $email,
			"userID" => $userID);
		
		$this->CI->session->loginhelper = $loginData;
		
		$this->loadSession();
	}
	
	// Sets user as logged out.
	public function logout()
	{
		// Destroy session data
		$this->CI->session->unset_userdata('loginhelper');
		
		$keys = array_keys($this->loginInfo);
		foreach ($keys as $key)
		{
			$this->loginInfo[$key] = NULL;
		}
	}
}

?>