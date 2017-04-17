<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
{

	public function me()
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// NEED TO IMPLEMENT USER DATA
		$data = NULL;
		
		$this->load->view('profile/your_profile', $data);

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
