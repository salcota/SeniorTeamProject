<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller 
{

	public function view($member = "")
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/resources');

		// Loads No-Search Navbar.
		$this->navbars->load();

		// Loads page based on page value and includes search data if it's the home page. 
		if (!file_exists(APPPATH.'views/about/' . $member . '.php'))
		{
			show_404();
		}
		else
		{
			$this->load->view('about/' . $member);
		}

		// Gets basic footer
		$this->load->view('common/footerbar');
	}
}
?>
