<?php
class Event_model extends  CI_Model{
	function __construct()
	{
		parent::__construct();
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
	function get_event(){
		$sql = "SELECT * FROM event";
		$result = $this->db->query($sql)->result();
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
}
