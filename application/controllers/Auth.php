<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function index(){
        redirect('auth/login');
    }

    public function __construct(){
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
        $this->load->helper(array('url','form'));
    }

    public function login(){
        if($this->input->post()){
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $user = $this->User_model->get_by_username($username);
            if($user && password_verify($password, $user->password)){
                $this->session->set_userdata(['user_id'=>$user->id, 'username'=>$user->username]);
                redirect('dashboard');
            } else {
                $data['error'] = 'Username atau password salah.';
                $this->load->view('auth/login', $data);
            }
        } else {
            $this->load->view('auth/login');
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
