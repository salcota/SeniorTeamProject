﻿<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
	private $myInfo;
	
	// String used to split ajax data.
	const splitDetails = "\r\n";
	const splitData = "\r\n\r\n";
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model("Notification_Model");
		
		if ($this->loginhelper->isRegistered())
			$this->myInfo = $this->loginhelper->getLoginData();
	}

	public function index()
	{
		// Verify the user is logged in.
		$this->loginhelper->forceLogin();
		
		// Gets basic header and styles for all pages.
		$this->load->view('common/sfsu_demo');
		$this->load->view('common/required_meta_tags');
					
		// Loads Navbar.
		$this->navbars->load();
		
		// Load Ajax messaging scripts
		$this->load->view('common/jquery_tether_bootstrap');
		$this->load->view('notifications/LiveMessage');
		
		// Load Notifications page.
		$user = $this->loginhelper->getLoginData();
		$data['userID'] = $user->user_id;
		$data['username'] = $user->username;
		$this->load->view('notifications/notifications', $data);
		
		$this->load->view('common/footerbar');
	}
	
	public function getBuyers()
	{
		$this->hide();
		
		// Get list of buyers
		$buyers = $this->Notification_Model->getBuyers($this->myInfo->user_id);
		
		// Print list of buyers
		for ($i = 0; $i < count($buyers); $i++)
		{
			// Print relevant buyer info.
			echo htmlentities($buyers[$i]->username) . self::splitDetails . $buyers[$i]->user_id;
			
			// Separate buyer usernames by double-newline.
			if ($i < count($buyers) - 1)
				echo self::splitData;
		}
	}
	
	public function getSellers()
	{
		$this->hide();
		
		// Get list of sellers
		$sellers = $this->Notification_Model->getSellers($this->myInfo->user_id);
		
		// Print list of sellers
		for ($i = 0; $i < count($sellers); $i++)
		{
			// Print relevant seller info.
			echo htmlentities($sellers[$i]->username) . self::splitDetails . $sellers[$i]->user_id;
			
			// Separate buyer usernames by double-newline.
			if ($i < count($sellers) - 1)
				echo self::splitData;
		}
	}
	
    public function get_all_notifications($partnerID, $partnerIsSeller)
	{
		$this->hide();
		
		// Determine who is buyer/seller
		$buyer = $partnerID;
		$seller = $partnerID;
		if ($partnerIsSeller)
			$buyer = $this->myInfo->user_id;
		else
			$seller = $this->myInfo->user_id;
		
		// Retrieve messages
		$data = $this->Notification_Model->getNotifications($buyer, $seller, 0);
		
		// Print all messages.
		// This will be changed later to print specific messages.
		for($i = 0; $i < count($data); $i++)
		{
			echo $data[$i]->sender_id . self::splitDetails . $data[$i]->message . self::splitDetails . $data[$i]->listing_id;
			
			if ($i < count($data) - 1)
				echo self::splitData;
		}
	}

    //public function delete(){}

    public function send_notification()
	{
		$this->hide();
		
		$listing = $this->input->post('item');
		$recvID = $this->input->post('receiver');
		$message = base64_encode($this->input->post('msg'));
		
		if (!is_numeric($listing) || $listing < 0)
			return;
		
		if (!is_numeric($recvID))
			return;
		
		if (strlen($message) == 0)
			return;
		
		$sendID = $this->myInfo->user_id;
		
		try
		{
			$this->Notification_Model->storeNotification($sendID, $recvID, $listing, $message);
		}
		catch (Exception $e) {}
	}
	
	private function hide()
	{
		if (!$this->loginhelper->isRegistered())
			show_404();
	}
	
	public function test()
	{
		$text = "Cómo estás";
		$text = "プライバシー";
		$enc = base64_encode($text);
		echo "$text<br>";
		echo base64_encode($text) . "<br>";
		//echo base64_decode(base64_encode($text)) . "<br>";
		echo <<<END
		<script>
		function b64DecodeUnicode(str) {
			return decodeURIComponent(atob(str).split('').map(function(c) {
				return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
			}).join(''));
		}
		
		document.write(b64DecodeUnicode("$enc"));
		</script>
END;
	}

}
?>
