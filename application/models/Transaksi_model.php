<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    protected $table = 'transaksi';
    protected $db; // property untuk database (bisa di-inject)

    public function __construct($db = null)
    {
        parent::__construct();

        // Kalau testing: pakai $db dari luar
        // Kalau normal: tetap pakai database default
        $this->db = $db ?? $this->load->database('default', TRUE);
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function get_all()
    {
        return $this->db->order_by('tanggal', 'DESC')->get($this->table)->result();
    }

    public function get_by_month($year, $month)
    {
        $this->db->where("YEAR(tanggal)", $year);
        $this->db->where("MONTH(tanggal)", $month);
        return $this->db->order_by('tanggal', 'ASC')->get($this->table)->result();
    }

    public function get_monthly_summary($year, $month)
    {
        $pemasukan = (float) $this->db
            ->select_sum('nominal')
            ->where(['jenis' => 'masuk'])
            ->where("YEAR(tanggal)", $year)
            ->where("MONTH(tanggal)", $month)
            ->get($this->table)
            ->row()
            ->nominal ?? 0;

        $pengeluaran = (float) $this->db
            ->select_sum('nominal')
            ->where(['jenis' => 'keluar'])
            ->where("YEAR(tanggal)", $year)
            ->where("MONTH(tanggal)", $month)
            ->get($this->table)
            ->row()
            ->nominal ?? 0;

        return ['pemasukan' => $pemasukan, 'pengeluaran' => $pengeluaran];
    }

    public function count_all()
    {
        return (int) $this->db->count_all($this->table);
    }

    public function get_limit($limit, $start)
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->get($this->table, $limit, $start)->result();
    }

    // Kamu bisa menambahkan method tambahan (filter, pagination, optimasi) di sini
}
