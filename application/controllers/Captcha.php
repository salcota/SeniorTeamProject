<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Captcha extends CI_Controller
{
    function __construct() {
	parent::__construct();
	// Load captcha helper
	$this->load->helper('captcha');
    }

    public function index(){
	// If captcha is submitted
	if($this->input->post('submit')){
	    $inputCaptcha = $this->input->post('captcha');
	    $sessCaptcha = $this->session->userdata('captchaCode');
	    if($inputCaptcha === $sessCaptcha){
	        echo 'Captcha code matched.';
	    }else{
	        echo 'Captcha code was not matched, try again.';
	    }
        }

        // Captcha configuration
        $config = array(
	    'img_path'	    => APPPATH.'../public/temp/',
	    'img_url'	    => base_url().'/public/temp/',
	    'img_width'	    => '150',
	    'img_height'    => 50,
	    'word_length'   => 8,
	    'font_size'	    => 16
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);

        // Send captcha image to view
        $data['captchaImg'] = $captcha['image'];

        // Load the view
        $this->load->view('home/captcha', $data);
    }

    public function refresh(){
        // Captcha configuration
        $config = array(
	    'img_path'	    => APPPATH.'../public/temp/',
	    'img_url'	    => base_url().'/public/temp/',
	    'img_width'	    => '150',
	    'img_height'    => 50,
	    'word_length'   => 8,
	    'font_size'	    => 16
        );
        $captcha = create_captcha($config);

        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);

        // Display captcha image
        echo $captcha['image'];
    }
}	
