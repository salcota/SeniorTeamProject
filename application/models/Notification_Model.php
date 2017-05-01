<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification_Model extends CI_Model
{

    	public function __construct()
    	{
			parent::__construct();
			$this->load->database();
			$this->load->model('Item_Listing');
			$this->load->dbforge();
    	}

    	public function getNotifications($buyer, $seller, $start, $count = NULL)
		{
			if (!is_numeric($start))
				return;
			
			// Turn off debugging
			$debug = $this->db->db_debug;
			$this->db->db_debug = false;
			
			if (is_numeric($count))
				$this->db->limit($count, $start);
			else
				$this->db->limit(PHP_INT_MAX, $start);
			
			try
			{
				$data = $this->sqlNotification($buyer, $seller);
			}
			catch (Exception $e)
			{
				// Restore debug defaults
				$this->db->db_debug = $debug;
				throw new Exception("Error fetching Notifications");
			}
			
			// Restore debug defaults
			$this->db->db_debug = $debug;
			
			return $data->get("reg_user_notification")->result();
		}
		
		public function countNotifications($buyer, $seller)
		{
			// Turn off debugging
			$debug = $this->db->db_debug;
			$this->db->db_debug = false;
			
			try
			{
				$data = $this->sqlNotification($buyer, $seller);
			}
			catch (Exception $e)
			{
				// Restore debug defaults
				$this->db->db_debug = $debug;
				throw new Exception("Error fetching Notifications");
			}
			
			// Restore debug defaults
			$this->db->db_debug = $debug;
			
			return $data->count_all_results("reg_user_notification");
		}
		
		private function sqlNotification($buyer, $seller)
		{
			$this->db->join("item_listing", "item_listing.listing_id = reg_user_notification.listing_id");
			$this->db->join("reg_user", "reg_user.user_id = item_listing.seller_id");
			return $this->db->select("reg_user_notification.notification_id, reg_user_notification.sender_id, reg_user_notification.receiver_id, reg_user_notification.listing_id, reg_user_notification.message, reg_user_notification.status, reg_user.user_id, reg_user.username")->
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
				group_end();
		}

    	public function storeNotification($sender, $recv, $listing, $msg)
		{
			// Turn off debugging
			$debug = $this->db->db_debug;
			$this->db->db_debug = false;
			
			// Verify Sender and Receiver are different
			if ($sender == $recv)
				throw new Exception("Sender and Receiver are identical");
			
			// Verify the sender or receiver is the listing owner.
			$owner['listingID'] = $listing;
			$owner = $this->Item_Listing->getItems($owner);
			
			if (count($owner) < 1)
			{
				$this->db->db_debug = $debug;
				return false;
			}
			
			$owner = $owner[0]->user_id;
			if ($owner != $sender && $owner != $recv)
			{
				$this->db->db_debug = $debug;
				return false;
			}
			
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
		
		public function getBuyers($sellerID)
		{
			if (!is_Numeric($sellerID))
				return;
			
			$this->db->select('from.user_id, from.username');
			$this->db->from('reg_user_notification seller');
			$this->db->join('item_listing listing', 'seller.listing_id = listing.listing_id AND listing.seller_id = seller.receiver_id');
			$this->db->join('reg_user from', 'from.user_id = seller.sender_id');
			$this->db->distinct();
			$this->db->where("seller.receiver_id", $sellerID);
			
			$result = $this->db->get()->result();
			return $result;
		}
		
		public function getSellers($buyerID)
		{
			if (!is_Numeric($buyerID))
				return;
			
			$this->db->select('sell.user_id, sell.username');
			$this->db->from('reg_user_notification note');
			$this->db->join('item_listing as listing', 'note.listing_id = listing.listing_id');
			$this->db->join('reg_user sell', 'listing.seller_id = sell.user_id AND sell.user_id != note.sender_id');
			$this->db->distinct();
			$this->db->where("note.sender_id", $buyerID);
			
			$result = $this->db->get()->result();
			return $result;
		}
}
?>
