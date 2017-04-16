<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadprofile extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('updateprofile');
	}


	public function index()
	{

		$this->load->view('profile');
	}


	public function save()
	{

		$url =$this->do_upload();
		//$password = $_POST["password"];
		//$biography = $_POST["description"];
		$this->updateprofile->update($url);
	}



	public function do_upload()
	{
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
