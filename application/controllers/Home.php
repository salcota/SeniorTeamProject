<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function view($page = "")
	{
		$this->load->view('sfsu_demonstration');
		$this->load->view('required_meta_tags');
		$this->load->view('css_styles');
		$this->load->view('navbar');

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
			$category = $this->input->get('cat');
			if (strlen($category) > 0)
				$find['category'] = $category;
			
			
			$items['itemList'] = $this->Item_Listing->getItems($find);
			$this->load->view('home/home', $items);
		}
		else
		{
			$this->load->view('home/' . $page);
		}
	}
}
?>
