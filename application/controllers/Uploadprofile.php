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

		$url =$this->do_upload();

		$data = array(
		'biography' => $_POST["description"]
		// more will be added when I can update the other forms
		);

		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;

		$this->updateprofile->update($url,$id,$data);


	}



	public function do_upload()
	{
		// I would explain what this does but the tutorial was in another language
		// returns the uploaded photo as stores in it .public/temp/uploads and returns it as $url
		$type = explode('.', $_FILES["photo"]["name"]);
		$type = $type[count($type)-1];
		$url = "./public/temp/uploads/".uniqid(rand()).'.'.$type;
		if(in_array($type, array("jpg", "jpeg", "gif", "png")))
			if(is_uploaded_file($_FILES["photo"]["tmp_name"]))
				if(move_uploaded_file($_FILES["photo"]["tmp_name"],$url))
					return $url;
		return "";

	}
}
?>
