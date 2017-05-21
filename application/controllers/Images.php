<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller
{
	const defaultProfile = "../public/images/defaultpic.jpeg";
	
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
		
		$img = $this->Imageloader->showUserThumb($picId);
		if (!$img == NULL)
		{
			echo $img;
		}
		else
		{
			$img = file_get_contents(APPPATH . self::defaultProfile);
			echo $img;
		}
	}
	
	public function userPic($picId)
	{
		header("Content-Type: image/jpeg");
		
		$img = $this->Imageloader->showUserPic($picId);
		if (!$img == NULL)
		{
			echo $img;
		}
		else
		{
			$img = file_get_contents(APPPATH . self::defaultProfile);
			echo $img;
		}
	}
}
?>
