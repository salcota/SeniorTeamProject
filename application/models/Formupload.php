<?php

Class Formupload extends CI_Model
{
  	public function do_upload($data)
 	{
   		{
     			$this->db->insert('reg_user', $data);
     			$user_id = $this->db->insert_id();
   		}
   
   		return $user_id;
 	}
}
?>
