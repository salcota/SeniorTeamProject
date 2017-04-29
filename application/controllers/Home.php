<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	// These variables affect how item listings are displayed.
	const PAGEMAXITEMS = 8; // How many items per page.
	const PAGEMAXPAGES = 4; // How many total Next/Previous pages to show.
	
	public function index()
	{
		$this->view("home");
	}

	public function view($page = "")
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
					
		// Loads Navbar.
		$this->navbars->load();

		// Loads page based on page value and includes search data if it's the home page.
		if (!file_exists(APPPATH.'views/home/' . $page . '.php')) 
		{
			show_404();
		}
		else if ($page == "home")
		{
			// Loads itemlisting models to fetch data.
			$this->load->model('Item_Listing');
			
			// Retrieves search terms.
			$search = $this->input->get('search');
			// Searches for matching items.
			$find = array();
			$data = array(
				'bad_search' => ''
				);

			$this->session->set_flashdata($data); 
			print_r($search);
			if (strlen($search) > 0)
			{
				$input["search"] = $search;
				$this->form_validation->set_data($input);

				//$find['title'] = $search;
				$this->form_validation->set_rules('search', 'Search', 'trim|required|alpha');

				if($this->form_validation->run() == FALSE)
				{	
					$data = array(
						'bad_search' => validation_errors()
					);
 
					$this->session->set_flashdata($data);

				} else {
					//redirect('home/view/', $page);
					$find['title'] = $search;
        			}
			}

			//Sorts items based on option value.
			$sort = $this->input->get('sort');

			if(strlen($sort) > 0){
				$find['sort'] = $sort;
			}
			
			// Returns only matching category.
			$category = $this->input->get('category');
			if (strlen($category) > 0)
				$find['category'] = $category;
			
			// Counts number of matching items in the entire database.
			$maxItems = $this->Item_Listing->countItems($find);

			// Calculates maximum number of possible pages.
			$maxPages = ceil($maxItems/$this::PAGEMAXITEMS);
			
			// Restricts number of shown results.
			$find['maxResults'] = $this::PAGEMAXITEMS;
			
			// Skips first N results.
			$pageSkip = $this->input->get('page');
			if (is_numeric($pageSkip) && $pageSkip >= 1)
				$find['skipResults'] = ($pageSkip - 1)*$this::PAGEMAXITEMS;
			else
				$pageSkip = 1;
			
			// Creates Previous/Next page buttons.
			// Places page lower bound and upper bound relative to current page.
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
				
			// Sends current page and previous/next page bounds to home view.
			$items['currentPage'] = $pageSkip;
			$items['lowestPage'] = $lowerPage;
			$items['highestPage'] = $upperPage;
			$items['maxItems'] = $maxItems;
				
			// Sends all GET data.
			$items['get'] = $this->input->get();			
			$items['itemList'] = $this->Item_Listing->getItems($find);
			$this->load->view('home/home', $items);
		}
		else
		{
			$this->load->view('home/' . $page);
		}
		
		if (strtolower($page) == "login" || strtolower($page) == "signup")
			$this->loginhelper->rememberBeforeLogin(); // Keep track of what the user was looking at before.

                // Gets basic footer and data that enables javascript, jQuery, and thether for all pages.	
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');
	}
}
?>
