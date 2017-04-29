<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg_User extends CI_Model
{
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

		$id = $this->retrieveUserId($data['username']);

		$this->defaultPic($id);
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
			//return true;
			return $result->row(1)->user_id;
		}
		else
		{
			return false;
		}
	}


	// Needs third function that gives user_id and returns all info about user...
	public function findUser($user_id)
    {
        $this->db->where('user_id', $user_id);
        $result = $this->db->get('reg_user')->result();

        if (count($result) == 1) {
            return $result[0];
        }

    }

    public function getUserIdByUsername($username){

		$this->db->select('user_id');
        $this->db->where('username', $username);
        $result = $this->db->get('reg_user');
		return $result->result();

    }


    public function retrieveUserId($username){

        $this->db->where('username', $username);
        $result = $this->db->get('reg_user');
		return $result->row(1)->user_id;

    }


    public function defaultPic($id){
	
	$pic = 'public/images/images-1.jpeg';
	$this->db->set('user_id',$id);
	$this->db->set('pic',$pic);
     	$this->db->insert('reg_user_pic');

    }
}
?>
