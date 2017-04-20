<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	public function __construct()
    	{
			parent::__construct();
			
			// Verify the user is logged in.
			if (!$this->loginhelper->isRegistered())
				show_404();
			
			$this->load->model("Notification_Model");
    	}

	public function index($page = "")
	{
		
		
	}
	
	public function showMessages()
	{
		
	}
	
	public function send()
	{
		
	}
}
?>
