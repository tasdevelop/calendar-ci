<?php

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
        session_start();
		$this->load->model('mlogin');
	}
    /**
     * Fungsi awal login
     * @AclName Login
     */
	public function index(){
        $adminId = @$_SESSION['logged_in'];
        if(!empty($adminId)){
    		redirect('home');
        }
        $error = '';
        if($this->input->server('REQUEST_METHOD') == 'POST'){
        	$data = $this->input->post();
        	$user = $this->mlogin->verifyLogin($data['userid'],$data['password']);
        	if(!empty($user)){
                $_SESSION['user'] = $user['userpk'];
                $_SESSION['userpk'] = $user['userpk'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['dashboard'] = $user['dashboard'];
                $_SESSION['versi'] ='acl';
                $_SESSION['logged_in'] = true;
        		redirect("home");
        	}else{
        		$error = 'Invalid Credentials';
        	}
        }
        $this->render('login',['error'=>$error]);
	}
    /**
     * Fungsi logout
     * @AclName Logout
     */
	public function logout(){
        session_unset();
        session_destroy();
		redirect('login');
	}
}

