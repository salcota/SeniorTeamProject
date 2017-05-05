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

	/*
	Returns Notifications between a buyer and seller starting at a specified number of messages.
	Optional parameter to specify a limit on how many messages are returned.
	
	Example: Getting messages between buyer with ID 2, seller with ID 1, starting at the 35th message, and returning up to 7 messages.
	$data = $this->Notification_Model->getNotifications(2, 1, 35, 7);
	*/
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
		
		$data = $data->get("reg_user_notification")->result();
		foreach($data as $message)
		{
			$message->message = base64_decode($message->message);
		}
		
		return $data;
	}
	
	// Counts the number of notifications between a buyer and a seller.
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
	
	/* Private function for internal use.
	Applies filters for fetching only messages between a specified buyer and seller.
	NOTE: If you switch the buyer/seller, it is considered a different message thread. Be careful who you specify as the buyer or seller.
	*/
	private function sqlNotification($buyer, $seller)
	{
		$this->db->join("item_listing", "item_listing.listing_id = reg_user_notification.listing_id");
		$this->db->join("reg_user", "reg_user.user_id = item_listing.seller_id");
		$this->db->order_by('reg_user_notification.timestamp ASC');
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

	// Adds a notification based on sender, receiver, itemlisting ID, and message content.
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
		$dbItem = array('sender_id' => $sender, 'receiver_id' => $recv, 'listing_id' => $listing, 'message' => base64_encode($msg));
		
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
	
	// Returns a list of Buyers interested in an item from a given seller.
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
	
	// Returns a list of sellers that have been contacted by a given buyer.
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
	
	
	/*
	Counts the number of unread messages a user has.
	Can optionally specify a buyer/seller to fetch messages from a specific thread.
	*/
	public function countUnread($recvID, $buyer = NULL, $seller = NULL)
	{
		if (!is_Numeric($recvID))
			return;
		
		// Only fetch messages from a specific thread.
		if (is_Numeric($buyer) && is_Numeric($seller))
			$this->sqlNotification($buyer, $seller);
		
		$this->db->where('receiver_id', $recvID);
		$this->db->where('reg_user_notification.status', 'U');
		$this->db->order_by('reg_user_notification.timestamp ASC');
		
		return count($this->db->get('reg_user_notification')->result());
	}
	
	
	/*
	Marks all messages as read.
	Can optionally specify a buyer/seller to fetch messages from a specific thread.
	*/
	public function markRead($recvID, $buyer = NULL, $seller = NULL)
	{
		if (!is_Numeric($recvID))
			return;
		
		$this->db->where('receiver_id', $recvID);
		$this->db->where('reg_user_notification.status', 'U');
		
		$data['status'] = "R";
		
		// Only fetch messages from a specific thread.
		if (is_Numeric($buyer) && is_Numeric($seller))
		{
			$this->db->join("item_listing", "item_listing.listing_id = reg_user_notification.listing_id");
			$this->db->where('item_listing.seller_id', $seller);
			$this->db->update('reg_user_notification JOIN item_listing ON (item_listing.listing_id = reg_user_notification.listing_id)', $data);
		}
		else // Mark all messages from every thread.
			$this->db->update('reg_user_notification', $data);
	}
	
	// Gives all messages owned by a given itemlisting to another listing.
	// Use this when deleting itemlistings.
	public function orphanNotifications($itemID)
	{
		// Get list of all buyers messaging about this item.
		$this->db->select('reg_user_notification.sender_id');
		$this->db->join('item_listing', 'item_listing.listing_id = reg_user_notification.listing_id');
		$this->db->where('reg_user_notification.listing_id', $itemID);
		$this->db->where('reg_user_notification.sender_id != item_listing.seller_id');
		$this->db->distinct();
		$buyers = $this->db->get('reg_user_notification')->result();
		
		//Loop through each buyer to find a new itemlisting parent.
		foreach($buyers as $thread)
		{
			// Fetch the latest itemlisting as the new parent.
			$this->db->select('listing_id')->from('reg_user_notification')->
				group_start()->
					where('sender_id', $thread->sender_id)->
					or_where('receiver_id', $thread->sender_id)->
				group_end()->
				where('listing_id !=', $itemID);
			$this->db->distinct();
			
			$parents = $this->db->get()->result();
			$parent = -1;
			if (count($parents) > 0)
				$parent = $parents[count($parents) - 1]->listing_id;
			
			// Assign orhpaned messages to new parent.
			if ($parent >= 0)
			{
				$editor['listing_id'] = $parent;
				
				$this->db->select('listing_id')->from('reg_user_notification')->
				group_start()->
					where('sender_id', $thread->sender_id)->
					or_where('receiver_id', $thread->sender_id)->
				group_end()->
				where('listing_id', $itemID);
				
				$this->db->update('reg_user_notification', $editor);
			}
		}
		
		// Delete messages (just in case).
		$this->db->where('listing_id', $itemID);
		$this->db->delete('reg_user_notification');
	}
}
?>
