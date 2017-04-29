<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadprofile extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('updateprofile');
		$this->load->library('loginhelper');
	}


	public function index()
	{

		$this->load->view('your_profile');
	}


	public function save()
	{

		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;

		$url =$this->do_upload();

		$data = array(
		'biography' => $_POST["description"]
		// more will be added when I can update the other forms
		);


		$this->updateprofile->update($url,$id, $data);
		redirect('Profile/me');


	}



	public function do_upload()
	{


		// returns the uploaded photo & stores it in public/temp/uploads and returns the photo path
		$type = explode('.', $_FILES["userfile"]["name"]);
		$type = $type[count($type)-1];
		$url = "public/profilePics/".uniqid(rand()).'.'.$type;
		if(in_array($type, array("jpg", "jpeg", "gif", "png")))
			if(is_uploaded_file($_FILES["userfile"]["tmp_name"]))
				if(move_uploaded_file($_FILES["userfile"]["tmp_name"],$url))
					return $url;
		return "";

	}




}
?>
