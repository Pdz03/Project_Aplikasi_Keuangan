<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        if(!$this->session->userdata('user_id')){
            redirect('auth/login');
        }
        $this->load->model('Transaksi_model');
        $this->load->helper('url');
    }

    public function index(){
        $data = [];
        // TODO: show summary cards (total pemasukan bulan ini, total pengeluaran bulan ini)
        $data['summary'] = $this->Transaksi_model->get_monthly_summary(date('Y'), date('m'));
        $this->load->view('dashboard/index', $data);
    }
}
