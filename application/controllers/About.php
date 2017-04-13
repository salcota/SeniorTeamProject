<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function view($member = "")
	{
		// Gets basic header and styles for all pages.
                $this->load->view('common/sfsu_demo');
                $this->load->view('common/required_meta_tags');

                // Gets user's search terms.
                $navSearch['searchTerms'] = htmlentities($this->input->get('search'));
                $navSearch['currentCategory'] = $this->input->get('category');

                // Retrieves all item categories.
                $this->load->model('Category');
                $navSearch['categories'] = $this->Category->getCategories();

		// Determines navbar based or registered/nonregistered and if on home/nonhomepage then passes search terms and category listing to navbar.
                $registered = true;
                $onHome = false;
                if ($registered && $onHome)
                        $this->load->view('common/registered_navbar', $navSearch);
                else if($registered && !$onHome)
                        $this->load->view('common/registered_navbar_nosearch', $navSearch);
                else if(!$registered && $onHome)
                        $this->load->view('common/navbar', $navSearch);
                else
                        $this->load->view('common/navbar_nosearch', $navSearch);

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
