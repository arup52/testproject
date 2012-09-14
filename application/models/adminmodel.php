<?php
class Adminmodel extends Ci_model{
    public function __construct() {
        parent::__construct();
    }

    public function searchBookByBookId($book_id){
        $query = $this->db->get_where('users',array('id' => $book_id));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }

    public function getBorrowerByStatus($status){
        $query = $this->db->get_where('borrowers',array('status' => $status));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data;
        }
        return false;
    }

    public function updateBorrowerById($data,$borrower_id){
        $this->db->where('id', $borrower_id);
        $query=$this->db->update('borrowers', $data);
        if($query)
            return true;
        return false;
    }

    public function getBorrowerByUserId($user_id){
        $query = $this->db->get_where('borrowers',array('user_id' => $user_id ));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data;
        }
        return false;
    }

    public function getBorrowerByUserIdBookId($user_id,$book_id){
        $query = $this->db->get_where('borrowers',array('user_id' => $user_id ,'book_id' => $book_id ));
        $data = $query->result_array();
        if(count($data) >0 ) {
            return $data[0];
        }
        return false;
    }

    public function insertBorrower($data){
        $query=$this->db->insert('borrowers',$data);
        return $query;
    }
}
?>
