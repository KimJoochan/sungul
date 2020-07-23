<?php

class Template{
	function header(){
		$ci=&get_instance();
		$ci->load->view('/common/header');
		$ci->load->view('/common/nav');
	}
	function scheduInsert($arg = "", $par = "")	{
		$ci=&get_instance();
		$ci->load->view("/info/sche_com");
		$ci->load->view("/common/locationBar");
		$ci->load->view($arg, $par);
	}
	function infoInsert($arg)	{
		$ci=&get_instance();
		$ci->load->view("/info/info_com");
		$ci->load->view("/common/locationBar");
		$ci->load->view($arg);
	}
	function dalma($arg){
		$ci=&get_instance();
		$ci->load->view("/info/dalm_1");
		$ci->load->view("/common/locationBar");
		$ci->load->view($arg);
	}
}

?>
