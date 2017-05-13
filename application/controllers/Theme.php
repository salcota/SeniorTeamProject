<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme extends CI_Controller
{
	private $id;
	private $url;

	public function __construct()
    {
	// Gets item listing,  basic header and styles for all pages.
        parent::__construct();
		
		if (!$this->loginhelper->isRegistered())
			show_404();
		
		$this->id = $this->loginhelper->getLoginData()->user_id;
		
        $this->load->model('Themes');
		
		// Remember previous page.
		$this->load->library('user_agent');
		if (!$this->agent->is_referral())
			$this->url = $this->agent->referrer();
    }
	
	public function setTheme($theme)
	{
		$this->loginhelper->blockOutsideLinks();
		if (strlen($theme) > 0)
		{
			$this->Themes->setTheme($this->id, $theme);
		}
		$this->bounce();
	}
	
	private function bounce()
	{
		if (strlen($this->url) > 0)
			redirect($this->url);
	}
}
?>
