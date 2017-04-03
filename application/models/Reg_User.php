<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Reg_User extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
		
		// Load CodeIgniter's table-editor
		$this->load->dbforge();
		
		
	}
	
	// Adds a new user to the database.
	// Throws error if user cannot be added.
	public function addUser($username, $realname = "", $password, $email, $major, $mobile = NULL)
	{
		// Turn off debugging
		$debug = $this->db->db_debug;
		$this->db->db_debug = false;
		
		// Create array with item details.
		$dbItem = array('username' => $username, 'name' => $realname, 'password' => $password, 'sfsu_email' => $email, 'major_id' => $major, 'mobile' => $mobile);
		
		// Add item to database.
		if ($this->db->insert('reg_user', $dbItem))
		{
			$this->db->db_debug = $debug;
			return true;
		}
		else
		{
			$this->db->db_debug = $debug;
			throw new Exception("Cannot add user");
			// More specific errors to be implemented later.
		}
	}
	
	// Gets a user-object from the database.
	// Returns error if operation fails.
	public function getUser($name = NULL)
	{
		// Find user in database
		if ($name != NULL)
		{
			$user = $this->db->get_where('reg_user', array('username' => $name));
			$result = $user->result();
			if (count($result) == 1)
				return $result[0];
			else
				throw new Exception("User does not exist");
		}
		else
			throw new Exception('No username given to search');
	}
}
?>