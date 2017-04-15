<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reg_User extends CI_Model
{
	// testing this for adding users as per Udemy.com tutorials
	public function create_user()
	{
		$options = ['cost'=> 12];
		$encripted_pass = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
	

		$data = array(
			'username' => $this->input->post('username'),
			'password' => $encripted_pass,
			'sfsu_email' => $this->input->post('sfsu_email')

			);

		$insert_data = $this->db->insert('reg_user', $data);
		return $insert_data;
			
	}
	public function getUser($email, $password)
	{
		$this->db->where('sfsu_email', $email);

		$result = $this->db->get('reg_user');

		//$this->db->where('password', $password);
		$db_password = $result->row(6)->password;	

		if(password_verify($password, $db_password))
		{
			return true;
			//$result->row(1)->username;
		}
		else
		{
			return false;
		}
	}
}
?>
