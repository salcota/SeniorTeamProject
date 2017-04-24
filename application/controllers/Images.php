<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller
{

    public function __construct()
    {
	// Gets item listing,  basic header and styles for all pages.
        parent::__construct();
        $this->load->model('Imageloader');
    }

    public function listingThumb($id)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showListingThumb($id);
	}
	
	public function listingPic($id)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showListingPic($id);
	}
	
	public function itemPic($id)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showPic($id);
	}
	
	public function itemThumb($id)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showPicThumb($id);
	}

	public function userThumb($picId)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showUserThumb($picId);
	}
	
	public function userPic($picId)
	{
		header("Content-Type: image/jpeg");
		
		echo $this->Imageloader->showUserPic($picId);
	}
}
?>
