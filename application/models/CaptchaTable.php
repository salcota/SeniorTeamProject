<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CaptchaTable extends CI_Model
{
	// Captchas expire after 15 minutes.
	const expLimit = 900;
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function storeCaptcha($img, $time, $word)
	{
		$this->deleteOld();
		
		$data['image'] = $img;
		$data['time'] = $time;
		$data['word'] = $word;
		
		$this->db->insert("captcha", $data);
		return $this->db->insert_id();
	}
	
	public function deleteCaptcha($id)
	{
		$this->deleteOld();
		
		if (is_numeric($id))
		{
			$this->db->where("captcha_id", $id);
			$this->db->delete("captcha");
		}
	}
	
	private function deleteOld()
	{
		$exp = time() - self::expLimit;
		$this->db->where("time < ", $exp);
		$this->db->delete("captcha");
	}
	
	/*
	Returns the word-answer associated with a captchaID.
	This function throws exceptions. Put inside a try-catch.
	*/
	public function getWord($id)
	{
		$this->deleteOld();
		
		if (!is_numeric($id))
			throw new Exception("Invalid captcha ID");
		
		$this->db->select("word");
		$this->db->where("captcha_id", $id);
		$data = $this->db->get("captcha")->result();
		
		if (count($data) == 1)
			return $data[0]->word;
		else
			throw new Exception("Captcha doesn't exist.");
	}
	
	public function exists($id)
	{
		$this->deleteOld();
		
		if (!is_numeric($id))
			return false;
		
		$this->db->select("captcha_id");
		$this->db->where("captcha_id", $id);
		$data = $this->db->get("captcha")->result();
		
		if (count($data) == 1)
			return true;
		else
			return false;
	}
	
	public function image($id)
	{
		$this->deleteOld();
		
		if (!is_numeric($id))
			return NULL;
		
		$this->db->select("image");
		$this->db->where("captcha_id", $id);
		$data = $this->db->get("captcha")->result();
		
		if (count($data) == 1)
			return $data[0]->image;
		else
			return NULL;
	}

}
?>
