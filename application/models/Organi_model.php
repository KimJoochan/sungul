<?php
class Organi_model extends CI_Model{
	//임원직들에서 쓰이는 함수들
	function __construct()
	{
		parent::__construct();
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
	function get_exec_idx($idx){
		$sql = "SELECT * FROM executive WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
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
}
