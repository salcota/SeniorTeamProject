<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {
	public function view($member = "")
	{
		echo "<p style='text-align:center; font-style:italic; margin-bottom:25px'>SFSU Software Engineering Project, Spring 2017.  For Demonstration Only<p>";

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
