<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function view($member = "")
	{
		// Gets basic header and styles for all pages.
                $this->load->view('common/sfsu_demo');
                $this->load->view('common/required_meta_tags');

                // Load No-Search navbar
				$this->navbars->loadNoSearch();

                // Loads page based on page value and includes search data if it's the home page. 
		if (!file_exists(APPPATH.'views/about/' . $member . '.php'))
		{
			show_404();
		}
		else
		{
			$this->load->view('about/' . $member);
		}

		// Gets basic footer and data that enables javascript, jQuery, and thether for all pages.
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');
	}
}
?>
