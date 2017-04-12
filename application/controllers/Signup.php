<?php

class Signup extends CI_Controller
{
	public function __construct()
        {
 	 parent::__construct();
 	 $this->load->model('formupload');
 	 $this->load->helper(array('form', 'url'));
	}
	 public function index()
	 {
 	 $this->load->view('signup');
	 }


	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

		// Uses codeigniter session library to inform the user of errors stored in $login_attributes
		if($this->form_validation->run() == FALSE)
		{
			$login_attributes = array(
				'errors' => validation_errors()
			);

			$this->session->set_flashdata($login_attributes);
			redirect('home/view/signup');
		}
		// compares signup form input to database to check if input is unique. Eventually need to do this by setting
		// a rule in form_validation.
		else
		{
			// Transfer signup form input to compare with values in database
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$this->load->model('Reg_User');
			$user_email = $this->Reg_User->getUser($email,$password);

			// Compare signup attributes with the attributes stored in the database. Should be unique.
			if(!$user_email)
			{
				$user_data = array(
					//'user_id' => $user_id,
					'email' => $user_email,
					// need to add password
					'password' => $password,
					'logged_in' => true
				);


				$this->session->set_userdata($user_data);
				$this->session->set_flashdata('login_success', 'Welcome! You have succesfully signed up!');
				

				//assigns values to table in reg_user
				$save = array(
     				 'sfsu_email'          => $this->input->post('email'),
     				 'password'          => $this->input->post('password'),
       				 );

  				 $this->formupload->do_upload($save);

				// This page will change from home to reg_home later
				redirect('home/view/home');
			}
			else
			{
				$this->session->set_flashdata('login_failed', 'Signup failed, please provide a different email or password');
				// Needs to redirect to /signup but message won't display! Why?
				redirect('home/view/signup');
			}
		}










		// Checks to see if email is an sfsu email. Not currently working.
		function email_check($str)
		{
			if (stristr($str, '@mail.sfsu.edu') !== false) return true;

			$this->form_validation->set_message('email', 'give acceptalbe email.');
			return FALSE;
		}
	}
}

?>

