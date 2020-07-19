<?php

class Main_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_notice()
	{
		$sql = "SELECT * FROM notice ORDER BY idx desc LIMIT 5";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_gallery()
	{
		$sql = "SELECT * FROM gallery ORDER BY idx desc LIMIT 4";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_oragani()
	{
		$sql = "SELECT * FROM executive order by seq asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_max()
	{
		$sql = "SELECT MAX(seq) as max FROM executive";
		$res = $this->db->query($sql)->result();
		$max = $res[0]->max;
		return $max;
	}

	function get_min()
	{
		$sql = "SELECT MIN(seq) as min FROM executive";
		$res = $this->db->query($sql)->result();
		$min = $res[0]->min;
		return $min;
	}

	function get_by_year($year)
	{
		$sql = "select * from scholarship where year='$year' order by degree asc, grade asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_cnt($year)
	{
		$sql = "select * from scholarship_cnt where year='$year'";
		$res = $this->db->query($sql)->result_array();
		return $res;
	}

	function get_by_name()
	{
		$sql = "SELECT * FROM sponsor order by name asc";//가나다순
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_year_schedule()
	{
		$sql = "SELECT * FROM year_schedule order by idx asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_month_schedule()
	{
		$sql = "SELECT * FROM month_schedule order by idx asc";
		$res = $this->db->query($sql)->result();
		return $res;
	}

	function get_event()
	{
		$sql = "SELECT * FROM event";
		$result = $this->db->query($sql)->result();
		return $result;
	}

	function get_count($search = "")
	{
		$sql = "SELECT idx FROM notice WHERE title LIKE '%$search%'";
		$res = $this->db->query($sql, array($search))->result_array();
		$count = count($res);
		$num = $count;
		return $num;
	}
	public static $list=10;

	function get_page_num($num){
		$list=10;
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

	function e_page($pageNum, $page)
	{
		$block = 5;//블록당 페이지수
		$nowBlock = ceil($page / $block);//현재페이지 블록번호
		$e_page = $nowBlock * $block;//5
		if ($pageNum <= $e_page) {
			$e_page = $pageNum;
		}
		return $e_page;
	}
	function s_point($page,$search){
		if($search!="" && $page>=2){
			$page=1;
		}
		$list=10;
		$s_point = ($page - 1) * $list;
		return $s_point;
	}
	function res($search,$s_point){
		$list=10;
		$sql = "SELECT * FROM notice WHERE title LIKE '%$search%' ORDER BY idx desc LIMIT $s_point , $list";
		$result = $this->db->query($sql)->result();
		return $result;
	}
}

?>
