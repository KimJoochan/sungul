<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('notice_model');
		$this->load->model('login_model');
		$this->load->model('gallery_model');
		$this->load->library('template');//자체적인 라이브러리
	}

	public function index(){ //맨처음 화면
        $notice = $this->notice_model->get_notice();
		$gallery = $this->gallery_model->get_gallery();
		$this->template->header(); //자체적인 라이브러리
		$this->load->view('index', array('notice' => $notice, 'gallery' => $gallery));
		$this->load->view('/common/footer');
	}
    
	public function info(){
		$uri_var = ($this->uri->segment(3));
		$this->template->header();
		switch ($uri_var) {
			case "login":{
				$this->load->view("/board/login");
				break;
			}
			case 'info':
				$this->template->infoInsert("/info/info_2");
				break;
			case 'greeting':{
				$this->template->infoInsert("/info/greeting_2");
				break;
			}
			case 'directions':{
				$this->template->infoInsert("/info/direction_2");
				break;
			}
			case 'dalma':{
				$this->template->dalma("/info/dalm_2");
				break;
			}
			default:{
				redirect(base_url()."index");
				break;
			}
        }
        $this->load->view('/common/footer');
    }		
}
