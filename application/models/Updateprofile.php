<?php

class Updateprofile extends CI_Model {


	public function __construct() {
		parent::__construct();
	}


	public function update($url, $id, $data) {
		// Uploads photo to reg_uer_pic table
		$this->db->set('user_id',$id);
		$this->db->set('pic',$url);
     		$this->db->insert('reg_user_pic');
		// Updates new reg_user data
		$this->db->where('user_id', $id);
		$this->db->update('reg_user', $data);
	}


	/* Under Construction
	public function getphoto($id) {
	}
	*/

}

?>

