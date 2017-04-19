<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Model extends CI_Model
{

    	public function __construct()
    	{
			$this->load->database();
    	}

    	public function getAllNotifications($sender, $recv)
		{
			$result = $this->db->select("*")->from("reg_user_notification")->
			group_start()->
				where("sender_id", $sender)->
				where("receiver_id", $recv)->
			group_end()->
			or_group_start()->
				where("sender_id", $recv)->
				where("receiver_id", $sender)->
			group_end()->
			get();
			$result = $result->result();
			return $result;
		}

    	public function storeNotification($sender, $recv, $msg, $listing)
		{
			// Turn off debugging
			$debug = $this->db->db_debug;
			$this->db->db_debug = false;
			
			// Create array with item details.
			$dbItem = array('sender_id' => $sender, 'receiver_id' => $recv, 'listing_id' => $listing, 'message' => $msg);
			
			// Add item to database.
			if ($this->db->insert('reg_user_notification', $dbItem))
			{
				$this->db->db_debug = $debug;
				return true;
			}
			else
			{
				$this->db->db_debug = $debug;
				throw new Exception("Cannot add user");
				// More specific errors to be implemented later.
			}
		}
}
?>
