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
		$data = $this->Notification_Model->getBuyers(1);
		print_r ($data);
	}
	
    public function get_all_notifications(){}

    public function delete(){}

    public function send_notification(){}

    public function get_notification_by_buyerid(){}

}
?>
