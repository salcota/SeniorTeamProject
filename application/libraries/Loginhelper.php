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
			
			// Temporary.
			$this->findUser($this->CI->session->loginhelper['sfsu_email']);
		}
	}
	
	// Checks whether user is logged in.
	public function isRegistered()
	{
		return $this->CI->session->has_userdata('loginhelper');
	}
	
	/*
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
	public function login($username = NULL, $email = NULL, $userID = NULL)
	{
		$loginData = array("username" => $username,
			"sfsu_email" => $email,
			"user_id" => $userID);
		
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
	
	// Temp function. To be replaced with Reg_User
	private function findUser($email)
	{
		$this->CI->db->where('sfsu_email', $email);
		$result = $this->CI->db->get('reg_user')->result();
		
		if (count($result) == 1)
		{
			$this->loginInfo = $result[0];
		}
	}
}

?>
