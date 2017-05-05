<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Themes extends CI_Model
{
	const defaultTheme = "gardenTheme";

	public function __construct()
	{
		$this->load->database();
	}

	// Returns array with all user majors.
	public function getTheme($userID)
	{
		$this->db->select('theme');
		$this->db->where('user_id', $userID);
		$data = $this->db->get('reg_user')->result();
		
		if (count($data) > 0)
		{
			$result = $data[0]->theme;
			if (strlen($result) > 0)
				return $result;
			else
				return self::defaultTheme;
		}
		else
			return NULL;
	}


   	 public function setTheme($userID, $theme)
	{
        $this->db->select('theme');
		$this->db->where('user_id', $userID);
		
		$data['theme'] = $theme;
		$this->db->update('reg_user', $data);
	}



}
?>
