<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function view($member = "")
	{
		$this->load->view('common/required_meta_tags');
		$this->load->view('common/sfsu_demo');

		// Load Navbar
		// Get user's search terms.
		$navSearch['searchTerms'] = htmlentities($this->input->get('search'));
		$navSearch['currentCategory'] = $this->input->get('category');
			
		// Retrieve all item categories.
		$this->load->model('Category');
		$navSearch['categories'] = $this->Category->getCategories();
			
		// Pass search terms and category listing to navbar.
		$this->load->view('common/navbar', $navSearch);

		if (!file_exists(APPPATH.'views/about/' . $member . '.php'))
		{
			show_404();
		}
		else
		{
			$this->load->view('about/' . $member);
		}

		$this->load->view('common/footerbar');
	}
}
?>
