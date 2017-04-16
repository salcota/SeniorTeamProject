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
}
?>
