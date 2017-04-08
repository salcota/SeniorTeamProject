<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reg_User extends CI_Model
{
	public function getUser($email, $password)
	{
		//$this->db->where('sfsu_email', $email);
		//$this->db->where('password', $password);
		$this->db->where('sfsu_email', $email);
		$this->db->where('password', $password);
		
		$result = $this->db->get('reg_user');
		if($result->num_rows() == 1)
		{
			return true;//$result->row(0)->id;
		}
		else
		{
			return false;
		}
	}
}
?>
