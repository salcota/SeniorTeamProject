<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadprofile extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('updateprofile');
		$this->load->model('imageloader');
		$this->load->library('loginhelper');

	}


	public function index()
	{

		$this->load->view('your_profile');
	}


	public function save()
	{

		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;



		if(!empty($_FILES["userfile"]["name"]))
		{
			try
			{
				$this->load->library('Blobster');
				$this->blobster->saveProfilePic($id, 'userfile');
			}
			catch (Exception $e)
			{
			}
		}else{
			$url = $this->imageloader->showUserPic($id);
		     }

		if(!empty($_POST["description"]))
		{
			$biography = $_POST["description"];
		}else{
			$biography = $user->biography;
		     }
		if(!empty($_POST["major"]))
		{
			$major = $_POST["major"];
		}else{
			$major = $user->major;
		     }
		if(!empty($_POST["password"]) && !empty($_POST["passconf"]))
		{
		  if($this->form_validation->run() == FALSE)
		  {
			$login_attributes = array(
				'errors' => validation_errors()
			);
			$this->session->set_flashdata($login_attributes);
			redirect('Profile/me');
		  }else{
			$password = $_POST["password"];
			$this->updateprofile->updatePassword($id, $password);
		       }
		}

		$data = array(
		'biography' => $biography,
		'major_id' => $major,
		// data to be written to db
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
