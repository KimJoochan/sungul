<?php

class Scholar_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
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

	function scholarUpdate($year,$name,$degree,$school,$grade,$local,$idx){
		$sql = "UPDATE scholarship SET year='$year',name='$name',school='$school',grade='$grade',local='$local',degree='$degree' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	function scholar_update_cnt($grade1,$grade2,$grade3,$grade4,$sum,$year){
		$sql = "UPDATE scholarship_cnt SET grade1='$grade1',grade2='$grade2',grade3='$grade3',grade4='$grade4',sum='$sum' WHERE year='$year'";
		echo $this->db->query($sql);
		//return $this->db->query($sql);
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
	function get_scholar_idx($idx){
		$sql="SELECT * FROM scholarship WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
}
