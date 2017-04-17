<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{

	function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->library('loginhelper');
	$this->load->model('Updateprofile');
	}

	public function me()
	{

		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// Returns necessary data for the view file (profile.php) to use
		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;

		$data = array(
			'username' =>$user->username,
			'email' => $user->sfsu_email,
			'biography'=> $user->biography

		);

		$this->load->view('profile/profile', $data);

		// Gets basic footer and data that enables javascript, jQuery, and thether for all pages.
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');
	}

	public function user($id = NULL)
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// NEED TO IMPLEMENT USER DATA
		$data = NULL;

		$this->load->view('profile/users_profile', $data);

		// Gets basic footer and data that enables javascript, jQuery, and thether for all pages.
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');
	}
}
?>
