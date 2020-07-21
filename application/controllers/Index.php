<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->model('main_model');
		$this->load->model('login_model');
	}

	function __head()
	{
		$this->load->view('/common/header');
		$this->load->view('/common/nav');
	}

	public function index()
	{ //맨처음 화면
		$notice = $this->main_model->get_notice();
		$gallery = $this->main_model->get_gallery();
		$this->__head();
		$this->load->view('index', array('notice' => $notice, 'gallery' => $gallery));
		$this->load->view('/common/footer');
	}

	function __infoInsert($arg)
	{
		$this->load->view("/info/info_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg);
	}

	function __estaInsert($arg, $par = "")
	{
		$this->load->view("/info/esta_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg, $par);
	}

	function __scheduInsert($arg = "", $par = "")
	{
		$this->load->view("/info/sche_com");
		$this->load->view("/common/locationBar");
		$this->load->view($arg, $par);
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
			case 'establish':{
				$this->__estaInsert("/info/esta_2");
				break;
			}
			case 'organization':{
				$notice = $this->main_model->get_oragani();
				$max = $this->main_model->get_max();
				$min = $this->main_model->get_min();
				$this->__estaInsert("/info/ora", array("res" => $notice, "max" => $max, "min" => $min));
				break;
			}
			case 'insertExecutive':{
				$this->__estaInsert("/info/insertExecutive");
				break;
			}
			case 'updateExecutive':{
				$idx=$this->input->get('idx');
				$res=$this->main_model->get_exec_idx($idx);
				$this->__estaInsert("/info/updateExecutive",array('res'=>$res,'idx'=>$idx));
				break;
			}
			//스폰서작업페이지
			case 'sponsor':	{
				$res = $this->main_model->get_by_name();
				$this->__estaInsert("/info/sponsor", array('res' => $res));
				break;
			}
			case "insertSponsor":{
				$this->__estaInsert("/info/insertSponsor");
				break;
			}
			case "updateSponsor":{
				$idx=$this->input->get('idx');
				$res=$this->main_model->select_sponsor($idx);
				$this->__estaInsert("/info/updateSponsor",array('res'=>$res,'idx'=>$idx));
				break;
			}

			case 'scholarship':	{
				$year = $this->uri->segment(4);
				if ($year == null) {
					$year = date("Y");
				} else {
					$year = $this->uri->segment(4);
				}
				$get_by_year = $this->main_model->get_by_year($year);
				$get_cnt = $this->main_model->get_cnt($year);
				$this->__estaInsert("/info/scholarship", array('year' => $year, 'row' => $get_by_year, 'row1' => $get_cnt));
				break;
			}
			case "insertScholar":{
				$year=$this->input->get('year');
				$this->__estaInsert('/info/insertScholar',array("year"=>$year));
				break;
			}
			case "updateScholar":{
				$idx=$this->input->get('idx');
				$res=$this->main_model->get_scholar_idx($idx);
				$this->__estaInsert('/info/updateScholar',array("res"=>$res,'idx'=>$idx));
				break;
			}


			//정기법회 행사계획
			case 'schedule':{
				$get_year_sch = $this->main_model->get_year_schedule();
				$get_month_sch = $this->main_model->get_month_schedule();
				$this->__scheduInsert("/info/schedule_foo", array("year_sch" => $get_year_sch, "month_sch" => $get_month_sch));
				break;
			}
			case 'month':{
				$event = $this->main_model->get_event();
				$this->__scheduInsert("/info/month_sch", array('event' => $event));
				break;
			}
			case "insertEvent":	{
				$this->__scheduInsert("/info/insertEvent");
				break;
			}
			case "updateEvent" :{
				$res = $this->main_model->get_event_order_start();
				$this->__scheduInsert("/info/updateEvent", array('res' => $res));
				break;
			}
			case "updateEventEach":{
				$id = $this->input->get('id');
				$res = $this->main_model->get_event_id($id);
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
				$res = $this->main_model->show_schedule($idx, $table);
				$this->__scheduInsert("info/updateSch", array('res' => $res, 'idx' => $idx, 'type' => $type));
				break;
			}

			default:
				redirect(base_url() . 'index');
				break;
		}
		$this->load->view('/common/footer');
	}

	public function board()
	{
		$uri_var = ($this->uri->segment(3));
		$this->__head();
		switch ($uri_var) {
			case "notice":{
				$page = $this->uri->segment(4);
				$search = $this->uri->segment(5);
				if ($page == null) {
					$page = 1;
				}
				if ($search == null) {
					$search = "";
				}
				$search = urldecode($search); //파라매타의 한글 깨짐 해결
				//검색을 하면 무조건 적으로 1페이지로 넘어가게 하기 javascipt나 form태그를 이용해서
				$num = $this->main_model->get_count($search, $uri_var);
				$page_num = $this->main_model->get_page_num($num, $uri_var);
				$s_page = $this->main_model->s_page($page);
				$e_page = $this->main_model->e_page($page_num, $page);
				$s_point = $this->main_model->s_point($page, $search, $uri_var);
				$res = $this->main_model->res($search, $s_point, $uri_var);
				$this->__scheduInsert("/board/notice", array('search' => $search, 's_point' => $s_point, 'row' => $res, 'num' => $num, 'page_num' => $page_num, 'page' => $page, 's_page' => $s_page, 'e_page' => $e_page));
				break;
			}
			case "gallery":	{
				$page = $this->uri->segment(4);
				$search = $this->uri->segment(5);
				if ($page == null) {
					$page = 1;
				}
				if ($search == "") {
					$search = "";
				}
				$search = urldecode($search); //파라매타의 한글 깨짐 해결
				$num = $this->main_model->get_count($search, $uri_var);
				$page_num = $this->main_model->get_page_num($num, $uri_var);
				$s_page = $this->main_model->s_page($page);
				$e_page = $this->main_model->e_page($page_num, $page);
				$s_point = $this->main_model->s_point($page, $search, $uri_var);
				$res = $this->main_model->res($search, $s_point, $uri_var);
				$this->__scheduInsert("/board/gallery", array('block' => 5, 'search' => $search, 's_point' => $s_point, 'row' => $res, 'num' => $num, 'page_num' => $page_num, 'page' => $page, 's_page' => $s_page, 'e_page' => $e_page));
				break;
			}
			case "galleryView":	{
				$uri = (array_reverse(explode('/', $_SERVER['REQUEST_URI'])));
				$idx = $uri[0];
				$search = $uri[1];
				$page = $uri[2];
				if ($page == null) {
					$page = 1;
				}
				if ($search == null) {
					$search = "";
				}
				$now_gallery = $this->main_model->get_idx_gallery($idx);
				$previous_gallery = $this->main_model->get_previous_idx($idx, $search);
				$next_gallery = $this->main_model->get_next_idx($idx, $search);
				$this->__scheduInsert("/board/galleryView", array('idx' => $idx, 'search' => $search, 'page' => $page, "now" => $now_gallery, "pre" => $previous_gallery, "next" => $next_gallery));
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
				$uri = (array_reverse(explode('/', $_SERVER['REQUEST_URI'])));
				$idx = $uri[0];
				$search = $uri[1];
				$page = $uri[2];
				$res = $this->main_model->get_idx_gallery($idx);
				$this->__scheduInsert("/board/updateGallery", array('idx' => $idx, 'search' => $search, 'page' => $page, 'res' => $res));
				break;
			}
			case "noticeView":{
				if (!isset($_GET['page'])) {
					$page = 1;
				} else {
					$page = $_GET['page'];
				}
				if (!isset($_GET['search'])) {
					$search = "";
				} else {
					$search = $_GET['search'];
				}
				$idx = $_GET['idx'];//idx값
				$view = $this->main_model->get_view_alarm($idx);
				$pre_view = $this->main_model->get_previous_view($idx, $search);
				$next_view = $this->main_model->get_next_view($idx, $search);
				$this->__scheduInsert("/board/noticeView", array('view' => $view, 'page' => $page, 'search' => $search, 'idx' => $idx, 'nextrow' => $next_view, "prevrow" => $pre_view));
				break;
			}
			case "insertNotice":{
				$this->__scheduInsert("/board/insertNotice");
				break;
			}
			case "updateNotice":{
				$idx = $_GET['idx'];
				if (!isset($_GET['search'])) {
					$search = "";
				} else {
					$search = $_GET['search'];
				}
				if (!isset($_GET['page'])) {
					$page = 1;
				} else {
					$page = $_GET['page'];
				}
				$res = $this->main_model->get_view_alarm($idx);
				$this->__scheduInsert("/board/updateNotice", array("idx" => $idx, 'res' => $res, "idx" => $idx));
				break;
			}
			default:
				redirect(base_url() . 'index');
				break;
		}
		$this->load->view('/common/footer');
	}

	public function action(){
		$uri_var = ($this->uri->segment(3));
		switch ($uri_var) {
			case 'login':
				$id = $this->input->post('id');
				$pwd = $this->input->post('password');
				$res = $this->login_model->loginAction($id, $pwd);
				echo $res->result;
				break;
			case 'login_out':{
				$res = $this->login_model->logout();
				echo "<script>alert('로그아웃이 되었습니다.');history.back(1);</script>";
				break;
			}
			//스폰서 함수들
			case 'sponsorAction':{
				$type=$this->input->post('type');
				if($type=="insert"){
					$money = $_POST['money'];
					$name = $_POST['name'];
					$location = $_POST['location'];
					echo $this->main_model->insert_sponsor($money,$name,$location);

				}else if($type=="delete"){
					$idx = $_POST['idx'];
					echo $this->main_model->delete_sponsor($idx);
				}else if($type=="update"){
					$money = $_POST['money'];
					$name = $_POST['name'];
					$location = $_POST['location'];
                	$idx=$_POST['idx'];
					$res= $this->main_model->update_sponsor($money,$name,$location,$idx);
					echo  $res;
				}
				break;
			}
			//장학금 수혜자 함수들
			case "scholarAction":{
				$type=$this->input->post('type');
				if($type=="insert" || $type=="update") {
					$year = $this->input->post('year');
					$name = $this->input->post('name');
					$degree = $this->input->post('degree');
					$school = $this->input->post('school');
					$grade = $this->input->post('grade');
					$local = $this->input->post('local');
				}
				if($type=="delete" || $type =="update"){
					$idx = $this->input->post('idx');
				}
				if($type=="insert"){
					$res=$this->main_model->scholarInsert($year,$name,$degree,$school,$grade,$local);
					echo $res;
				}else if($type=="update") {
					$res=$this->main_model->scholarUpdate($year,$name,$degree,$school,$grade,$local,$idx);
					echo $res;
				}else if($type=="delete"){
					echo $this->main_model->scholarDelete($idx);
				}else if($type=="update_cnt"){
					$year = $_POST['year'];
					$grade1 = $_POST['grade1'];
					$grade2 = $_POST['grade2'];
					$grade3 = $_POST['grade3'];
					$grade4 = $_POST['grade4'];
					$sum = (int)$grade1+(int)$grade2+(int)$grade3+(int)$grade4;
					echo $this->main_model->scholar_update_cnt($grade1,$grade2,$grade3,$grade4,$sum,$year);
				}
				break;
			}
		//임원등록 함수들
			case 'executiveAction':{
				$type=$this->input->post('type');
				if($type=="insert" || $type =="update"){
					$job = $_POST['job'];
					$name = $_POST['name'];
					$phone = $_POST['phone'];
				}
				if($type=="insert"){
					$max_exe=$this->main_model->get_max_exec();
					$max=(int)$max_exe[0]['max']+1;
					$res=$this->main_model->insert_exec($job,$name,$phone,$max);
					echo $res;
				}else if($type=="delete"){
					$idx=$this->input->post('idx');
					$res=$this->main_model->delete_exec($idx);
					echo $res;
				}else if($type=="update"){
					$idx = $_POST['idx'];
					$res=$this->main_model->update_exec($idx,$job,$name,$phone);
					echo $res;
				}
				if($type=="up" || $type=="down"){
					$seq1 = $_POST['seq'];
					$idx1 = $_POST['idx'];
					if($type=="up"){
						$res=$this->main_model->up_exec($seq1);
					}else if($type=="down"){
						$res=$this->main_model->down_exec($seq1);
					}
					$rowcnt=count($res);
					if($rowcnt!=0){
						$seq2="";
						foreach ($res as $key => $value){
							$seq2 = $value['seq'];
							$idx2 = $value['idx'];
							break;
						}
						$update_res=$this->main_model->up_update_exe($seq1,$idx2);
						if($update_res){
							$upres=$this->main_model->up_update_exe($seq2,$idx1);
							if($upres){
								$res=$this->main_model->select_max_exec();
								$max='';
								foreach ($res as $key => $value){
									$max=$value['max'];
									break;
								}
								$resMin=$this->main_model->select_min_exec();
								foreach ($resMin as $key => $value){
									$min=$value['min'];
									break;
								}
								$res=$this->main_model->select_asc_seq();
								$table="";
								foreach ($res as $key => $value) {
									$job=$value['job'];
									$name=$value['name'];
									$phone=$value['phone'];
									$seq=$value['seq'];
									$idx=$value['idx'];
									$table.='<tr>';
									$table.='<td>'.$job.'</td>';
									$table.='<td>'.$name.'</td>';
									$table.='<td>'.$phone.'</td>';
									$table.='<td><img src="'.base_url().'static/img/top_icon.png" alt="" onclick="moveExecutive(\'up\','.$seq.','.$min.','.$idx.');">';
									$table.='<img src="'.base_url().'static/img/bottom_icon.png" alt="" onclick="moveExecutive(\'down\','.$seq.','.$max.','.$idx.');">';
									$table.='<img src="'.base_url().'static/img/update.png" alt="" onclick="location.href=\''.base_url().'index/info/updateExecutive?idx='.$idx.'\'">';
									$table.='<img src="'.base_url().'static/img/delete.png" alt="" onclick="deleteExecutive('.$idx.');"></td></tr>';
								}
								echo @json_encode(array("result" => '1',"table"=>$table));
							}
						}
					}
				}
				break;
			}
			// 갤러리 액션 함수들
			case "galleryAction":{
				$title = $this->input->post('title');
				$contents = $this->input->post('contents');
				$raw_name = "";
				$type = "gallery";
				if (isset($_FILES['file'])) {
					$fileDeatil = $this->__upload($type);
					$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
				}
				$res = $this->main_model->insertGallery($raw_name, $title, $contents);
				if ($res == true) {
					echo "true";
				} else {
					echo "false";
				}
				break;
			}
			case "galleryDelete":{
				$idx = $this->input->post('idx');
				$res = $this->main_model->delete_gallery($idx);
				echo $res;
				break;
			}
			case "galleryUpdate":{
				$idx = $_POST['idx'];
				$title = $_POST['title'];
				$contents = $_POST['contents'];
				$raw_name = "";
				$type = "gallery";
				if ($_FILES['file']['name'] != "") {
					$fileDeatil = $this->__upload($type);
					$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
				}
				$res = $this->main_model->update_gallery($idx, $title, $contents, $raw_name);
				var_dump($res);
			}
			//게시글 액션 함수들
			case "noticeAction":{
				$title = $this->input->post('title');
				$contents = $this->input->post('contents');
				$raw_name = "";
				$type = "notice";
				if (isset($_FILES['file'])) {
					$fileDeatil = $this->__upload($type);
					$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
				}
				$res = $this->main_model->insertNotice($raw_name, $title, $contents);
				if ($res == true) {
					echo "true";
				} else {
					echo "false";
				}
				break;
			}
			case "noticeDelete":{
				$idx = $this->input->post('idx');
				$res = $this->main_model->deletetNotice($idx);
				echo($res);
				break;
			}
			case "noticeUpdate":{
				$idx = $_POST['idx'];
				$title = $_POST['title'];
				$contents = $_POST['contents'];
				$raw_name = "";
				$type = "notice";
				if ($_FILES['file']['name'] != "") {
					$fileDeatil = $this->__upload($type);
					$raw_name = $fileDeatil['raw_name'] . $fileDeatil['file_ext'];
				}
				$res = $this->main_model->update_noitce($idx, $title, $contents, $raw_name);
				echo($res);
				break;
			}
			case "eventAction":	{
				$start = $this->input->post('start');
				$end = $this->input->post('end');
				$title = $this->input->post('title');
				$des = $this->input->post('description');
				$res = $this->main_model->insert_event($start, $end, $title, $des);
				echo $res;
				break;
			}
			case "downFile":{
				$name = $this->input->get('fileName');
				$filepath = "./board/notice/$name";
				$filesize = filesize($filepath);
				$filename = $this->__mb_basename($filepath);
				if ($this->__is_ie()) $filename = $this->__utf2euc($filename);
				header("Pragma: public");
				header("Expires: 0");
				header("Content-Type: application/octet-stream");
				header("Content-Disposition: attachment; filename=\"$filename\"");
				header("Content-Transfer-Encoding: binary");
				header("Content-Length: $filesize");
				readfile($filepath);
				break;
			}
			case "eventUpdate":	{
				$id = $_POST['id'];
				$title = $_POST['title'];
				$start = $_POST['start'];
				$end = $_POST['end'];
				$description = $_POST['description'];
				$res = $this->main_model->eventUpdate($id, $title, $start, $end, $description);
				echo $res;
				break;
			}
			case "eventDelete":	{
				$id = $this->input->post("id");
				$res = $this->main_model->eventDelte($id);
				echo $res;
				break;
			}
			case "scheduleActions":	{
				$title = $_POST['title'];
				$contents = $_POST['contents'];
				$period = $_POST['period'];
				$table = '';
				if ($period == "year") {
					$table = "year_schedule";
				} else if ($period == "month") {
					$table = 'month_schedule';
				}
				echo $this->main_model->insertSche($title, $contents, $table);
				break;
			}
			case "scheduleUpdate":{
				$idx = $_POST['idx'];
				$title = $_POST['title'];
				$contents = $_POST['contents'];
				$period = $_POST['period'];
				if ($period == 'year') {
					$table = 'year_schedule';
				} else if ($period == 'month') {
					$table = 'month_schedule';
				};
				echo $this->main_model->schUpdate($idx,$title,$contents,$table);
				break;
			}
			case "scheduleDelete":{
				$idx = $_POST['idx'];
				$period = $_POST['period'];
				if($period=='year'){
					$table='year_schedule';
				}else if($period=='month'){
					$table='month_schedule';
				};
				echo $this->main_model->schDelete($idx,$table);
				break;
			}
			default:
				# code...
				break;
		}
	}

	function __mb_basename($path)
	{
		return end(explode('/', $path));
	}

	function __utf2euc($str)
	{
		return iconv("UTF-8", "cp949//IGNORE", $str);
	}

	function __is_ie()
	{
		if (!isset($_SERVER['HTTP_USER_AGENT'])) return false;
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) return true; // IE8
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== false) return true; // IE11
		return false;
	}

	function __upload($type)
	{
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
