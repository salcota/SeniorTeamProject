<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Model extends CI_Model
{

    	public function __construct()
    	{
			parent::__construct();
			$this->load->database();
			$this->load->model('Item_Listing');
    	}

    	public function getAllNotifications($buyer, $seller)
		{
			// Turn off debugging
			$debug = $this->db->db_debug;
			$this->db->db_debug = false;
			
			try
			{
				$this->db->join("item_listing", "item_listing.listing_id = reg_user_notification.listing_id");
				$this->db->join("reg_user", "reg_user.user_id = item_listing.seller_id");
				$data = $this->db->select("reg_user_notification.notification_id, reg_user_notification.sender_id, reg_user_notification.receiver_id, reg_user_notification.listing_id, reg_user_notification.message, reg_user_notification.status, reg_user.user_id, reg_user.username")->
					group_start()->
						group_start()->
							where("sender_id", $buyer)->
							where("receiver_id", $seller)->
						group_end()->
						or_group_start()->
							where("sender_id", $seller)->
							where("receiver_id", $buyer)->
						group_end()->
					group_end()->
					group_start()->
						where("reg_user.user_id", $seller)->
					group_end()->
				get("reg_user_notification")->result();
			}
			catch (Exception $e)
			{
				// Restore debug defaults
				$this->db->db_debug = $debug;
				throw new Exception("Error fetching Notifications");
			}
			
			// Restore debug defaults
			$this->db->db_debug = $debug;
			
			return $data;
		}

    	public function storeNotification($sender, $recv, $listing, $msg)
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
				throw new Exception("Cannot add message");
			}
		}
		
		private function list2user($listing)
		{
			if (!is_numeric($listing))
				throw new Exception("Listing ID is not numerical.");
				
			// Retrieve the listing
			$search['listingID'] = $listing;
			$data = $this->Item_Listing->getItems($search);
			
			// Check if the listing exists
			if (count($data) < 1)
				throw new Exception("Item Listing does not exist.");
			else
				$data = $data[0];
			
			return $data->username;
		}
}
?>
