<?php

class Users extends CI_Controller
{

	public function login()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'errors' => validation_errors()
			);

			$this->session->set_flashdata($data);
			redirect('home/view/login');
		}

		else

		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->load->model('Reg_User');
			//$user_id = $this->R_User->login_user($email,$password);	
			$user_email = $this->Reg_User->getUser($email,$password);
			if($user_email)
			{
				$user_data = array(
					//'user_id' => $user_id,
					'email' => $user_email,
					// need to add password
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);
				$this->session->set_flashdata('login_success', 'You are now logged in');
				
				redirect('home/view/home');
			}
			else
			{
				$this->session->set_flashdata('login_failed', 'Sorry, the information you put is unrecognized');		
				redirect('home/view/login');
			}
		}
	}

	public function update_profile(){

	}

	public function buy_request(){

	}

	public function post_itemlisting(){

	}
}

?>
