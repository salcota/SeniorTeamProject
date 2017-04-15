<?php

class Updateprofile extends CI_Model {


	public function __construct() {
		parent::__construct();
	}




	public function update($url) {

		$this->db->set('pic',$url);
     		$this->db->insert('reg_user_pic');
	}
}

?>

