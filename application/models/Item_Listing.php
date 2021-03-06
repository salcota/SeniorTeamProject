<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Item_Listing extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		
		// Loads CodeIgniter's table-editor.
		$this->load->dbforge();
	}
	
	// addItem() adds an item listing to database.
	// Throws error if operation fails.
	public function addItem($title, $seller, $price, $description, $category)
	{
		$debug = $this->db->db_debug;
		$this->db->db_debug = false;
		
		// Creates array with item details.
		$dbItem = array('category_id' => $category, 'price' => $price, 'seller_id' => $seller, 'title' => $title, 'description' => $description);
		
		// Adds item to database.
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
		
		array['maxResults'] // (Integer) Maximum number of results to return. Use this with 'skipResults' to start searching at specific index.
		array['skipResults'] // (Integer) Skip and ignore the first X number of results.
		
		Example:
		// Find Lamps
		$lookup = array();
		$lookup['title'] = "lamp";
		$lookup['category'] = 1;
		
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
		
		// Resets the query builder.
		$this->db->reset_query();
		
		return $items;
	}
	

	// Private function for building queries.
	// Does not execute queries.
	private function buildQuery($search = NULL)
	{
		$this->load->model('Reg_User');
		
		// Adds search criteria.
		if ($search != NULL)
		{
			// Gets by username.
			if (array_key_exists('user', $search))
			{
                $this->db->where('reg_user.username', $search['user']);
			}
			
			// Searches by title.
			if (array_key_exists('title', $search))
				$this->db->like('title', $search['title']);
			
			// Searches by category.
			try
			{
				if (array_key_exists('category', $search))
					$this->db->where('item_listing.category_id', $search['category']);
			} catch (Exception $e)
			{
			
			}
			
			// Searches by listing id.
			if (array_key_exists('listingID', $search)){

			    $this->db->where('listing_id', $search['listingID']);
            }

			
			// Sorts the results.
			if (array_key_exists('sort', $search))
			{
			    $orderBy = 'asc';
				if (strlen($search['sort']) > 0){
				    if($search['sort'] == 'posted_on'){
                        $orderBy = 'desc';
                    }
                    $this->db->order_by($search['sort'], $orderBy);
                }
				
				// If some items have equal sorting value, sub-sort them by itemID
				$this->db->order_by("listing_id", "asc");
			}
			
			// Restricts number of results. Skip results if requested.
			// If skip parameter given without limit, assigns INT MAX as limit.
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
			
			// Only fetch some data.
			$this->db->select('listing_id, item_listing.category_id, seller_id, title, description, price, posted_on, user_id, username, name, sfsu_email, mobile, biography, major_id, registration_date, status, category_name');
			
			// Also include Reg_User table to search results.
			$this->db->join('reg_user', 'reg_user.user_id = item_listing.seller_id');
			// Also include category name
			$this->db->join('item_category', 'item_category.category_id = item_listing.category_id');
		}
	}

    /**
     * Stores an item listing data along with dp and thumbnail into the table.
     * @param $listing
     * @param $imgdata
     * @return mixed
     * @throws Exception
     */
	public function addItemListing($listing, $imgdata){

	    $debug = $this->db->db_debug;
        $this->db->db_debug = false;

        $listing['display_pic'] = file_get_contents($imgdata['full_path']);

        $listing['dp_thumbnail'] = file_get_contents($imgdata['file_path'].$imgdata['raw_name'].'_thumb'.$imgdata['file_ext']);

	    if($this->db->insert('item_listing',$listing)){

            $this->db->db_debug = $debug;
            return $this->db->insert_id();

	    }else{

            $this->db->db_debug = $debug;
            throw new Exception($this->db->error_message());
	    }
    }

    /**
     * Only updates the details of an item listing
     * @param $listingID
     * @param $details
     */
    public function updateItemListingDetails($listingId, $details){
	    $this->db->where('listing_id', $listingId);
	    $this->db->update('item_listing', $details);
    }

    /**
     * Removes the item listing from the database
     * @param $listingId
     */
	public function deleteItemListing($listingId){
	    $tables = array('item_pic', 'item_listing');
	    $this->db->where('listing_id', $listingId);
	    $this->db->delete($tables);
	    return;
    }

    /**
     * Updates an item pic for a given picID. It will update both pic and its thumbnail
     * @param $picId
     * @param $picData
     */
	public function updateItemPic($picId, $picData){

        $values['pic'] = file_get_contents($picData['full_path']);
        $values['thumbnail'] = file_get_contents($picData['file_path'].$picData['raw_name'].'_thumb'.$picData['file_ext']);

        $this->db->where('item_pic_id', $picId);
        $this->db->update('item_pic', $values);
    }

    /**
     * Deletes an item pic from item_pic table
     * @param $picId
     */
	public function deleteItemPic($picId){
        $this->db->delete('item_pic', array('item_pic_id' => $picId));
    }

    /**
     * Add a picture of a listing in the item_pic table
     * @param $listingId
     * @param $picData
     * @return mixed
     * @throws Exception
     */
	public function addItemPicture($listingId, $picData){
        $debug = $this->db->db_debug;
        $this->db->db_debug = false;
        $values['listing_id'] = $listingId;
        $values['pic'] = file_get_contents($picData['full_path']);
        $values['thumbnail'] = file_get_contents($picData['file_path'].$picData['raw_name'].'_thumb'.$picData['file_ext']);

        if($this->db->insert('item_pic',$values)){
            $this->db->db_debug = $debug;
            return $this->db->insert_id();
        }else{
            $this->db->db_debug = $debug;
            throw new Exception("Failed to insert picture in the db");
        }
    }

    /**
     * Updates the dp of an item listing
     * @param $listingId
     * @param $picData
     */
	public function updateItemDisplayPicture($listingId, $picData){
        $values['display_pic'] = file_get_contents($picData['full_path']);
        $values['dp_thumbnail'] = file_get_contents($picData['file_path'].$picData['raw_name'].'_thumb'.$picData['file_ext']);

        $this->db->where('listing_id', $listingId);
        $this->db->update('item_listing', $values);
    }


    /**
     * Returns all pictures of the item other than dp from item_pic table
     * @param null $listingID
     * @return null
     */
	public function getAllItemListingPictures($listingID = Null){

	    if($listingID != Null){
            $this->db->where('listing_id', $listingID);
            $item_pics = $this->db->get('item_pic');
            return $item_pics->result();
        }else{
	        return null;
        }
    }

    /**
     * Returns seller id for the listing
     * @param $listingId
     * @return null
     */
    public function getUserIdForListing($listingId){
	    if($listingId != Null){
	        $this->db->select('seller_id');
	        $this->db->where('listing_id', $listingId);
	        $result = $this->db->get('item_listing');
	        $id = $result->result();
	        return $id[0]->seller_id;
        }else{
	        return Null;
        }
    }

    public function getListingPicCount($listingId){
        $this->db->where('listing_id',$listingId);
        return $this->db->count_all_results('item_pic');
    }
}
