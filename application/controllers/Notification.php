<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		// Verify the user is logged in.
		if (!$this->loginhelper->isRegistered())
			//show_404();
		
		$this->load->model("Notification_Model");
	}

	public function index()
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
					
		// Loads Navbar.
		$this->navbars->load();
		
		$this->load->view('notifications/notifications');
		
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('common/footerbar');
	}
	
    public function get_all_notifications(){}

    public function delete(){}

    public function send_notification(){}

    public function get_notification_by_buyerid(){}

}
?>
