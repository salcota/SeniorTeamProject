<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class R_User extends CI_Model
{
	public function login_user($email, $password)
	{
		$this->db->where('sfsu_email', $email);
		$this->db->where('password', $password);

		$result = $this->db->get('reg_user');

		if($result->num_rows() == 1)
		{
			return $result->row(0)->id;
		}
		else
		{
			return false;
		}
	}
}

?>
