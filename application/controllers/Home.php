<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	// These variables affect how item listings are displayed.
	const PAGEMAXITEMS = 12; // How many items per page.
	const PAGEMAXPAGES = 6; // How many total Next/Previous pages to show.

	public function view($page = "")
	{
		// Get basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
		
		// Load Navbar
			// Get user's search terms.
			$navSearch['searchTerms'] = htmlentities($this->input->get('search'));
			$navSearch['currentCategory'] = $this->input->get('category');
			
			// Retrieve all item categories.
			$this->load->model('Category');
			$navSearch['categories'] = $this->Category->getCategories();
			
			// Pass search terms and category listing to navbar.
			$this->load->view('common/navbar', $navSearch);
		

		if ( (!file_exists(APPPATH.'views/home/' . $page . '.php')) && (!file_exists(APPPATH.'views/auth/' . $page . '.php')) )
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
			
			// Count number of matching items in the entire database.
			$maxItems = $this->Item_Listing->countItems($find);
			// Calculte maximum number of possible pages.
			$maxPages = ceil($maxItems/$this::PAGEMAXITEMS);
			
			// Restrict number of shown results.
			$find['maxResults'] = $this::PAGEMAXITEMS;
			
			// Skip first N results
			$pageSkip = $this->input->get('page');
			if (is_numeric($pageSkip) && $pageSkip >= 1)
				$find['skipResults'] = ($pageSkip - 1)*$this::PAGEMAXITEMS;
			else
				$pageSkip = 1;
			
			// Create Previous/Next page buttons
				// Place page lower bound and upper bound relative to current page.
				$lowerPage = $pageSkip - floor($this::PAGEMAXPAGES/2);
				$upperPage = $pageSkip + ceil($this::PAGEMAXPAGES/2);
				
				// If lowest page is out of bounds, shift the page-range upwards.
				if ($lowerPage < 1)
				{
					$offset = 1 - $lowerPage;
					$lowerPage += $offset;
					$upperPage += $offset;
				}
				// If highest page is out of bounds, shift the page-range downwards and trim lower bound if it goes below 1.
				if ($upperPage > $maxPages)
				{
					$offset = $upperPage - $maxPages;
					$upperPage -= $offset;
					$lowerPage -= $offset;
				}
				if ($lowerPage < 1)
					$lowerPage = 1;
				
				// Send current page and previous/next page bounds to home view.
				$items['currentPage'] = $pageSkip;
				$items['lowestPage'] = $lowerPage;
				$items['highestPage'] = $upperPage;
				$items['maxItems'] = $maxItems;
				
				// Send all GET data
				$items['get'] = $this->input->get();
			
			$items['itemList'] = $this->Item_Listing->getItems($find);
			$this->load->view('home/home', $items);
		}
		else if ($page == "login")
		{
			$this->load->view('auth/login');
		}


		$this->load->view('common/footerbar');
	}
}
?>
