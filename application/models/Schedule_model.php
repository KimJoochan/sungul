<?php

class Schedule_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
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
	function schDelete($idx,$table){
		$sql = "DELETE FROM ".$table." WHERE idx = '$idx'";
		return $this->db->query($sql);
	}
	function schUpdate($idx,$title,$contents,$table){
		$sql = "UPDATE ".$table." SET title='$title',contents='$contents' WHERE idx='$idx'";
		return $this->db->query($sql);
	}
	function insertSche($title,$contents,$table){
		$sql = "INSERT INTO ".$table."(title,contents,regdate) VALUES('$title','$contents',now())";
		$result=$this->db->query($sql);
		return $result;
	}
	function show_schedule($idx,$table){
		$sql = "SELECT * FROM ".$table." WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
}
