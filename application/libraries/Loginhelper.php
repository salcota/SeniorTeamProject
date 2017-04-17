<?php

class loginhelper {

	protected $CI;
	
	// Copy of session variable
	private $loginData;
	
	
	// True only if user just finished logging in.
	private $freshLogin;
	
	// Constants
	const LoginURL = "Home/view/login";

	public function __construct()
	{
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->library('session');
		$this->CI->load->helper('url');
		
		$this->freshLogin = false;
		
		$this->init();
		
		$this->loadSession();
		$this->notFresh();
	}

	// Copies Session Variables.
	private function loadSession()
	{
		if ($this->CI->session->has_userdata('loginhelper'))
		{
			$this->loginData = $this->CI->session->loginhelper;
			
			// Remember if this is a fresh login.
			$this->freshLogin = $this->loginData['freshLogin'];
		}
	}
	
	private function saveSession()
	{
		$this->CI->session->loginhelper = $this->loginData;
	}
	
	private function init()
	{
		// Create dummy array. Needed in case function calls saveSession() without filling all values.
		$this->loginData['userID'] = NULL;
		$this->loginData['freshLogin'] = false;
		$this->loginData['urlBeforeLogin'] = NULL;
		$this->loginData['loginPages'] = array();
	}
	
	
	// Checks true if user is logged in.
	public function isRegistered()
	{
		if($this->loginData['userID'] != NULL)
			return true;
		return false;
	}
	
	
	
	/*
	getLoginData()
	
	Returns db-object with data of current user login.
	
	Example:
	$user = $this->loginhelper->getLoginData();
	echo $user->user_id;
	echo $user->username;
	echo $user->name;
	echo $user->sfsu_email;
	echo $user->mobile;
	echo $user->biography;
	echo $user->password; // Hashed
	echo $user->major_id;
	echo $user->registration_date;
	echo $user->status;
	*/
	public function getLoginData()
	{
		// Retrieve user info from database
		$this->CI->load->model('Reg_User');
		try
		{
			$info = $this->CI->Reg_User->findUser($this->loginData['userID']);
			if (isset($info))
				return $info;
		}
		catch (Exception $e)
		{
			return;
		}
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
		
		$this->loginData['userID'] = $userID;
		$this->loginData['freshLogin'] = true;
		
		$this->saveSession();
		
		// Show welcome messages
		$this->CI->session->set_flashdata('login_success', 'Welcome Gator, you are now logged in.');
	}
	
	// Sets user as logged out.
	public function logout()
	{
		// Destroy session data
		$this->CI->session->unset_userdata('loginhelper');
		
		$this->init();
	}
	
	/*
	Redirects the user to the login page or a specified destination if the current user is not logged in.
	
	Example:
	$this->loginhelper->forceLogin(); // Redirects to login page.
	
	$this->loginhelper->forceLogin('Home'); // Redirects to home page.
	*/
	public function forceLogin($destination = NULL)
	{
		if ($this->isRegistered())
			return;
		
		if ($destination == NULL)
			$destination = self::LoginURL;
		
		try
		{
			redirect($destination);
		}
		catch (Exception $e)
		{
			throw new Exception('$this->loginhelper->forceLogin('. $destination . ') failed.');
		}
	}
	
	/*
	Returns the URL the user was at before logging in.
	Requires implementation of rememberBeforeLogin()
	
	Example:
	$url = $this->loginhelper->beforeLogin();
	*/
	public function beforeLogin()
	{
		return $this->loginData['urlBeforeLogin'];
	}
	
	/*
	Records what page the user was looking at before logging in.
	Call this function on every login page.
	*/
	public function rememberBeforeLogin()
	{
		$this->CI->load->library('user_agent');
		
		// Only record if the page belongs to our website.
		if (!$this->CI->agent->is_referral())
			return;
		
		$url = $this->agent->referrer();
		
		$isLogin = false;
		$logins = $this->loginData['loginPages'];
		// Loop through login pages. If url matches a login page, don't record it.
		for ($i = 0; $i <= count($logins); $i++)
		{
			// This page is not recorded in list of login pages. Add it.
			if ($i == count($logins))
			{
				array_push($logins, $strtolower('/' . uri_string()));
				$this->loginData['loginPages'] = $logins;
			}
			
			if (strtolower(parse_url($url)) == $logins[$i])
			{
				$isLogin = true;
				break;
			}
		}
		
		// If the url is not a login page, record it.
		if (!isLogin)
			$this->loginData['urlBeforeLogin'] = $url;
		
		// Save session data
		saveSession();
	}
	
	
	// Marks a login as no longer fresh
	private function notFresh()
	{
		if ($this->freshLogin)
		{
			// Next access is not a fresh login.
			$this->loginData['freshLogin'] = false;
		}
		
		// Set changed session data
		$this->saveSession();
	}
}

?>
