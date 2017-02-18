<?php

class About extends CI_Controller {
	public function view($member = "")
	{
		if (!file_exists(APPPATH.'views/' . $member . '.php'))
		{
			show_404();
		}
		else
		{
			$this->load->view($member);
		}
	}
}
?>