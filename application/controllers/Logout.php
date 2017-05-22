<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('user_agent');
	}
	
	public function index()
	{
		$this->loginhelper->blockOutsideLinks();
		$this->session->sess_destroy();
		redirect('');
	}
}
?>
