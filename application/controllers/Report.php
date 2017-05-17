<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	// Attempting form validations for report misconduct, scota
    public function report()
    {
	// Deny access to unregistered users.
	if (!$this->loginhelper->isRegistered())
	{
		echo "You must be logged in to file a report.";
		exit;
	}
	
	$this->form_validation->set_rules('reportText', 'report', 'trim|required|alpha_numeric_spaces');
	$this->form_validation->set_rules('reportTerms', 'terms of agreement', 'required|callback_reportTerms');


	if($this->form_validation->run() == FALSE)
	{
		if(!$this->input->post('reportTerms'))
		{
			//echo "please check following claim is true.";
			// do redirection??
		}
		else
		{
			// do something??
		}
		$data = array(
			'bad_report' => validation_errors()
		);
		echo $data['bad_report']; 
		//$this->session->set_flashdata($data);
		//redirect('home/view/home');
	} else {
		//do something
		//redirect('home/view/home');
		
        }
     }
	 
     public function reportTerms()
     {
		if (isset($_POST['reportTerms'])) return true;
		$this->form_validation->set_message('reportTerms', 'Please check following claim is true.');
		return false;
     }
}
?>