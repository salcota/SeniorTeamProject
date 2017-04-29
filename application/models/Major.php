<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Major extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// Returns array with all user majors.
	public function getMajors()
	{
		$majors = $this->db->get('sfsu_major');
		return $majors->result();
	}


   	 public function retrieveUserMajorName($id)
	{
        $this->db->where('major_id', $id);
        $result = $this->db->get('sfsu_major');
		return $result->row(1)->major_name;
    	}



}
?>
