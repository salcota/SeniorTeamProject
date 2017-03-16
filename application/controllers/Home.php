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
			$this->load->model('Item_Listing');
			$items['itemList'] = $this->Item_Listing->getAll();
			$this->load->view('home/home', $items);
		}
		else
		{
			$this->load->view('home/' . $page);
		}
	}
}
?>
