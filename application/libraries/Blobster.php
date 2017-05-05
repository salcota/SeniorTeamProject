<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blobster
{
	private $tmpfile;
	private $tmpthumb;
	private $tmpdir;
	
	public $img;
	public $thumb;
	
	private $CI;

	function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->database();
		
		$this->tmpdir = sys_get_temp_dir() ;
	}
	
	public function upload($formName)
	{
		$config['upload_path']          = $this->tmpdir;
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 5120;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		
		$this->CI->upload->initialize($config);
		
		if ( ! $this->CI->upload->do_upload($formName))
		{
			throw new Exception($this->upload->display_errors());
		}
		else
		{
			$data = $this->CI->upload->data();
			
			$this->tmpfile = $data['full_path'];
			$this->tmpthumb = str_replace(".","_thumb.",$this->tmpfile);
			$this->genthumbnail();
			$this->CI->image_lib->clear();
			
			$this->img = file_get_contents($this->tmpfile);
			$this->thumb = file_get_contents($this->tmpthumb);
			
			
			unlink($this->tmpfile);
			unlink($this->tmpthumb);
		}
	}
	
	private function genthumbnail()
	{
        $config['image_library'] = 'gd2';
        $config['source_image'] = $this->tmpfile;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width']   = 75*3;
        $config['height']  = 50*2;

        $this->CI->load->library('image_lib', $config);

        return $this->CI->image_lib->resize();
    }
	
	public function saveProfilePic($userID, $inputName)
	{
		$this->upload($inputName);
		
		$this->CI->load->model('Imageloader');
		$this->CI->Imageloader->saveUserPic($userID, $this->img, $this->thumb);
	}
}
?>
