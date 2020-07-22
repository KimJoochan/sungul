<?php
class Notice_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
	}
	//알림방 list 출력 쓰이는 함수 끝

	function  get_previous_view($idx,$search){
		$sql = "SELECT * from notice where idx=(select MAX(idx) from notice where idx < $idx and title LIKE '%$search%')";
		return $this->db->query($sql)->result_array();
	}
	// 알림방 상세보기 함수
	function get_view_alarm($idx){
		$sql ="SELECT * FROM notice WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
	function  get_next_view($idx,$search){
		$sql = "SELECT * from notice where idx=(select MIN(idx) from notice where idx > $idx and title LIKE '%$search%')";
		return $this->db->query($sql)->result_array();
	}
	//알림 삽입
	function insertNotice($files,$title,$contents){
		$sql = "INSERT INTO notice(title,contents,file,regdate) VALUES('$title','$contents','$files',now())";
		return $this->db->query($sql);
	}
	function get_notice(){
		$sql = "SELECT * FROM notice ORDER BY idx desc LIMIT 5";
		$res = $this->db->query($sql)->result();
		return $res;
	}
	//알림방 삭제
	function deletetNotice($idx){
		$sql = "DELETE FROM notice WHERE idx = $idx";
		$res=$this->db->query($sql);
		return $res;

	}
	function update_noitce($idx,$title,$contents,$raw_name){
		$sql = "UPDATE notice SET title='$title',contents='$contents',file='$raw_name' WHERE idx='$idx'";
		$query = $this->db->query($sql);
		return $query;
	}
}
