<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blobster
{
	private $tmpfile;
	private $tmpthumb;
	private $tmpdir;
	
	private $maxSize;
	private $maxWidth;
	private $maxHeight;
	
	public $img;
	public $thumb;
	
	private $CI;

	function __construct() {
		// Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		
		$this->CI->load->database();
		
		$this->tmpdir = sys_get_temp_dir();
		
		$this->CI->load->library('image_lib');
		
		$this->maxSize = 5120;
		$this->maxWidth = 5120;
		$this->maxHeight = 5120;
	}
	
	public function setMax($size, $width, $height)
	{
		if (is_Numeric($size) && is_Numeric($width) && is_Numeric($height))
		{
			$this->maxSize = $size;
			$this->maxWidth = $width;
			$this->maxHeight = $height;
		}
		else
			throw new Exception("$this->Blobster->setMax(): You can only specify numbers");
	}
	
	public function upload($formName, $config = NULL)
	{
		if ($config == NULL)
		{
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['max_size']             = $this->maxSize;
			$config['max_width']            = $this->maxWidth;
			$config['max_height']           = $this->maxHeight;
		}
		$config['upload_path']          = $this->tmpdir;
		
		$this->CI->upload->initialize($config);
		
		if ( ! $this->CI->upload->do_upload($formName))
		{
			throw new Exception($this->CI->upload->display_errors());
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
		
		$this->CI->image_lib->clear();
		$this->CI->image_lib->initialize($config);

        $result = $this->CI->image_lib->resize();
		$this->CI->image_lib->clear();
		
		return $result;
    }
	
	public function getType($imgdata)
	{
		$f = finfo_open();
		
		try
		{
			$mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);
		}
		catch (Exception $e)
		{
			$mime_type = "application/octet-stream";
		}
		
		return $mime_type;
	}
}
?>
