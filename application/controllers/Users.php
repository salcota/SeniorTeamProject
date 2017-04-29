<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        // Gets item listing,  basic header and styles for all pages.
        parent::__construct();
        $this->load->model('Item_Listing');
        $this->load->view('common/sfsu_demo');
        $this->load->view('common/required_meta_tags');

        // Load navbar
        $this->navbars->load();
    }
   
    // Attempting form validations for report misconduct, scota
    public function report()
    {
	$this->form_validation->set_rules('reportText', 'Report misconduct', 'trim|required|alpha_numeric');

	if($this->form_validation->run() == FALSE)
	{
		$data = array(
			'bad_report' => validation_errors()
		); 
		$this->session->set_flashdata($data);
	}


    }

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
			$userID = $this->Reg_User->getUser($email,$password);
			if(is_numeric($userID) && $userID >= 0)
			{
				$user_data = array(
					//'user_id' => $user_id,
					'email' => $userID,
					// need to add password
					'logged_in' => true
				);

				$this->session->set_userdata($user_data);

				// Sets user as logged in.
				$this->loginhelper->login($userID);
				
				// Redirects to previous page.
				$previousPage = $this->loginhelper->beforeLogin();
				// Does previous page exist?
				if ($previousPage != NULL)
					redirect($previousPage);
				else					
					redirect('home/view/home');
			}
			else
			{
				$this->session->set_flashdata('login_failed', 'The information you provided is unrecognized.');		
				redirect('home/view/login');
			}
		}
	}

	public function update_profile()
	{

	}

	public function buy_request()
	{

	}

     /* This function returns the add_item page to the user so that User can add new item listing to the portfolio.
     */
	public function sell_item(){
        $this->load->model('Category');
        $data['categories'] = $this->Category->getCategories();

        $this->load->view('reguser/add_itemlisting.php',$data);
        $this->load->view('common/jquery_tether_bootstrap');
        $this->load->view('common/footerbar');
	}
}
?>
