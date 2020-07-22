<?php
class Gallery_model extends CI_Model{
	function __construct(){
		parent::__construct();
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
	// 갤러리 삽입 함수
	function insertGallery($files,$title,$contents){
		$sql = "INSERT INTO gallery(title,contents,file,regdate) VALUES(?,?,?,now())";
		return $this->db->query($sql,array($title,$contents,$files));
	}
	//갤러리 삭제
	function delete_gallery($idx){
		$this->db->where('idx' , $idx);
		$query = $this->db->delete("gallery");
		return $query;
	}
	function update_gallery($idx,$title,$contents,$raw_name){
		$sql = "UPDATE gallery SET title=?,contents=?,file=? WHERE idx=?";
		$query = $this->db->query($sql,array($title,$contents,$raw_name,$idx));
		return $query;
	}

	function get_gallery(){
		$sql = "SELECT * FROM gallery ORDER BY idx desc LIMIT 4";
		$res = $this->db->query($sql)->result();
		return $res;
	}
}
