<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
		$this->load->library('session');
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}
		$this->load->helper(array('url', 'form'));
	}

	public function index()
	{
		$this->load->library('pagination');

		$config['base_url'] = site_url('transaksi/index');
		$config['total_rows'] = (int)$this->Transaksi_model->count_all();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;

		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['attributes'] = ['class' => 'page-link'];

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? (int)$this->uri->segment(3) : 0;
		$data['transaksi'] = $this->Transaksi_model->get_limit($config['per_page'], $page);
		$this->load->view('transaksi/index', $data);
	}

	public function add()
	{
		if ($this->input->post()) {
			$post = $this->input->post(NULL, true);
			// Basic validation (TODO: buat form validation rules yang lebih ketat)
			if (empty($post['tanggal']) || empty($post['jenis']) || !isset($post['nominal'])) {
				$data['error'] = 'Semua field wajib diisi.';
				$this->load->view('transaksi/form', $data);
				return;
			}
			$insert = [
				'tanggal' => $post['tanggal'],
				'jenis' => $post['jenis'],
				'nominal' => (float)$post['nominal'],
				'keterangan' => $post['keterangan']
			];
			$this->Transaksi_model->insert($insert);
			redirect('transaksi');
		} else {
			$this->load->view('transaksi/form');
		}
	}

	public function edit($id)
	{
		$trans = $this->Transaksi_model->get($id);
		if (!$trans) show_404();
		if ($this->input->post()) {
			$post = $this->input->post(NULL, true);
			$update = [
				'tanggal' => $post['tanggal'],
				'jenis' => $post['jenis'],
				'nominal' => (float)$post['nominal'],
				'keterangan' => $post['keterangan']
			];
			$this->Transaksi_model->update($id, $update);
			redirect('transaksi');
		} else {
			$data['transaksi'] = $trans;
			$this->load->view('transaksi/form', $data);
		}
	}

	public function delete($id)
	{
		$this->Transaksi_model->delete($id);
		redirect('transaksi');
	}
}
