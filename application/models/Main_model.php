<?php

class Main_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_notice(){
		$sql = "SELECT * FROM notice ORDER BY idx desc LIMIT 5";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_gallery(){
		$sql = "SELECT * FROM gallery ORDER BY idx desc LIMIT 4";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_oragani(){
		$sql = "SELECT * FROM executive order by seq asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_max(){
		$sql = "SELECT MAX(seq) as max FROM executive";
		$res = $this->db->query($sql)->result();
		$max = $res[0]->max;
		return $max;
	}

	function get_min(){
		$sql = "SELECT MIN(seq) as min FROM executive";
		$res = $this->db->query($sql)->result();
		$min = $res[0]->min;
		return $min;
	}

	function get_by_year($year){
		$sql = "select * from scholarship where year='$year' order by degree asc, grade asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_cnt($year){
		$sql = "select * from scholarship_cnt where year='$year'";
		$res = $this->db->query($sql)->result_array();
		return $res;
	}

	function get_by_name(){
		$sql = "SELECT * FROM sponsor order by name asc";//가나다순
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_year_schedule(){
		$sql = "SELECT * FROM year_schedule order by idx asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_month_schedule(){
		$sql = "SELECT * FROM month_schedule order by idx asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_event(){
		$sql = "SELECT * FROM event";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	//장학금 수혜자에서 쓰이는 함수
	function scholarInsert($year,$name,$degree,$school,$grade,$local){
		$this->db->set('regdate', 'NOW()', false);
		$this->db->set('year', $year);
		$this->db->set('name', $name);
		$this->db->set('school', $school);
		$this->db->set('grade', $grade);
		$this->db->set('degree', $degree);
		$this->db->set('local', $local);
		$this->db->insert('scholarship');
		return $this->db->insert_id();
	}
	function scholarDelete($idx){
		$sql = "DELETE FROM scholarship WHERE idx = '$idx'";
		return $this->db->query($sql);
	}
	function get_scholar_idx($idx){
		$sql="SELECT * FROM scholarship WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function scholarUpdate($year,$name,$degree,$school,$grade,$local,$idx){
		$sql = "UPDATE scholarship SET year='$year',name='$name',school='$school',grade='$grade',local='$local',degree='$degree' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	function scholar_update_cnt($grade1,$grade2,$grade3,$grade4,$sum,$year){
		$sql = "UPDATE scholarship_cnt SET grade1='$grade1',grade2='$grade2',grade3='$grade3',grade4='$grade4',sum='$sum' WHERE year='$year'";
		echo $sql;
		//return $this->db->query($sql);
	}
	//임원직들에서 쓰이는 함수들
	function get_max_exec(){
		$sql = "SELECT MAX(seq) as max FROM executive";
		return $this->db->query($sql)->result_array();
	}
	function insert_exec($job,$name,$phone,$max){
		$sql = "INSERT INTO executive(job,name,phone,regdate,seq) VALUES('$job','$name','$phone',now(),'$max')";
		return $this->db->query($sql);
	}
	function delete_exec($idx){
		$sql = "DELETE FROM executive WHERE idx = '$idx'";
		return $this->db->query($sql);
	}
	function get_exec_idx($idx){
		$sql = "SELECT * FROM executive WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function update_exec($idx,$job,$name,$phone){
		$sql = "UPDATE executive SET job='$job',name='$name',phone='$phone' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	function up_exec($seq1){
		$sql="SELECT * FROM executive where seq<'$seq1' order by seq desc";
		return $this->db->query($sql)->result_array();
	}
	function down_exec($seq1){
		$sql="SELECT * FROM executive where seq>'$seq1' order by seq asc";
		return $this->db->query($sql)->result_array();
	}
	function up_update_exe($seq1,$idx2){
		$sql="UPDATE executive SET seq='$seq1' where idx='$idx2'";
		return $this->db->query($sql);
	}
	function select_max_exec(){
		$sql = "SELECT MAX(seq) as max FROM executive";
		return $this->db->query($sql)->result_array();
	}
	function select_min_exec(){
		$sql = "SELECT MIN(seq) as min FROM executive";
		return $this->db->query($sql)->result_array();
	}
	function select_asc_seq(){
		$sql = "SELECT * FROM executive order by seq asc";
		return $this->db->query($sql)->result_array();
	}
	//스폰서 함수들
	function insert_sponsor($money,$name,$location){
		$sql = "INSERT INTO sponsor(money,name,location,regdate) VALUES('$money','$name','$location',now())";
		return $this->db->query($sql);
	}
	function delete_sponsor($idx){
		$sql = "DELETE FROM sponsor WHERE idx = '$idx'";
		return $this->db->query($sql);
	}
	function select_sponsor($idx){
		$sql = "SELECT * FROM sponsor WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function update_sponsor($money,$name,$location,$idx){
		$sql = "UPDATE sponsor SET money='$money',name='$name',location='$location' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	//알림방 list쓰이는 함수들 시작
	function get_count($search,$uri_var){
		if($uri_var=="notice"){
			$sql = "SELECT idx FROM notice WHERE title LIKE '%$search%'";
		}else if($uri_var=="gallery"){
			$sql = "SELECT idx FROM gallery WHERE title LIKE '%$search%'";
		}
		$res = $this->db->query($sql, array($search))->result_array();
		$count = count($res);
		return $count;
	}
	public static $list=10;

	function get_page_num($num,$uri_var){
		if($uri_var=="notice"){
			$list=10;
		}else if($uri_var=="gallery"){
			$list=6;
		}
		$pageNum = ceil($num / $list);//총 페이지수
		return $pageNum;
	}

	function s_page($page){
		//$page 파라매타 페이지 번호
		$block = 5;//블록당 페이지수
		$nowBlock = ceil($page / $block);//현재페이지 블록번호
		$s_page = ($nowBlock * $block) - ($block - 1);
		if ($s_page <= 1) {
			$s_page = 1;
		}
		return $s_page;
	}

	function e_page($pageNum, $page){
		$block = 5;//블록당 페이지수
		$nowBlock = ceil($page / $block);//현재페이지 블록번호
		$e_page = $nowBlock * $block;//5
		if ($pageNum <= $e_page) {
			$e_page = $pageNum;
		}
		return $e_page;
	}
	function s_point($page){
		$list=10;
		$s_point = ($page - 1) * $list;
		return $s_point;
	}
	function res($search,$s_point,$uri_var){
		if($uri_var=="notice"){
			$list=10;
			$sql = "SELECT * FROM notice WHERE title LIKE '%$search%' ORDER BY idx desc LIMIT $s_point , $list";
		}else if($uri_var=="gallery"){
			$list=6;
			$sql = "SELECT * FROM gallery WHERE title LIKE '%$search%' ORDER BY idx desc LIMIT $s_point , $list";;
		}
		$result = $this->db->query($sql)->result();
		return $result;
	}
	//알림방 list 출력 쓰이는 함수 끝
	// 알림방 상세보기 함수
	function get_view_alarm($idx){
		$sql ="SELECT * FROM notice WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function  get_previous_view($idx,$search){
		$sql = "SELECT * from notice where idx=(select MAX(idx) from notice where idx < $idx and title LIKE '%$search%')";
		return $this->db->query($sql)->result_array();
	}
	function  get_next_view($idx,$search){
		$sql = "SELECT * from notice where idx=(select MIN(idx) from notice where idx > $idx and title LIKE '%$search%')";
		return $this->db->query($sql)->result_array();
	}
	// 갤러리 삽입 함수
	function insertGallery($files,$title,$contents){
		$sql = "INSERT INTO gallery(title,contents,file,regdate) VALUES('$title','$contents','$files',now())";
		var_dump($sql);
		return $this->db->query($sql);
	}
	//알림 삽입
	function insertNotice($files,$title,$contents){
		$sql = "INSERT INTO notice(title,contents,file,regdate) VALUES('$title','$contents','$files',now())";
		return $this->db->query($sql);
	}
	//알림방 삭제
	function deletetNotice($idx){
		$sql = "DELETE FROM notice WHERE idx = $idx";
		$res=$this->db->query($sql);
		return $res;

	}
	function get_idx_gallery($idx){
		$sql = "SELECT * FROM gallery WHERE idx = '$idx'";
		$res=$this->db->query($sql)->result_array();
		return $res;
	}
	function get_previous_idx($idx,$search){
		$sql = "SELECT * from gallery where idx=(select MAX(idx) from gallery where idx < $idx and title LIKE '%$search%')";
		$res=$this->db->query($sql)->result_array();
		return $res;
	}
	function get_next_idx($idx,$search){
		$sql = "SELECT * from gallery where idx=(select MIN(idx) from gallery where idx > $idx and title LIKE '%$search%')";
		$res=$this->db->query($sql)->result_array();
		return $res;
	}
	//갤러리 삭제
	function delete_gallery($idx){
		$this->db->where('idx' , $idx);
		$query = $this->db->delete("gallery");
		return $query;
	}
	function update_gallery($idx,$title,$contents,$raw_name){
		$sql = "UPDATE gallery SET title='$title',contents='$contents',file='$raw_name' WHERE idx='$idx'";
		$query = $this->db->query($sql);
		return $query;
	}
	function update_noitce($idx,$title,$contents,$raw_name){
		$sql = "UPDATE notice SET title='$title',contents='$contents',file='$raw_name' WHERE idx='$idx'";
		$query = $this->db->query($sql);
		return $query;
	}
	//이벤트 관련된 함수들
	function insert_event($start,$end,$title,$des){
		$this->db->set('regdate', 'NOW()', false);
		$this->db->set('start', $start);
		$this->db->set('end', $end);
		$this->db->set('title', $title);
		$this->db->set('description', $des);
		$this->db->insert('event');
		$result = $this->db->insert_id();
		return $result;
	}
	function get_event_order_start(){
		$sql = "select * from event order by start desc";
		return $this->db->query($sql)->result_array();
	}
	function get_event_id($id){
		$sql = "SELECT * FROM event WHERE id = '$id'";
		return $this->db->query($sql)->result_array();
	}
	function eventUpdate($id,$title,$start,$end,$description){
		$sql = "UPDATE event SET title='$title',start='$start',end='$end',description='$description' WHERE id='$id'";
		return $this->db->query($sql);
	}
	function eventDelte($id){
		$sql = "DELETE FROM event WHERE id = '$id'";
		return $this->db->query($sql);
	}
	function insertSche($title,$contents,$table){
		//$sql = "INSERT INTO ".$table."(title,contents,regdate) VALUES('$title','$contents',now())";
		$this->db->set('regdate', 'NOW()', false);
		$this->db->set('title', $title);
		$this->db->set('contents', $contents);
		$this->db->insert($table);
		$result = $this->db->insert_id();
		return $result;
	}
	function show_schedule($idx,$table){
		$sql = "SELECT * FROM ".$table." WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function schUpdate($idx,$title,$contents,$table){
		$sql = "UPDATE ".$table." SET title='$title',contents='$contents' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	function schDelete($idx,$table){
		$sql = "DELETE FROM ".$table." WHERE idx = '$idx'";
		return $this->db->query($sql);
	}
}

?>
