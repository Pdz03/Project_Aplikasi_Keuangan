<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
		$this->load->library(['session', 'form_validation', 'pagination']);
		$this->load->helper(['url', 'form']);

		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		$config['base_url'] = site_url('transaksi/index');
		$config['total_rows'] = $this->Transaksi_model->count_all();
		$config['per_page'] = 5;
		$config['uri_segment'] = 3;

		// Styling pagination
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

		$page = ($this->uri->segment(3) !== null && ctype_digit((string)$this->uri->segment(3)))
			? (int)$this->uri->segment(3)
			: 0;

		$data['transaksi'] = $this->Transaksi_model->get_limit($config['per_page'], $page);
		$data['pagination'] = $this->pagination->create_links();

		$this->load->view('transaksi/index', $data);
	}

	public function add()
	{
		$this->_set_validation_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('transaksi/form');
		} else {
			$post = $this->input->post(NULL, true);
			$insert = [
				'tanggal' => $post['tanggal'],
				'jenis' => $post['jenis'],
				'nominal' => (float)$post['nominal'],
				'keterangan' => $post['keterangan']
			];
			$this->Transaksi_model->insert($insert);
			redirect('transaksi');
		}
	}

	public function edit($id)
	{
		$trans = $this->Transaksi_model->get($id);
		if (!$trans) show_404();

		$this->_set_validation_rules();

		if ($this->form_validation->run() == FALSE) {
			// 🔹 Tidak lagi load view form, cukup redirect agar tetap di halaman transaksi
			redirect('transaksi');
		} else {
			$post = $this->input->post(NULL, true);
			$update = [
				'tanggal' => $post['tanggal'],
				'jenis' => $post['jenis'],
				'nominal' => (float)$post['nominal'],
				'keterangan' => $post['keterangan']
			];
			$this->Transaksi_model->update($id, $update);
			redirect('transaksi');
		}
	}

	public function delete($id)
	{
		$this->Transaksi_model->delete($id);
		redirect('transaksi');
	}

	private function _set_validation_rules()
	{
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
		$this->form_validation->set_rules('jenis', 'Jenis', 'required|in_list[masuk,keluar]');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric|greater_than[0]');
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim');
	}
}
