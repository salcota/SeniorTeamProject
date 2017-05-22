<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meeting_Model extends CI_Model
{
	private $debug;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function disableDebug()
	{
		$this->debug = $this->db->db_debug;
		$this->db->db_debug = false;
	}
	
	private function enableDebug()
	{
		$this->db->db_debug = $this->debug;
	}

	public function getMeetups()
	{
		$data = $this->db->get('meetup')->result();
		
		$meetup;
		foreach($data as $location)
		{
			$meetup[$location->meet_id] = $location->location;
		}
		
		return $meetup;
	}
	
	public function setMeeting($itemID, $buyer, $meeting)
	{
		if (!is_numeric($itemID) || !is_numeric($buyer) || !is_numeric($meeting))
			return;
		
		$this->disableDebug();
		try
		{
			$data['item_id'] = $itemID;
			$data['user_id'] = $buyer;
			$data['meet_id'] = $meeting;
			
			$this->db->start_cache();
			$this->db->where('item_id', $itemID);
			$this->db->where('user_id', $buyer);
			$this->db->stop_cache();
			
			if ($this->db->count_all_results('meetings') == 1)
				$this->db->update('meetings', $data);
			else
			{
				$this->db->replace('meetings', $data);
			}
			$this->db->flush_cache();
		}
		catch (Exception $e)
		{
			$this->db->flush_cache();
			$this->enableDebug();
		}
		$this->enableDebug();
	}
	
	public function getMeeting($itemID, $buyer)
	{
		if (!is_numeric($itemID) || !is_numeric($buyer))
			return "";
		
		$this->db->where('item_id', $itemID);
		$this->db->where('user_id', $buyer);
		$this->db->join('meetup', 'meetup.meet_id = meetings.meet_id');
		$data = $this->db->get('meetings')->result();
		
		if (count($data) == 1)
			return $data[0]->meet_id;
		else
		{
			$this->db->limit(1);
			$this->db->order_by('meet_id', 'ASC');
			$data = $this->db->get('meetup')->result();
			if (count($data) == 1)
				return $data[0]->meet_id;
			else
				return "";
		}
	}
	
	public function delete($itemID)
	{
		$this->db->reset_query();
		$this->db->where('item_id', $itemID);
		$this->db->delete('meetings');
	}
}
?>
