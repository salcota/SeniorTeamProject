<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imageloader extends CI_Model
{
	public function showListingThumb($id)
	{
		$this->db->where('listing_id', $id);
		$img = $this->db->get('item_listing');
		$img = $img->result()[0]->dp_thumbnail;
		return $img;
	}
	
	public function showListingPic($id)
	{
		$this->db->where('listing_id', $id);
		$img = $this->db->get('item_listing');
		$img = $img->result()[0]->display_pic;
		return $img;
	}
	
	public function showPic($id)
	{
		$this->db->where('item_pic_id', $id);
		$img = $this->db->get('item_pic');
		$img = $img->result()[0]->pic;
		return $img;
	}
	
	public function showPicThumb($id)
	{
		$this->db->where('item_pic_id', $id);
		$img = $this->db->get('item_pic');
		$img = $img->result()[0]->thumbnail;
		return $img;
	}
	
	public function showUserThumb($id)
	{
		$this->db->where('pic_id', $id);
		$img = $this->db->get('reg_user_pic');
		$img = $img->result()[0]->thumbnail;
		return $img;
	}
	
	public function showUserPic($id)
	{
		$this->db->where('pic_id', $id);
		$img = $this->db->get('reg_user_pic');
		$img = $img->result()[0]->pic;
		return $img;
	}
}
?>
