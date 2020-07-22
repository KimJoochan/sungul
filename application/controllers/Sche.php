<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Sche extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->model('notice_model');
		$this->load->model('schedule_model');
		$this->load->model('event_model');
		$this->load->model('common_model');
		$this->load->model('gallery_model');
	}
    function __head(){
		$this->load->view('/common/header');
		$this->load->view('/common/nav');
	}
    function __scheduInsert($arg = "", $par = "")	{
		$this->load->view("/info/sche_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg, $par);
	}
    public function index()	{
		$uri_var = ($this->uri->segment(3));
		$this->__head();
		switch ($uri_var) {
            case 'schedule':{
				$get_year_sch = $this->schedule_model->get_year_schedule();
				$get_month_sch = $this->schedule_model->get_month_schedule();
				$this->__scheduInsert("/info/schedule_foo", array("year_sch" => $get_year_sch, "month_sch" => $get_month_sch));
				break;
			}
			case 'month':{
				$event = $this->event_model->get_event();
				$this->__scheduInsert("/info/month_sch", array('event' => $event));
				break;
			}
			case "insertEvent":	{
				$this->__scheduInsert("/info/insertEvent");
				break;
			}
			case "updateEvent" :{
				$res = $this->event_model->get_event_order_start();
				$this->__scheduInsert("/info/updateEvent", array('res' => $res));
				break;
			}
			case "updateEventEach":{
				$id = $this->input->get('id');
				$res = $this->event_model->get_event_id($id);
				$this->__scheduInsert("info/updateEventEach", array('res' => $res));
				break;
			}
			case "insertSchedule":{
				$type = $this->input->get("type");
				$this->__scheduInsert("info/insertSchdule", array('type' => $type));
				break;
			}
			case "updateSchedule":{
				$idx = $this->input->get('idx');
				$type = $this->input->get('type');
				$table = '';
				if ($_GET['type'] == 'year') {
					$table = 'year_schedule';
				} else if ($_GET['type'] == 'month') {
					$table = 'month_schedule';
				};
				$res = $this->schedule_model->show_schedule($idx, $table);
				$this->__scheduInsert("info/updateSch", array('res' => $res, 'idx' => $idx, 'type' => $type));
				break;
			}
			case "notice":{
				if ($this->input->get('page') == null) {
					$page = 1;
				}else{
                    $page=$this->input->get('page');
                }
				if ($this->input->get('search') == null) {
					$search = "";
				}else{
                    $search=$this->input->get('search');
                }
				$search = urldecode($search); //파라매타의 한글 깨짐 해결
				$num = $this->common_model->get_count($search, $uri_var);
				$page_num = $this->common_model->get_page_num($num, $uri_var);
				$s_page = $this->common_model->s_page($page);
				$e_page = $this->common_model->e_page($page_num, $page);
				$s_point = $this->common_model->s_point($page, $search, $uri_var);
				$res = $this->common_model->res($search, $s_point, $uri_var);
                
                $data['search']=$search;
                $data['s_point']=$s_point;
                $data['row']=$res;
                $data['num']=$num;
                $data['page_num']=$page_num;
                $data['page']=$page;
                $data['s_page']=$s_page;
                $data['e_page']=$e_page;
                
				$this->__scheduInsert("/board/notice",$data);
				break;
			}
			case "gallery":	{
				$page=$this->input->get('page');
				$search=$this->input->get('search');
				if ($this->input->get('page') == null) {
					$page = 1;
				}
				if ($search == "") {
					$search = "";
				}
				$search = urldecode($search); //파라매타의 한글 깨짐 해결
				$num = $this->common_model->get_count($search, $uri_var);
				$page_num = $this->common_model->get_page_num($num, $uri_var);
				$s_page = $this->common_model->s_page($page);
				$e_page = $this->common_model->e_page($page_num, $page);
				$s_point = $this->common_model->s_point($page, $search, $uri_var);
				$res = $this->common_model->res($search, $s_point, $uri_var);
                $data['block']=5;
                $data['search']=$search;
                $data['s_point']=$s_point;
                $data['row']=$res;
                $data['num']=$num;
                $data['page_num']=$page_num;
                $data['page']=$page;
                $data['s_page']=$s_page;
                $data['e_page']=$e_page;
				$this->__scheduInsert("/board/gallery",$data);
				break;
			}
			case "galleryView":	{
				$idx = $this->input->get('idx');
				$page=$this->input->get('page');
				$search=$this->input->get('search');
				if ( $page== null) {
					$page = 1;
				}
				if ($search == null) {
					$search = "";
				}
				$search = urldecode($search); //파라매타의 한글 깨짐 해결
				$now_gallery = $this->gallery_model->get_idx_gallery($idx);
				$previous_gallery = $this->gallery_model->get_previous_idx($idx, $search);
				$next_gallery = $this->gallery_model->get_next_idx($idx, $search);
                $data['idx']=$idx;
                $data['search']=$search;
                $data['page']=$page;
                $data['now']=$now_gallery;
                $data['pre']=$previous_gallery;
                $data['next']=$next_gallery;
				$this->__scheduInsert("/board/galleryView", $data);
				break;
			}
			case "insertGallery":{
				$this->__scheduInsert("/board/insertGallery");
				break;
			}
			case "login":{
				$this->load->view("/board/login");
				break;
			}
			case "updateGallery":{
				$idx = $this->input->get('idx');
				if ($this->input->get('page') == null) {
					$page = 1;
				}else{
					$page=$this->input->get('page');
				}
				if ($this->input->get('search') == null) {
					$search = "";
				}else{
					$search=$this->input->get('search');
				}
				$res = $this->gallery_model->get_idx_gallery($idx);
                $data['idx']=$idx;
                $data['search']=$search;
                $data['page']=$page;
                $data['res']=$res;
				$this->__scheduInsert("/board/updateGallery", $data);
				break;
			}
			case "noticeView":{
				if (!isset($this->input->get['page'])) {
					$page = 1;
				} else {
					$page = $this->input->get['page'];
				}
				if (!isset($this->input->get['search'])) {
					$search = "";
				} else {
					$search = $this->input->get['search'];
				}
				$idx = $_GET['idx'];//idx값
				$view = $this->notice_model->get_view_alarm($idx);
				$pre_view = $this->notice_model->get_previous_view($idx, $search);
				$next_view = $this->notice_model->get_next_view($idx, $search);
                $data['view']=$view;
                $data['page']=$page;
                $data['search']=$search;
                $data['idx']=$idx;
                $data['nextrow']=$next_view;
                $data['prevrow']=$pre_view;
				$this->__scheduInsert("/board/noticeView", $data);
				break;
			}
			case "insertNotice":{
				$this->__scheduInsert("/board/insertNotice");
				break;
			}
			case "updateNotice":{
				$idx = $this->input->get('idx');
				$search=$this->input->get('search');
				$page=$this->input->get('page');
				if ($search==null){
					$search = "";
				} else {
					$search = $this->input->get('search');
				}
				if ($page==null){
					$page = 1;
				} else {
					$page = $this->input->get('page');
				}
				$res = $this->notice_model->get_view_alarm($idx);
				$this->__scheduInsert("/board/updateNotice", array("idx" => $idx, 'res' => $res, "idx" => $idx));
				break;
			}
			default:
				redirect(base_url() . 'index');
				break;
		}
		$this->load->view('/common/footer');
	}
}
?>
