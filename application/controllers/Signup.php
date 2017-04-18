<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller
{
	public function login($page = "signup")
	{
		// Minimum viable form validations.
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[reg_user.username]|min_length[3]|max_length[15]|alpha_numeric');
		$this->form_validation->set_rules('sfsu_email', 'Email', 'trim|required|valid_email|callback_email_check');

		// min_length for password should be changed to 8 before product launch.
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

		$this->form_validation->set_rules('terms_agreement', 'Terms & Agreement check', 'required');

		// Uses codeigniter session library to inform the user of errors stored in $login_attributes.
		if($this->form_validation->run() == FALSE)
		{
			$login_attributes = array(
				'errors' => validation_errors()
			);

			$this->session->set_flashdata($login_attributes);
			redirect('home/view/signup');
		} else {

			$this->load->model('Reg_User');
			if($this->Reg_User->create_user())
			{
				// Log the user in
				$email = $this->input->post('sfsu_email');
				$pass = $this->input->post('password');
				$userID = $this->Reg_User->getUser($email, $pass);
				
				$this->loginhelper->login($userID);
				
				// Get whatever page user was looking at before.
				$previous = $this->loginhelper->BeforeLogin();
				if ($previous != NULL)
					redirect($previous);
				else
				// Redirect to home page
					redirect('home/view/home');
			}
		}
	}
	
	// Custom function uses native php stristr to search for @mail.sfsu.edu within string sfsu_email.
	public function email_check($str)
	{
		if (stristr($str, '@mail.sfsu.edu') !== false) return true;

		$this->form_validation->set_message('email_check', 'Must give a valid SFSU email.');
		return FALSE;
	}
}
?>



