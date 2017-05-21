<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reporter extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function createReport($userID, $message)
	{
		if (is_numeric($userID) && strlen($message) > 0 && strlen($message) <= 300)
		{
			$report['user_id'] = $userID;
			$report['message'] = $message;
			$this->db->insert('reports', $report);
		}
	}

}
?>
