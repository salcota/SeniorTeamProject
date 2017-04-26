<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
	private $myInfo;
	
	public function __construct()
	{
		parent::__construct();
		
		// Verify the user is logged in.
		$this->loginhelper->forceLogin();
		
		$this->load->model("Notification_Model");
		
		$this->myInfo = $this->loginhelper->getLoginData();
	}

	public function index()
	{
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
					
		// Loads Navbar.
		$this->navbars->load();
		
		// Load Ajax messaging scripts
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('notifications/LiveMessage');
		
		$this->load->view('notifications/notifications');
		
		$this->load->view('common/footerbar');
	}
	
	public function getBuyers()
	{
		// Get list of buyers
		$buyers = $this->Notification_Model->getBuyers($this->myInfo->user_id);
		
		// Print list of buyers
		for ($i = 0; $i < count($buyers); $i++)
		{
			// Print relevant buyer info.
			echo $buyers[$i]->username . "\r\n" . $buyers[$i]->user_id;
			
			// Separate buyer usernames by double-newline.
			if ($i < count($buyers) - 1)
				echo "\r\n\r\n";
		}
	}
	
	public function getSellers()
	{
		// Get list of sellers
		$sellers = $this->Notification_Model->getSellers($this->myInfo->user_id);
		
		// Print list of sellers
		for ($i = 0; $i < count($sellers); $i++)
		{
			// Print relevant seller info.
			echo $sellers[$i]->username . "\r\n" . $sellers[$i]->user_id;
			
			// Separate buyer usernames by double-newline.
			if ($i < count($sellers) - 1)
				echo "\r\n\r\n";
		}
	}
	
    public function get_all_notifications(){}

    public function delete(){}

    public function send_notification(){}

    public function get_notification_by_buyerid(){}

}
?>
