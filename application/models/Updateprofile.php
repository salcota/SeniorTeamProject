<?php

class Updateprofile extends CI_Model {


	public function __construct() {
		parent::__construct();
	}




	public function update($url,$id, $data)
	{

		// Uploads photo to reg_user_pic table
		$userpic = array(
			'pic' => $url,
		);
		$this->db->where('user_id', $id);
     		$this->db->update('reg_user_pic', $userpic);

		// Updates new reg_user data
		$this->db->where('user_id', $id);
		$this->db->update('reg_user', $data);
	}

	public function updatePassword($id, $password)
	{
		$options = ['cost'=> 12];
		$encripted_pass = password_hash($password, PASSWORD_BCRYPT, $options);
		$passwordUpdate = array(
			'password' => $encripted_pass
		);
		$this->db->where('user_id', $id);
		$this->db->update('reg_user', $passwordUpdate);


	}

}

?>

