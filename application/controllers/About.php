<?php

class About extends CI_Controller {
	public function view($member = "")
	{
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