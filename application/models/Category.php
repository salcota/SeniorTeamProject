<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}
	
	// Returns array with all item categories.
	public function getCategories()
	{
		$categories = $this->db->get('item_category');
		return $categories->result();
	}

	public function getCategoryById($id){
		$this->db->select('category_name');
		$this->db->where('category_id', $id);
        $result = $this->db->get('item_category');
        $name = $result->result();
        return $name[0]->category_name;
	}
}
?>
