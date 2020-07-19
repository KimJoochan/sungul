<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		$this->load->database(); 
		$this->load->helper(array('form', 'url'));
		$this->load->model('main_model');
	}
	function __head(){
		$this->load->view('/common/header');
		$this->load->view('/common/nav');
	}
	public function index(){ //맨처음 화면
		$notice=$this->main_model->get_notice();
		$gallery=$this->main_model->get_gallery();
		$this->__head();
		$this->load->view('index',array('notice'=>$notice,'gallery'=>$gallery));
		$this->load->view('/common/footer');
	}
	function __infoInsert($arg){
		$this->load->view("/info/info_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg);
	}
	function __estaInsert($arg,$par=""){
		$this->load->view("/info/esta_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg,$par);
	}
	function __scheduInsert($arg="",$par=""){
		$this->load->view("/info/sche_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg,$par);
	}
	public function info(){
		$uri_var=($this->uri->segment(3));
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
			case 'establish':{
				$this->__estaInsert("/info/esta_2");
				break;
			}
			case 'organization':{
				$notice=$this->main_model->get_oragani();
				$max=$this->main_model->get_max();
				$min=$this->main_model->get_min();
				$this->__estaInsert("/info/ora",array("res"=>$notice,"max"=>$max,"min"=>$min));
				break;
			}
			case 'scholarship':{
				$year=$this->uri->segment(4);
				if($year==null){
					$year = date("Y");
				}else{
					$year=$this->uri->segment(4);
				}
				$get_by_year=$this->main_model->get_by_year($year);
				$get_cnt=$this->main_model->get_cnt($year);
				$this->__estaInsert("/info/scholarship",array('year'=>$year,'row'=>$get_by_year,'row1'=>$get_cnt));
				break;
			}
			case 'sponsor':{
				$res=$this->main_model->get_by_name();
				$this->__estaInsert("/info/sponsor",array('res'=>$res));
				break;
			}
			case 'schedule':{
				$get_year_sch=$this->main_model->get_year_schedule();
				$get_month_sch=$this->main_model->get_month_schedule();
				$this->__scheduInsert("/info/schedule_foo",array("year_sch"=>$get_year_sch,"month_sch"=>$get_month_sch));
			break;
			}
			case 'month':{
				$event =$this->main_model->get_event();
				$this->__scheduInsert("/info/month_sch",array('event'=>$event));
			break;
			}
			default:
				redirect(base_url().'index');
				break;
		}
		$this->load->view('/common/footer');
	}
	public function board(){
		$uri_var=($this->uri->segment(3));
		$this->__head();
		switch ($uri_var) {
			case "notice":{
				$page=$this->uri->segment(4);
				$search=$this->uri->segment(5);
				if($page==null){
					$page=1;
				}
				if($search==null){
					$search="";
				}else if($page>=2 && $search!=null){
					redirect(base_url()."index/board/notice/1/".$search);
				}
				$search=urldecode($search); //파라매타의 한글 깨짐 해결
				$num=$this->main_model->get_count($search);
				$page_num=$this->main_model->get_page_num($num);
				$s_page=$this->main_model->s_page($page);
				$e_page=$this->main_model->e_page($page_num,$page);
				$s_point=$this->main_model->s_point($page,$search);
				$res=$this->main_model->res($search,$s_point);
				$this->__scheduInsert("/board/notice",array('search'=>$search,'s_point'=>$s_point,'row'=>$res,'num'=>$num,'page_num'=>$page_num,'page'=>$page,'s_page'=>$s_page,'e_page'=>$e_page));
				break;
			}
			default:
				redirect(base_url().'index');
				break;
		}
		$this->load->view('/common/footer');
	}
}
