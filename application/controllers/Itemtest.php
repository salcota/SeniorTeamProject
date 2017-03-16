<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemtest extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Reg_User');
		$this->load->model('Item_Listing');
		
		try
		{
		$this->Reg_User->addUser("bob", "Bob", "bob", "bob@bob.com", 4);
		}
		catch (Exception $e)
		{
		
		}
		
		$myName = $this->Reg_User->getUser("bob");
		echo $myName->username;
		
		
		$this->Item_Listing->addItem('Food', $this->Reg_User->getUser("bob")->user_id, 666, 'Mmmm good', 4);
		
		print "Start<br>";
		
		$items = $this->Item_Listing->getAll();
		foreach($items as $value)
		{
			print $value->title . "<br>";
		}
	}
}
