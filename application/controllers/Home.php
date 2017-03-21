<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function view($page = "")
	{
		// Get basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
		$this->load->view('common/css_styles');
		
		// Get user's search terms.
		$navSearch['searchTerms'] = $this->input->get('search');
		$navSearch['currentCategory'] = $this->input->get('category');
		
		// Retrieve all item categories.
		$this->load->model('Category');
		$navSearch['categories'] = $this->Category->getCategories();
		
		// Pass search terms and category listing to navbar.
		$this->load->view('common/navbar', $navSearch);

		if (!file_exists(APPPATH.'views/home/' . $page . '.php'))
		{
			show_404();
		}
		else if ($page == "home")
		{
			// Load itemlisting models to fetch data.
			$this->load->model('Item_Listing');
			
			// Retrieve search terms.
			$search = $this->input->get('search');
			// Search for matching items.
			$find = array();
			if (strlen($search) > 0)
			{
				$find['title'] = $search;
			}
			
			
			// Return only matching category
			$category = $this->input->get('category');
			if (strlen($category) > 0)
				$find['category'] = $category;
			
			
			$items['itemList'] = $this->Item_Listing->getItems($find);
			$this->load->view('home/home', $items);
		}
		else
		{
			$this->load->view('home/' . $page);
		}

		$this->load->view('common/footerbar');
	}
}
?>
