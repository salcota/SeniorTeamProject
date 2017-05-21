<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends CI_Controller
{
	const defaultProfile = "../public/images/defaultpic.jpeg";
	
    public function __construct()
    {
		// Gets item listing,  basic header and styles for all pages.
        parent::__construct();
		$this->load->library('Blobster');
        $this->load->model('Imageloader');
    }
	
	private function showImage($img)
	{
		$type = $this->blobster->getType($img);
		
		// Create header.
		header("Content-Type: " . $type);
		// Display image content.
		echo $img;
	}

    public function listingThumb($id)
	{
		$this->showImage($this->Imageloader->showListingThumb($id));
	}
	
	public function listingPic($id)
	{
		$this->showImage($this->Imageloader->showListingPic($id));
	}
	
	public function itemPic($id)
	{
		$this->showImage($this->Imageloader->showPic($id));
	}
	
	public function itemThumb($id)
	{
		$this->showImage($this->Imageloader->showPicThumb($id));
	}
	
	public function userThumb($picId)
	{
		$img = $this->Imageloader->showUserThumb($picId);
		if (!$img == NULL)
		{
			$this->showImage($img);
		}
		else
		{
			$img = file_get_contents(APPPATH . self::defaultProfile);
			$this->showImage($img);
		}
	}
	
	public function userPic($picId)
	{
		$img = $this->Imageloader->showUserPic($picId);
		if (!$img == NULL)
		{
			$this->showImage($img);
		}
		else
		{
			$img = file_get_contents(APPPATH . self::defaultProfile);
			$this->showImage($img);
		}
	}
	
	public function captcha()
	{
		if ($this->loginhelper->isRegistered())
			return;
		
		$this->load->library("CaptchaData");
		$this->captchadata->showImage();
	}
}
?>
