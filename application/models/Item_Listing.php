<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_Listing extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		
		// Load CodeIgniter's table-editor
		$this->load->dbforge();
	}
	
	// addItem() adds an item listing to database.
	// Throws error if operation fails.
	public function addItem($title, $seller, $price, $description, $category)
	{
		$debug = $this->db->db_debug;
		$this->db->db_debug = false;
		
		// Create array with item details.
		$dbItem = array('category_id' => $category, 'price' => $price, 'seller_id' => $seller, 'title' => $title, 'description' => $description);
		
		// Add item to database.
		if ($this->db->insert('item_listing', $dbItem))
		{
			$this->db->db_debug = $debug;
			return;
		}
		else
		{
			$this->db->db_debug = $debug;
			throw new Exception("Cannot add item");
			// More specific errors to be implemented later.
		}
	}
	
	// Retrieves all items from database.
	public function getAll()
	{
		// Retrieve all item listings from database.
		$times = $this->db->get('item_listing');
		return $times->result();
	}
}
?>