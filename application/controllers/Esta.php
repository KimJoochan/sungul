<?php
defined('BASEPATH') or exit('No direct script access allowed');
    class Esta extends CI_Controller{
    function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->model('organi_model');
		$this->load->model('scholar_model');
		$this->load->model('spon_model');
	}
    function __head(){
		$this->load->view('/common/header');
		$this->load->view('/common/nav');
	}
        
    function __estaInsert($arg, $par = ""){
		$this->load->view("/info/esta_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg, $par);
	}
        
    public function index(){
            $uri_var = ($this->uri->segment(3));
            $this->__head();
            switch ($uri_var){
                case 'establish':{
                    $this->__estaInsert("/info/esta_2");
                    break;
                }
                case 'organization':{
                    $notice = $this->organi_model->get_oragani();
                    $max = $this->organi_model->get_max();
                    $min = $this->organi_model->get_min();
                    $data['res']=$notice;
                    $data['max']=$max;
                    $data['min']=$min;
                    $this->__estaInsert("/info/ora",$data);
                    break;
                }
                case 'insertExecutive':{
                    $this->__estaInsert("/info/insertExecutive");
                    break;
                }
                case 'updateExecutive':{
                    $idx=$this->input->get('idx');
                    $res=$this->organi_model->get_exec_idx($idx);
                    $this->__estaInsert("/info/updateExecutive",array('res'=>$res,'idx'=>$idx));
                    break;
                }
                //스폰서작업페이지
                case 'sponsor':	{
                    $res = $this->spon_model->get_by_name();
                    $this->__estaInsert("/info/sponsor", array('res' => $res));
                    break;
                }
                case "insertSponsor":{
                    $this->__estaInsert("/info/insertSponsor");
                    break;
                }
                case "updateSponsor":{
                    $idx=$this->input->get('idx');
                    $res=$this->spon_model->select_sponsor($idx);
                    $this->__estaInsert("/info/updateSponsor",array('res'=>$res,'idx'=>$idx));
                    break;
                }

                case 'scholarship':	{
                    $year = $this->input->get('year');
                    if ($year == null) {
                        $year = date("Y");
                    } else {
                        $year =$this->input->get('year');
                    }
                    $get_by_year = $this->scholar_model->get_by_year($year);
                    $get_cnt = $this->scholar_model->get_cnt($year);
                    $data['year']=$year;
                    $data['row']=$get_by_year;
                    $data['row1']=$get_cnt;
                    $this->__estaInsert("/info/scholarship", $data);
                    break;
                }
                case "insertScholar":{
                    $year=$this->input->get('year');
                    $this->__estaInsert('/info/insertScholar',array("year"=>$year));
                    break;
                }
                case "updateScholar":{
                    $idx=$this->input->get('idx');
                    $res=$this->scholar_model->get_scholar_idx($idx);
                    $this->__estaInsert('/info/updateScholar',array("res"=>$res,'idx'=>$idx));
                    break;
                } 
            }
        $this->load->view('/common/footer');
        }
    }
?>
