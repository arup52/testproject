<?php

class Usermodel extends CI_Model{
   
    function  __construct() {
        parent::__construct();
    }
    function authenticate($user_name,$password){
        $query = $this->db->get_where('users', array('username' => $user_name, 'password' => md5($password)));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }
    
    function getUserBooksIdByUserId($user_id){
        $query = $this->db->get_where('borrowers', array('user_id' => $user_id));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data;
        }
        return false;
    }

    function getUserByUserName($user_name){
        $query = $this->db->get_where('users', array('username' => $user_name));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }

    function getUserByUserId($user_id){
        $query = $this->db->get_where('users', array('id' => $user_id));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }

    function insertUser($data){
        $query = $this->db->insert('users',$data);
         if($query)
            return true;
        return false;
    }

    function   checkDuplicate($str){
        $query = $this->db->get_where('users', array('username' => $str));
        if($query)
            return true;
        else
            return FALSE;
    }

    public function updateUserByUserId($data,$user_id){
            $this->db->where('id', $user_id);
            $query=$this->db->update('users', $data);
        if($query)
            return true;
        return false;
    }

    public function getNumberOfRows(){
        return $this->db->count_all('users');
    }
}