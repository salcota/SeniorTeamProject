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
		
		// Check if given ID is numeric.
		if (!is_Numeric($id))
			show_404();

		// Load data about user.
		$this->load->model('Reg_User');
		$userData = $this->Reg_User->findUser($id);
		
		// If user exists, send this data to view.
		if (!$userData)
			show_404();
		$data = array(
			'username' =>$userData->username,
			'name'     =>$userData->name,
			'email' => $userData->sfsu_email,
			'biography'=> $userData->biography,
			'id' => $userData->user_id,
			'pic' => base_url() . "Images/userPic/" . $userData->user_id,
			'majors' => $this->Major->getMajors(),
			'usermajor' => $userData->major_id,
			'registrationDate' => $userData->registration_date
		);

		$this->load->view('profile/users_profile', $data);

		// Gets basic footer
		$this->load->view('common/footerbar');
	}
}
?>
