<?php

class Admin extends CI_Controller {
    private $_save=array();
    private $_data = array();

    public function  __construct() {
        parent::__construct();

        if($this->session->userdata('isLoggedIn')) {
            $this->_data = $this->session->userdata('userinfo');
        } 
    }
    public function index(){
        redirect('admin/panel');
    }
    public function logout(){
        redirect('/user/logout');
    }
    public function panel(){
       if($this->session->userdata('isLoggedIn')==false){
           redirect('user/auth');
       }
       else if($this->_data['type']!='admin')
           redirect ('user');
       else
            $this->load->view('admin-panel');
    }
    public function addBook(){
       if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('author', 'Code', 'trim|required|min_length[3]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('author', 'Author', 'trim|required|min_length[3]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $data=array();
                    $data['id']="";
                    $data['title'] = $this->input->post('title');
                    $data['code'] = $this->input->post('code');
                    $data['author'] = $this->input->post('author');
                    $tmp = intval($this->input->post('type'));
                    $data['type']=(bool)$tmp;
                    $tmp = intval($this->input->post('availability'));
                    $data['availability']=(bool)$tmp;
                    $this->load->model('Bookmodel', 'b');
                    $book = $this->b->insertBook($data);
                    redirect('admin/success');
                }
            }
            else
                $this->load->view('add-book.php');
        }
    }
    public function success(){
       if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else
           $this->load->view('success.php');
    }

    public function deleteBook($book_id){
        if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else{
            $this->load->model('bookmodel','b');
            $data=$this->b->deleteBookByBookId($book_id);
            if($data)
                redirect('/admin/success');
            else
                redirect ('admin/panel');
        }
    }
    public function updateBook($book_id){
       if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('code', 'Code', 'trim|max_length[100]|xss_clean');
            $this->form_validation->set_rules('type', 'Type', 'trim|max_length[100]|xss_clean');
            $this->form_validation->set_rules('availability', 'Availability', 'trim|max_length[100]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $data=array();
                    $data['code'] = $this->input->post('code');
                    $tmp = intval($this->input->post('type'));
                    $data['type']=(bool)$tmp;
                    $tmp = intval($this->input->post('availability'));
                    $data['availability']=(bool)$tmp;
                    $this->load->model('Bookmodel', 'b');
                    $books=$this->b->updatetBookByBookId($data,$book_id);
                    if($data)
                        redirect ('/admin/success');
                    else
                        redirect ('/admin/panel');
                }
            }
            else
                $this->load->view('update-book.php');
        }
    }

    public function allBooks(){
        if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else{
           $this->load->model('Bookmodel', 'b');
           $books = $this->b->getBookList();
           $this->load->view('list.php',array('books' => $books ));
       }
    }

    public function searchBook(){
       if($this->session->userdata('isLoggedIn')==false||$this->_data['type']!='admin'){
           redirect('user/auth');
       }
       else{
           $this->load->library('form_validation');
           $this->form_validation->set_rules('title', 'title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
//            $this->form_validation->set_rules('author', 'author', 'trim|required|min_length[5]|max_length[100]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $title = $this->input->post('title');
                    $this->load->model('Bookmodel', 'b');
                    $book = $this->b->searchBookByBookTitle($title);
                    if($book){
                        $tmp= $this->session->userdata('userinfo');
                        $book['user_type']=$tmp['type'];
                        $this->load->view('show-book.php',array('books' => $book ));
                    }
                    else{
                        $a=array();
                        $tmp= $this->session->userdata('userinfo');
                        $a['user_type']=$tmp['type'];
                        $a['title']="";
                        $this->load->view('show-book.php',array('books' => $a));
                    }
                }
            }
            else
                $this->load->view('search-book.php', $this->_data);
        }
    }

    public function bookInfo($book_id){
         if($this->session->userdata('isLoggedIn')==false ||$this->_data['type']!='admin'){
            redirect('user/auth');
         }
         $book=array();
         $tmp= $this->session->userdata('userinfo');
         $this->load->model('Bookmodel', 'b');
         $book = $this->b->getBookByBookId($book_id);
         $book['user_type']=$tmp['type'];
         $this->load->view('show-book.php',array('books' => $book));
    }

    public function updateBorrower(){
        if($this->session->userdata('isLoggedIn')==false ||$this->_data['type']!='admin'){
            redirect('user/auth');
         }
        $this->load->model('Adminmodel','a');
        $status='issued';
        $borrower=$this->a->getBorrowerByStatus($status);
        $i=0;
        $c=count($borrower);
        if($borrower){
            $data=array();
            $data['status']='expired';
            $ret=0;
            $cd=getdate();
            while($i<$c){
                $tmp=$borrower[$i]['expire_date'];
                $ed=(int)($tmp[8].$tmp[9]);
                $em=(int)($tmp[5].$tmp[6]);
                if($cd['mday']>$ed && $cd['mon']>=$em){
                    
                    $ret = $this->a->updateBorrowerById($data,$borrower[$i]['id']);
                }
                $i++;
           }
           redirect('admin/success');
         }
         redirect('admin/panel');
    }

    public function preReissue(){
        if($this->session->userdata('isLoggedIn')==false ||$this->_data['type']!='admin'){
            redirect('user/auth');
         }
         else{
             $this->load->library('form_validation');
             $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[100]|xss_clean');
             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
             if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $user_name = $this->input->post('username');
                    $this->load->model('Usermodel','u');
                    $user = $this->u->getUserByUserName($user_name);
                    $this->load->model('Adminmodel','a');
                    $borrower=$this->a->getBorrowerByUserId($user['id']);
                    $i=$fine=$j=0;
                    $c=count($borrower);
                    $cd=getdate();
                    $title=array();
                    $this->load->model('Bookmodel','b');
                    while($i<$c){
                        $book=$this->b->getBookByBookId($borrower[$i]['book_id']);
                        $title[$j++]=$book['title'];
                        $tmp=$borrower[$i]['expire_date'];
                        $ed=(int)($tmp[8].$tmp[9]);
                        $em=(int)($tmp[5].$tmp[6]);
                        if($cd['mday']>$ed && $cd['mon']>=$em)
                            $fine=$fine+($cd['mday']-$ed)*3;
                        $i++;
                    }
                    $user['fine']=$fine;
                    $user['title']=$title;
                    if($borrower)
                        $this->load->view('show-user.php',array('users' => $user ));
                    else{
                        $user['id']=0;
                        $this->load->view('show-user.php',array('users' => $user ));
                    }
                }
             }
             else
                $this->load->view('search-user.php');
        }
    }

    public function reissue(){
         if($this->session->userdata('isLoggedIn')==false ||$this->_data['type']!='admin'){
            redirect('user/auth');
         }
         else{
             $this->load->library('form_validation');
             $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[100]|xss_clean');
             $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[100]|xss_clean');
             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
             if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $data=array();
                    $user_name = $this->input->post('username');
                    $title = $this->input->post('title');
                    $this->load->model('Usermodel','u');
                    $user = $this->u->getUserByUserName($user_name);
                    $this->load->model('Bookmodel','b');
                    $book=$this->b->searchBookByBookTitle($title);
                    $this->load->model('Adminmodel','a');
                    $borrower=$this->a->getBorrowerByUserIdBookId($user['id'],$book['id']);
                    $data['status']='issued';
                    $date = strtotime('+2week') ;
                    $date=date('Y-m-d H:i:s',$date);
                    $data['expire_date']=$date;
                    $ret = $this->a->updateBorrowerById($data,$borrower['id']);
                    if($ret)
                        redirect('admin/success');
                    else
                        redirect('admin/panel');
                }
             }
             else
                $this->load->view('reissue.php');
        }
    }
    public function issue(){
         if($this->session->userdata('isLoggedIn')==false ||$this->_data['type']!='admin'){
            redirect('user/auth');
         }
         else{
             $this->load->library('form_validation');
             $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[100]|xss_clean');
             $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[100]|xss_clean');
             $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
             if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $user_name = $this->input->post('username');
                    $title = $this->input->post('title');
                    $this->load->model('Usermodel','u');
                    $user = $this->u->getUserByUserName($user_name);
                    $this->load->model('Bookmodel','b');
                    $book=$this->b->searchBookByBookTitle($title);
                    if($book['availability']==true){
                        $data=array();
                        $this->load->model('Adminmodel','a');
                        $data['id']="";
                        $data['user_id']=$user['id'];
                        $data['book_id']=$book['id'];
                        $date = strtotime('now') ;
                        $date=date('Y-m-d H:i:s',$date);
                        $data['created_date']=$date;
                        $date = strtotime('+2week') ;
                        $date=date('Y-m-d H:i:s',$date);
                        $data['expire_date']=$date;
                        $data['status']='issued';
                        $borrower=$this->a->insertBorrower($data);
                        if($borrower)
                            redirect('admin/success');
                        else
                            redirect('admin/panel');
                    }
                    else
                        redirect ('admin/unsuccess');
                }
             }
             else
                $this->load->view('reissue.php');
        }
    }

    public function unsuccess(){
        $this->load->view('unsuccess.php');
    }
}