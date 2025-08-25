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
		$config['total_rows'] = $this->Transaksi_model->count_all();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;

		// Styling
		$config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
		$config['full_tag_close'] = '</ul></nav>';

		$config['first_link'] = '«';
		$config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['first_tag_close'] = '</span></li>';

		$config['last_link'] = '»';
		$config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['last_tag_close'] = '</span></li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_tag_close'] = '</span></li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_tag_close'] = '</span></li>';

		$config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] = '</span></li>';

		$config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] = '</span></li>';

		$this->pagination->initialize($config);

		// Fix ctype_digit null warning
		$page = ($this->uri->segment(3) !== null && ctype_digit((string)$this->uri->segment(3)))
			? (int)$this->uri->segment(3)
			: 0;

		$data['transaksi'] = $this->Transaksi_model->get_limit($config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();

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
