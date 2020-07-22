<?php
class Common_model extends CI_Model{
	function __construct()
	{
		parent::__construct();
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
}
