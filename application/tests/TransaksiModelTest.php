<?php
use PHPUnit\Framework\TestCase;

class TransaksiModelTest extends TestCase
{
    protected $CI;
    protected $model;

    protected function setUp(): void
    {
        // Gunakan global CI instance dari Bootstrap.php
        global $CI;

        $this->CI = $CI;

        // Load model (Bootstrap.php sudah include Transaksi_model)
        $this->model = new Transaksi_model($this->CI->db);
    }

    public function testInsertAndGet()
    {
        $data = [
            'tanggal'    => '2025-08-26',
            'jenis'      => 'masuk',
            'nominal'    => 100000,
            'keterangan' => 'Test pemasukan'
        ];

        $insertId = $this->model->insert($data);
        $this->assertIsInt($insertId);

        $row = $this->model->get($insertId);
        $this->assertEquals('masuk', $row->jenis);
        $this->assertEquals(100000, $row->nominal);
    }

    public function testUpdate()
    {
        $data = [
            'tanggal'    => '2025-08-26',
            'jenis'      => 'keluar',
            'nominal'    => 50000,
            'keterangan' => 'Test pengeluaran awal'
        ];

        $insertId = $this->model->insert($data);

        $updateData = ['nominal' => 75000, 'keterangan' => 'Update test'];
        $result = $this->model->update($insertId, $updateData);

        $this->assertTrue($result);

        $row = $this->model->get($insertId);
        $this->assertEquals(75000, $row->nominal);
        $this->assertEquals('Update test', $row->keterangan);
    }

    public function testDelete()
    {
        $data = [
            'tanggal'    => '2025-08-26',
            'jenis'      => 'masuk',
            'nominal'    => 25000,
            'keterangan' => 'Delete test'
        ];

        $insertId = $this->model->insert($data);

        $result = $this->model->delete($insertId);
        $this->assertTrue($result);

        $row = $this->model->get($insertId);
        $this->assertNull($row);
    }

    public function testGetByMonthAndSummary()
    {
        $year  = 2025;
        $month = 8;

        $this->model->insert([
            'tanggal'    => "$year-$month-01",
            'jenis'      => 'masuk',
            'nominal'    => 100000,
            'keterangan' => 'Test pemasukan bulan'
        ]);

        $this->model->insert([
            'tanggal'    => "$year-$month-05",
            'jenis'      => 'keluar',
            'nominal'    => 50000,
            'keterangan' => 'Test pengeluaran bulan'
        ]);

        $result = $this->model->get_by_month($year, $month);
        $this->assertNotEmpty($result);

        $summary = $this->model->get_monthly_summary($year, $month);
        $this->assertEquals(100000, $summary['pemasukan']);
        $this->assertEquals(50000, $summary['pengeluaran']);
    }

    public function testCountAllAndLimit()
    {
        $total = $this->model->count_all();
        $this->assertIsInt($total);

        $rows = $this->model->get_limit(5, 0);
        $this->assertIsArray($rows);
    }
}
