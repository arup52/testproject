<?php

class Bookmodel extends CI_Model{

    function  __construct() {
        parent::__construct();
    }

    function getBookList(){
        $query = $this->db->get('books');
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data;
        }
        return false;
    }
    public function deleteBookByBookId($book_id){
        $query = $this->db->delete('books', array('id' => $book_id));
        if($query)
            return true;
        return false;
    }
    public function searchBookByBookTitle($book_title){
        $query = $this->db->get_where('books',array('title' => $book_title));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }
    public function insertBook($data){
         $query = $this->db->insert('books',$data);
         if($query)
            return true;
        return false;
    }
    public function updatetBookByBookId($data,$book_id){
        $this->db->where('id', $book_id);
        $query=$this->db->update('books', $data);
        if($query)
            return true;
        return false;
    }
    public function getBookByBookId($book_id){
        $query = $this->db->get_where('books',array('id' => $book_id));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }
}