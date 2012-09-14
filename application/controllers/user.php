<?php

class User extends CI_Controller {
    private $save=array();
    private $_data = array();

    public function  __construct() {
        parent::__construct();

        if($this->session->userdata('isLoggedIn')) {
            $this->_data['userinfo'] = $this->session->userdata('userinfo');
        }
        else
            $this->session->set_userdata('isAdmin',false);
    }
    public function index(){
        redirect('user/panel');
    }
    public function auth(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Username', 'alpha|trim|required|min_length[4]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if(count($_POST)>0) {            
            if($this->form_validation->run() == true) {
                $user_name = $this->input->post('user_name');
                $password = $this->input->post('password'); //
                $this->load->model('Usermodel', 'u');
                $user=$this->u->authenticate($user_name,$password);

                if($user)
                {
                    $this->session->set_userdata('isLoggedIn', true);
                    $this->session->set_userdata('userinfo', $user);
                    if($user['type']=='admin' ) {
                        $this->session->set_userdata('isAdmin', true);
                        redirect('/admin');
                    } else {
                        $this->session->set_userdata('isadmin', false);
                        redirect('/user/panel');
                    }
                } else {
                    $this->_data['loginError'] = 'Username and Password not matched';
                }
            }
        }
         $this->_data['loginError'] = '';
        $this->load->view('login.php', $this->_data);
    }
    public function logout(){
        $this->session->set_userdata('isLoggedIn',false);
        $this->session->sess_destroy();
        redirect('/user/auth');
    }
    public function profile() {
       if($this->session->userdata('isLoggedIn')==false){
           redirect('user/auth');
       } else{
            $ret=  $this->session->userdata('userinfo');
            $this->load->model('Usermodel','u');
            $user=$this->u->getUserByUserId($ret['id']);
            $this->load->view('profile.php',array('user'=>$user));
       }
    }
    public function panel(){
        if($this->session->userdata('isLoggedIn')==false){
           redirect('user/auth');
       }
       else if($this->session->userdata('isAdmin'))
           redirect ('admin');
       else{
           $this->load->view('user-panel.php',$this->_data);
       }
    }
    public function myBooks(){
        if($this->session->userdata('isLoggedIn')==false){
           redirect('user/auth');
       }
       else{
           $this->load->model('Usermodel', 'u');
           $user_info=$this->session->userdata('userinfo');
           $user_id=$user_info['id'];
           $user_books=$this->u->getUserBooksIdByUserId($user_id);
           $books=array();
           $i=0;
           $this->load->model('Bookmodel', 'b');
           $c=count($user_books);
           if($user_books){
               $fine=0;
                while($i<$c){
                    $books[$i] = $this->b->getBookByBookId($user_books[$i]['book_id']);
                    if($user_books[$i]['status']=='expired'){
                        $cd=getdate();
                        $tmp=$user_books[$i]['expire_date'];
                        $ed=(int)($tmp[8].$tmp[9]);
                        if($cd['mday']>$ed)
                            $fine=$fine+($cd['mday']-$ed)*3;
                    }
                    $books[$i]['status']=$user_books[$i]['status'];
                    $i++;
                }
                $books[0]['fine']=$fine;
           }
           $this->load->view('my-books.php',array('books' => $books ));
       }
    }
    public function allBooks(){
        if($this->session->userdata('isLoggedIn')==false){
           redirect('user/auth');
       }
       else{
           $this->load->model('Bookmodel', 'b');
           $books = $this->b->getBookList();
           $this->load->view('list.php',array('books' => $books ));
       }
    }
    public function searchBook(){
       if($this->session->userdata('isLoggedIn')==false){
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
         if($this->session->userdata('isLoggedIn')==false){
            redirect('user/auth');
         }
         $book=array();
         $tmp= $this->session->userdata('userinfo');
         $this->load->model('Bookmodel', 'b');
         $book = $this->b->getBookByBookId($book_id);
         $book['user_type']=$tmp['type'];
         $this->load->view('show-book.php',array('books' => $book));
    }

    public function userRegistration(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'User Name', 'trim|required|min_length[3]|max_length[100]|xss_clean'|'callback_username_check');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[100]|xss_clean');
        //$this->form_validation->set_rules('type', 'Type', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if(count($_POST)>0) {
            if($this->form_validation->run() == true) {
                $this->load->model('Usermodel', 'u');
                $data=array();
                $data['id']="";
                if($this->input->post('username') && $this->input->post('password')){
                    $data['username'] = $this->input->post('username');
                    $data['first_name'] = $this->input->post('first_name');
                    $data['last_name'] = $this->input->post('last_name');
                    $data['password'] = md5($this->input->post('password'));
                    $selected_radio = $this->input->post('type');
                    if($selected_radio == 'student')
                        $data['type'] = 'student';
                    else
                        $data['type'] = 'admin';
                    $date = strtotime('now') ;
                    $date=date('Y-m-d H:i:s',$date);
                    $data['created_date']=$date;
                    $this->load->model('Usermodel', 'u');
                    $user = $this->u->insertUser($data);
                    if($user){
                        $tmp=$this->u->getNumberOfRows();
                        $data['id']=$tmp;
                        $this->session->set_userdata('isLoggedIn', true);
                        $this->session->set_userdata('userinfo', $data);
                        if($data['type']=='admin' ) {
                            $this->session->set_userdata('isAdmin', true);
                            redirect('/admin');
                        }
                        else {
                            $this->session->set_userdata('isadmin', false);
                            redirect('/user/panel');
                        }
                    }
                }
                else
                    redirect('user/userRegistration');
            }
            else
                redirect ('user/userRegistration');
        }
        else
            $this->load->view('user-registration.php');
    }

    public function username_check($str)
    {
        $this->load->model('Username','u');
        if ($this->u->checkDuplicate($str))
        {
            $this->form_validation->set_message('username_check', 'This username already taken. Please try another');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function userUpdateProfile(){
        if($this->session->userdata('isLoggedIn')==false){
            redirect('user/auth');
         }
         else{
            $this->load->library('form_validation');
            $this->form_validation->set_rules('username', 'User Name', 'trim|min_length[3]|max_length[100]|xss_clean'|'callback_username_check');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|min_length[3]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|min_length[3]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            if(count($_POST)>0) {
                if($this->form_validation->run() == true) {
                    $this->load->model('Usermodel', 'u');
                    $data=array();
                    if($this->input->post('username'))
                        $data['username'] = $this->input->post('username');
                    if($this->input->post('first_name'))
                        $data['first_name'] = $this->input->post('first_name');
                    if($this->input->post('last_name'))
                        $data['last_name'] = $this->input->post('last_name');
                    if($this->input->post('password'))
                        $data['password'] = md5($this->input->post('password'));
                    $ret=$this->session->userdata('userinfo');
                    $user = $this->u->updateUserByUserId($data,$ret['id']);
                    if($user){
                        redirect('user/profile');
                    }
                    else
                        redirect ('user/userUpdateProfile');
               }
               else{
                   redirect ('user/userUpdateProfile');
               }
            }
            $this->load->view('update-profile.php');
         }
    }

}

?>