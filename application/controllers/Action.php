<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Action extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('organi_model');
		$this->load->model('scholar_model');
		$this->load->model('schedule_model');
		$this->load->model('gallery_model');
		$this->load->model('notice_model');
		$this->load->model('event_model');
		$this->load->model('spon_model');
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	public function index()
	{
		$uri_var = $this->uri->segment(3);
		switch ($uri_var) {
			case 'login':{
				$id = $this->input->post('id');
				$pwd = $this->input->post('password');
				$res = $this->login_model->loginAction($id, $pwd);
				echo $res->result;
				break;
			}
			case 'login_out':{
				$res = $this->login_model->logout();
				echo "<script>alert('로그아웃이 되었습니다.');history.back(1);</script>";
				break;
			}
			//스폰서 함수들
			case 'sponsorAction':{
				$type = $this->input->post('type');
				if ($type == "insert") {
					$money = $this->input->post('money');
					$name = $this->input->post('name');
					$location = $this->input->post('location');
					echo $this->spon_model->insert_sponsor($money, $name, $location);
				} else if ($type == "delete") {
					$idx = $this->input->post('idx');
					echo $this->spon_model->delete_sponsor($idx);
				} else if ($type == "update") {
					$money = $this->input->post('money');
					$name = $this->input->post('name');
					$location = $this->input->post('location');
					$idx = $this->input->post('idx');
					$res = $this->spon_model->update_sponsor($money, $name, $location, $idx);
					echo $res;
				}
				break;
			}
			//장학금 수혜자 함수들
			case "scholarAction":{
				$type = $this->input->post('type');
				if ($type == "insert" || $type == "update") {
					$year = $this->test_input($this->input->post('year'));
					$name = $this->test_input($this->input->post('name'));
					$degree = $this->test_input($this->input->post('degree'));
					$school = $this->test_input($this->input->post('school'));
					$grade = $this->test_input($this->input->post('grade'));
					$local = $this->test_input($this->input->post('local'));
				}
				if ($type == "delete" || $type == "update") {
					$idx = $this->input->post('idx');
				}
				if ($type == "insert") {
					$res = $this->scholar_model->scholarInsert($year, $name, $degree, $school, $grade, $local);
					echo $res;
				} else if ($type == "update") {
					$res = $this->scholar_model->scholarUpdate($year, $name, $degree, $school, $grade, $local, $idx);
					echo $res;
				} else if ($type == "delete") {
					echo $this->scholar_model->scholarDelete($idx);
				} else if ($type == "update_cnt") {
					$year = $_POST('year');
					$grade1 = $_POST('grade1');
					$grade2 = $_POST('grade2');
					$grade3 = $_POST('grade3');
					$grade4 = $_POST('grade4');
					$sum = (int)$grade1 + (int)$grade2 + (int)$grade3 + (int)$grade4;
					echo $this->scholar_model->scholar_update_cnt($grade1, $grade2, $grade3, $grade4, $sum, $year);
				}
				break;
			}
			//임원등록 함수들
			case 'executiveAction':	{
				$type = $this->input->post('type');
				if ($type == "insert" || $type == "update") {
					$job = $this->test_input($this->input->post('job'));
					$name = $this->test_input($this->input->post('name'));
					$phone = $this->test_input($this->input->post('phone'));
				}
				if ($type == "insert") {
					$max_exe = $this->organi_model->get_max_exec();
					$max = (int)$max_exe[0]['max'] + 1;
					$res = $this->organi_model->insert_exec($job, $name, $phone, $max);
					echo $res;
				} else if ($type == "delete") {
					$idx = $this->input->post('idx');
					$res = $this->organi_model->delete_exec($idx);
					echo $res;
				} else if ($type == "update") {
					$idx = $_POST('idx');
					$res = $this->organi_model->update_exec($idx, $job, $name, $phone);
					echo $res;
				}
				if ($type == "up" || $type == "down") {
					$seq1 = $_POST('seq');
					$idx1 = $_POST('idx');
					if ($type == "up") {
						$res = $this->organi_model->up_exec($seq1);
					} else if ($type == "down") {
						$res = $this->organi_model->down_exec($seq1);
					}
					$rowcnt = count($res);
					if ($rowcnt != 0) {
						$seq2 = "";
						foreach ($res as $key => $value) {
							$seq2 = $value['seq'];
							$idx2 = $value['idx'];
							break;
						}
						$update_res = $this->organi_model->up_update_exe($seq1, $idx2);
						if ($update_res) {
							$upres = $this->organi_model->up_update_exe($seq2, $idx1);
							if ($upres) {
								$res = $this->organi_model->select_max_exec();
								$max = '';
								foreach ($res as $key => $value) {
									$max = $value['max'];
									break;
								}
								$resMin = $this->organi_model->select_min_exec();
								foreach ($resMin as $key => $value) {
									$min = $value['min'];
									break;
								}
								$res = $this->organi_model->select_asc_seq();
								$table = "";
								foreach ($res as $key => $value) {
									$job = $value['job'];
									$name = $value['name'];
									$phone = $value['phone'];
									$seq = $value['seq'];
									$idx = $value['idx'];
									$table .= '<tr>';
									$table .= '<td>' . $job . '</td>';
									$table .= '<td>' . $name . '</td>';
									$table .= '<td>' . $phone . '</td>';
									$table .= '<td><img src="' . base_url() . 'static/img/top_icon.png" alt="" onclick="moveExecutive(\'up\',' . $seq . ',' . $min . ',' . $idx . ');">';
									$table .= '<img src="' . base_url() . 'static/img/bottom_icon.png" alt="" onclick="moveExecutive(\'down\',' . $seq . ',' . $max . ',' . $idx . ');">';
									$table .= '<img src="' . base_url() . 'static/img/update.png" alt="" onclick="location.href=\'' . base_url() . 'index/info/updateExecutive?idx=' . $idx . '\'">';
									$table .= '<img src="' . base_url() . 'static/img/delete.png" alt="" onclick="deleteExecutive(' . $idx . ');"></td></tr>';
								}
								echo @json_encode(array("result" => '1', "table" => $table));
							}
						}
					}
				}
				break;
			}
			// 갤러리 액션 함수들
			case "galleryAction":{
				$type=$this->input->get('type');
				if($type=="update" || $type =="delete"){
					$idx = $this->input->post('idx');
				}
				if($type=='insert' || $type=='update'){
					$title = $this->test_input($this->input->post('title'));
					$contents = $this->test_input($this->input->post('contents'));
					$target = "gallery";
				}
				if($type=="insert"){
					$raw_name = "";
					if (isset($_FILES['file'])) {
						$fileDeatil = $this->__upload($target);
						$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
					}
					$res = $this->gallery_model->insertGallery($raw_name, $title, $contents);
					if ($res == true) {
						echo "true";
					} else {
						echo "false";
					}
				}else if($type=='delete'){
					$res = $this->gallery_model->delete_gallery($idx);
					echo $res;
				}else if($type=='update'){
					if($this->input->post('oldname')==null){
						$raw_name="";
					}else{
						$raw_name=$this->input->post('oldname');
					}
					if ($_FILES['file']['name'] != "") {
						$fileDeatil = $this->__upload($target);
						$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
					}
					$res = $this->gallery_model->update_gallery($idx, $title, $contents, $raw_name);
					echo $res;
				}
				break;
			}
			//게시글 액션 함수들
			case "noticeAction":{
				$type=$this->input->get('type');
				if($type=='delete' || $type =='update'){
					$idx = $this->input->post('idx');
				}
				if($type=='insert' || $type=='update'){
					$title = $this->test_input($this->input->post('title'));
					$contents = $this->test_input($this->input->post('contents'));
					$target = "notice";
				}
				if($type=='insert'){
					$raw_name = "";
					if (isset($_FILES['file'])) {
						$fileDeatil = $this->__upload($target);
						$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
					}
					$res = $this->notice_model->insertNotice($raw_name, $title, $contents);
					if ($res == true) {
						echo "true";
					} else {
						echo "false";
					}
				}else if($type=='delete'){
					$res = $this->notice_model->deletetNotice($idx);
					echo $res ;
				}else if ($type=="update"){
					if($this->input->post('oldname')==null){
						$raw_name="";
					}else{
						$raw_name=$this->input->post('oldname');
					}
					if ($_FILES['file']['name'] != "") {
						$fileDeatil = $this->__upload($target);
						$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
					}
					$res = $this->notice_model->update_noitce($idx, $title, $contents, $raw_name);
					echo($res);
				}
				break;
			}
			case "downFile":{
				$name = $this->input->get('fileName');
				$this->load->helper('download');
				$data = file_get_contents($this->input->server('DOCUMENT_ROOT')."/board/notice/".$name);
				if(!force_download(mb_convert_encoding($name,'euc-kr','utf8'), $data)){
					echo "<script>alert('파일을 찾을 수 없습니다.')</script>";
				}
				break;
			}
			//이벤트 함수들
			case "eventAction":	{
				$type=$this->input->post('type');
				if($type=="insert" || $type=="update"){
					$start = $this->test_input($this->input->post('start'));
					$end = $this->test_input($this->input->post('end'));
					$title = $this->test_input($this->input->post('title'));
					$des = $this->test_input($this->input->post('description'));
				}
				if($type=="update" || $type=="delete"){
					$id = $this->input->post("id");
				}

				if($type=="insert"){
					$res = $this->event_model->insert_event($start, $end, $title, $des);
					echo $res;
				}else if($type=='update'){
					$res = $this->event_model->eventUpdate($id, $title, $start, $end, $des);
					echo $res;
				}else if($type=="delete"){
					$res = $this->event_model->eventDelte($id);
					echo $res;
				}
				break;
			}
			//스케줄 함수들
			case "scheduleActions":	{
				$type=$this->input->post('type');

				$period = $this->input->post('period');
				$table = '';
				if ($period == "year") {
					$table = "year_schedule";
				} else if ($period == "month") {
					$table = 'month_schedule';
				}

				if($type=='insert' || $type=='update'){
					$title = $this->test_input($this->input->post('title'));
					$contents = $this->test_input($this->input->post('contents'));
				}
				if($type=='update' || $type=='delete'){
					$idx = $this->input->post('idx');
				}

				if($type=='insert'){
					echo $this->schedule_model->insertSche($title, $contents, $table);
				}else if($type=='update'){
					echo $this->schedule_model->schUpdate($idx, $title, $contents, $table);
				}else if($type=='delete'){
					echo $this->schedule_model->schDelete($idx, $table);
				}
				break;
			}
			default:

				break;
		}
	}

	function __upload($type){
		if ($type == "gallery") {
			$config['upload_path'] = './board/gallery/';
		} else if ($type == "notice") {
			$config['upload_path'] = './board/notice/';
		}
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['overwrite'] = FALSE;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			return ($this->upload->data());
		} else {
			print_r($this->upload->display_errors());
		}
	}
}

?>
