<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captchadata
{
	private $CI;
	private $tmpdir;
	
	private $capID;

	function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->database();
		$this->CI->load->library('session');
		
		// Load captcha helper
		$this->CI->load->helper('captcha');
		
		$this->CI->load->model("CaptchaTable");
		
		$this->tmpdir = sys_get_temp_dir() . "/";
		//$this->tmpdir = APPPATH . "../public/temp/";
		
		$this->capID = $this->CI->session->captchaID;
	}
	
	public function createCaptcha()
	{
		$this->deleteCaptcha();
		
		$vals = array(
			'img_path'      => $this->tmpdir,
			'img_url'       => base_url(),
			'img_width'     => '150',
			'img_height'    => 30,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors'        => array(
					'background' => array(255, 255, 255),
					'border' => array(255, 255, 255),
					'text' => array(0, 0, 0),
					'grid' => array(255, 40, 40)
			)
		);

		$cap = create_captcha($vals);
		$file = $this->tmpdir . $cap['time'] . ".jpg";
		
		$img = file_get_contents($file);
		unlink($file);
		
		$id = $this->CI->CaptchaTable->storeCaptcha($img, $cap['time'], $cap['word']);
		
		$this->CI->session->captchaID = $id;
		$this->capID = $id;
	}
	
	public function deleteCaptcha()
	{
		if (is_numeric($this->capID))
			$this->CI->CaptchaTable->deleteCaptcha($this->capID);
	}
	
	public function matches($answer)
	{
		if (!is_numeric($this->capID))
			return false;
		
		if (strlen($answer) == 0)
		{
			$this->createCaptcha();
			return false;
		}
		
		$answer = strtolower($answer);
		try
		{
			$matching = strtolower($this->CI->CaptchaTable->getWord($this->capID));
			
			if ($answer == $matching)
			{
				$this->deleteCaptcha();
				return true;
			}
			else
			{
				$this->createCaptcha();
				return false;
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function showImage()
	{
		if (!$this->CI->CaptchaTable->exists($this->capID))
			$this->createCaptcha();
		
		$img = $this->CI->CaptchaTable->image($this->capID);
		
		$this->CI->load->library("Blobster");
		$type = $this->CI->blobster->getType($img);
		
		header('Content-Type: ' . $type);
		echo $img;
	}
}
?>
