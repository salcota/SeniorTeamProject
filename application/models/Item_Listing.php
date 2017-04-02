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
	
	
	/* Retrieves items from database.
		Accepts array of data to search.
		Not all array elements are mandatory
		$array['user'] == username
		$array['title']
		$array['category']
		$array['listingID']
		$array['sort'] // Sort results by field name
			Assign comma-delimited string of FIELDNAME followed by space and either ASC or DESC.
				ASC = Ascending
				DESC = Descending
			Example:
			$array['sort'] = "title ASC, price DESC";
		
		array['maxResults'] // (Integer) Maximum number of results to return. Use this with 'skipResults' to start searching at specific index.
		array['skipResults'] // (Integer) Skip and ignore the first X number of results.
		
		Example:
		// Find Lamps
		$lookup = array();
		$lookup['title'] = "lamp";
		$lookup['category'] = 1;
		$lookup['sort'] = "title ASC, price DESC, posted_on DESC";
		$results = $this->Item_Listing->getItems($lookup);
		
		// Find everything
		$results = $this->Item_Listing->getItems();
	*/
	public function getItems($search = NULL)
	{
		$this->buildQuery($search);
		$items = $this->db->get('item_listing');
		return $items->result();
	}
	
	/*
	Returns the number of items which would be returned for a given query.
	See getItems() for constructing queries.
	*/
	public function countItems($search = NULL)
	{
		$this->buildQuery($search);
		$items = $this->db->count_all_results('item_listing');
		
		// Reset the query builder
		$this->db->reset_query();
		
		return $items;
	}
	
	
	// Private function for building queries.
	// Does not execute queries.
	private function buildQuery($search = NULL)
	{
		$this->load->model('Reg_User');
		
		// Add search criteria
		if ($search != NULL)
		{
			// Get by username
			if (array_key_exists('user', $search))
			{
				try
				{
					// Retrieve user_id of that user.
					$userID = $this->Reg_User->getUser($search['user'])->user_id;
				} catch (Exception $e)
				{
					// User not found. Search for nothing.
					$userID = -1;
				}
				$this->db->where('seller_id', $userID);
			}
			
			// Search by title
			if (array_key_exists('title', $search))
				$this->db->like('title', $search['title']);
			
			// Search by category
			try
			{
				if (array_key_exists('category', $search))
					$this->db->where('category_id', $search['category']);
			} catch (Exception $e)
			{
			
			}
			
			// Search by listing id
			if (array_key_exists('listingID', $search))
				$this->db->where('listing_id', $search['listingID']);
			
			// Sort the results
			if (array_key_exists('sort', $search))
			{
				if (strlen($search['sort']) > 0)
					$this->db->order_by($search['sort']);
			}
			
			// Restrict number of results. Skip results if requested.
				// If skip parameter given without limit, assign INT MAX as limit.
				if (array_key_exists('skipResults', $search) && !array_key_exists('maxResults', $search))
				{
					$search['maxResults'] = PHP_INT_MAX;
				}
				
				if (array_key_exists('maxResults', $search))
				{
					if (!array_key_exists('skipResults', $search))
						$this->db->limit($search['maxResults']);
					else
						$this->db->limit($search['maxResults'], $search['skipResults']);
				}
		}
	}
}
?>