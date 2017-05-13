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
		$this->load->library('session');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		$this->form_validation->set_rules('description', '', 'trim|required|max_length[2]');


		$user = $this->loginhelper->getLoginData();
		$id = $user->user_id;
		$size = 1024*5;
		$width = 2565;
		$height = 2565;

		/*-----profile picture upload-----*/
		$pic = NULL;
		if(!empty($_FILES["userfile"]["name"]))
		{
			try
			{
				$this->load->library('Blobster');
				$this->blobster->setMax($size, $width, $height);
				$this->blobster->upload('userfile');

				$pic['pic'] = $this->blobster->img;
				$pic['thumbnail'] = $this->blobster->thumb;
			}
			catch (Exception $e) {
			//throw new Exception ($e->getMessage() . "test");
			$picture_errors = array(
				'errors' => $e->getMessage(). "does not meet upload requirements"
			);
			$this->session->set_flashdata('picture_errors' ,$picture_errors[errors]);
			redirect('Profile/me');

			}

		}


		/*-----biography upload-----*/
		if(!empty($_POST["description"]))
		{
		  if($this->form_validation->run() == FALSE)
		  {
			$login_attributes = array(
				'errors' => validation_errors()
			);
			$this->session->set_flashdata($login_attributes);
			redirect('Profile/me');
		  }else{
			$biography = $_POST["description"];
			}
	 	}
		else{
			$biography = $user->biography;
		}


		/*-----major upload-----*/
		if(!empty($_POST["major"]))
		{
			$major = $_POST["major"];
		}else{
			$major = $user->major;
		     }


		/*-----change password upload-----*/
		if(!empty($_POST["password"]) && !empty($_POST["passconf"]))
		{
		  if($this->form_validation->run() == FALSE)
		  {
			$password_errors = array(
				'errors' => validation_errors()
			);
			$this->session->set_flashdata('profile_errors' ,$password_errors[errors]);
			redirect('Profile/me');
		  }else{
			$password = $_POST["password"];
			$this->updateprofile->updatePassword($id, $password);
		       }
		}


		/*-----send POST data to model-----*/

		$data = array(
		'biography' => $biography,
		'major_id' => $major,
		// data to be written to db
		);

		$this->updateprofile->update($pic,$id, $data);
		redirect('Profile/me');


	}

}
?>
