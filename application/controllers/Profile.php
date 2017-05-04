<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{

	function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->library('loginhelper');
	$this->load->model('Updateprofile');
	$this->load->model('imageloader');
	$this->load->model('Major');
	}

	public function me()
	{

		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/resources');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// Returns necessary data for the view file (profile.php) to use
		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;
		$usermajor = $user->major_id;
		$profilePic = $this->imageloader->showUserPic($id);
		$pic = base_url().$profilePic;
		$data = array(
			'username' =>$user->username,
			'email' => $user->sfsu_email,
			'biography'=> $user->biography,
			'id' => $user->user_id,
			'pic' => $pic,
			'majors' => $this->Major->getMajors(),
			'usermajor' => $usermajor,
		);

		$this->load->view('profile/your_profile', $data);

		// Gets basic footer
		$this->load->view('common/footerbar');
	}

	public function user($id = NULL)
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/resources');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// NEED TO IMPLEMENT USER DATA
		$data = NULL;

		$this->load->view('profile/users_profile', $data);

		// Gets basic footer
		$this->load->view('common/footerbar');
	}
}
?>
