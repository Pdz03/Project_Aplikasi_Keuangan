<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Transaksi_model');
		$this->load->library('session');
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}
		$this->load->helper('url');
	}

	public function index()
	{
		// Simple form to choose bulan/tahun
		$year = $this->input->get('year') ?? date('Y');
		$month = $this->input->get('month') ?? date('m');
		$data['year'] = $year;
		$data['month'] = $month;
		$data['rekap'] = $this->Transaksi_model->get_by_month($year, $month);
		$this->load->view('laporan/index', $data);
	}

	public function export_pdf()
	{
		$year  = $this->input->get('year') ?? date('Y');
		$month = $this->input->get('month') ?? date('m');

		$data['rekap'] = $this->Transaksi_model->get_by_month($year, $month);
		$data['year']  = $year;
		$data['month'] = $month;

		// render view ke HTML
		$html = $this->load->view('laporan/pdf', $data, true);

		// load dompdf
		$this->load->library('Dompdf_gen');

		// akses pakai $this->dompdf_gen
		$this->dompdf_gen->dompdf->loadHtml($html);
		$this->dompdf_gen->dompdf->setPaper('A4', 'portrait');
		$this->dompdf_gen->dompdf->render();

		$this->dompdf_gen->dompdf->stream("laporan-{$month}-{$year}.pdf", ["Attachment" => true]);
	}

	public function export_excel()
	{
		$year = $this->input->get('year');
		$month = $this->input->get('month');

		$data['laporan'] = $this->Transaksi_model->get_by_month($year, $month);

		// Set header supaya otomatis jadi file Excel
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=laporan_{$year}_{$month}.xls");
		header("Pragma: no-cache");
		header("Expires: 0");

		// Load view excel
		$this->load->view('laporan/excel', $data);
	}
}
