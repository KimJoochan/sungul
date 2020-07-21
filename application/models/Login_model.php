<?php

class Login_model extends CI_Model{
    function __construct(){
		parent::__construct();
    }
    function loginAction($id,$pwd){
      $obj=  new \stdClass();
      $obj ->result="no";
      $sql = "select * from members where id='$id' and password='$pwd'";
      $res = $this->db->query($sql)->result_array();
      if(count($res)==1){
        $_SESSION['id'] = $id;
         $obj->result="ok";
       }else{
         $obj->result="no";
       }
      return $obj;
      }
    function logout(){
      if(session_destroy()){
        return "logout";
      }

    }
  }
?>