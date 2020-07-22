<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->model('notice_model');
		$this->load->model('login_model');
		$this->load->model('gallery_model');
	}
	function __head(){
		$this->load->view('/common/header');
		$this->load->view('/common/nav');
	}
	function __infoInsert($arg)	{
		$this->load->view("/info/info_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg);
	}
	public function index(){ //맨처음 화면
        $notice = $this->notice_model->get_notice();
		$gallery = $this->gallery_model->get_gallery();
		$this->__head();
		$this->load->view('index', array('notice' => $notice, 'gallery' => $gallery));
		$this->load->view('/common/footer');
	}
    
	public function info(){
		$uri_var = ($this->uri->segment(3));
		$this->__head();
		switch ($uri_var) {
			case 'info':
				$this->__infoInsert("/info/info_2");
				break;
			case 'greeting':{
				$this->__infoInsert("/info/greeting_2");
				break;
			}
			case 'directions':{
				$this->__infoInsert("/info/direction_2");
				break;
			}
			case 'dalma':{
				$this->load->view("/info/dalm_1");
				$this->load->view("/common/locationBar");
				$this->load->view("/info/dalm_2");
				break;
			}
        }
        $this->load->view('/common/footer');
    }		
}
