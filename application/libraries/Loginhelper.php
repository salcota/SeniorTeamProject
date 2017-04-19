<?php

class loginhelper {

	protected $CI;
	
	// Copy of session variable
	private $loginData;
	
	
	// True only if user just finished logging in.
	private $freshLogin;
	
	// Constants
	const LoginURL = "Home/view/login";
	const ignoreHist = array("home/view/login", "home/view/signup", "users/login", "signup/login");

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
			if ($info == NULL)
				throw new Exception();
			if (isset($info))
				return $info;
		}
		catch (Exception $e)
		{
			$id = $this->loginData['userID'];
			if (!is_numeric($id))
				$id = "";
			throw new Exception('<br>$this->loginhelper->getLoginData() failed.<br>' . "
			UserID: $id<br>
			Did you check whether we are logged in?");
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
		$this->loginData['urlBeforePage'] = NULL;
		
		// Mark loggedIn session variable used by views.
		$this->CI->session->loggedIn = true;
		
		$this->saveSession();
		
		// Show welcome messages
		$this->CI->session->set_flashdata('login_success', 'Welcome Gator, you are now logged in.');
	}
	
	// Sets user as logged out.
	public function logout()
	{
		// Remove loggedIn session variable used by views
		$this->CI->session->unset_userdata('loggedIn');
		
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
		// We do not need to remember page history if we are already logged in.
		if ($this->isRegistered())
			return;
			
		$this->CI->load->library('user_agent');
		
		// If foreign website, exit.
		if ($this->CI->agent->is_referral())
			return;
		
		// Get URI of referrer URL
		$url = $this->CI->agent->referrer();
		$parse = strtolower(parse_url($url)['path']);
		$parse = explode('/', $parse);
		$parse = array_splice($parse, 2);
		$parse = implode('/', $parse);
		
		
		$isLogin = false;
		$logins = self::ignoreHist;
		$max = count($logins);
		$recorded = false;
		// Loop through login pages. If url matches a login page, don't record it.
		for ($i = 0; $i < $max; $i++)
		{
			// If the referrer is a login page, we won't record it.
			if ($parse == $logins[$i])
				$isLogin = true;
		}
		
		// If the url is not a login page, record it.
		if (!$isLogin)
		{
			$this->loginData['urlBeforeLogin'] = $url;
			$this->saveSession();
		}
		
		
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
