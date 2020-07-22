<?php

class Spon_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//스폰서 함수들
	function insert_sponsor($money, $name, $location){
		$sql = "INSERT INTO sponsor(money,name,location,regdate) VALUES('$money','$name','$location',now())";
		return $this->db->query($sql);
	}

	function delete_sponsor($idx)	{
		$sql = "DELETE FROM sponsor WHERE idx = '$idx'";
		return $this->db->query($sql);
	}

	function update_sponsor($money, $name, $location, $idx){
		$sql = "UPDATE sponsor SET money='$money',name='$name',location='$location' WHERE idx='$idx'";
		return $this->db->query($sql);
	}

	function get_by_name(){
		$sql = "SELECT * FROM sponsor order by name asc";//가나다순
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function select_sponsor($idx){
		$sql = "SELECT * FROM sponsor WHERE idx = '$idx'";
		return $this->db->query($sql)->result_array();
	}
}
