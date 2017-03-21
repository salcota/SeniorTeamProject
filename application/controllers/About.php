<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function view($member = "")
	{
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/css_styles');

		if (!file_exists(APPPATH.'views/about/' . $member . '.php'))
		{
			show_404();
		}
		else
		{
			$this->load->view('about/' . $member);
		}
	}
}
?>
