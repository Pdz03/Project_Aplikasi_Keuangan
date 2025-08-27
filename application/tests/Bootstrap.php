<?php
// application/tests/Bootstrap.php

// 1️⃣ Definisikan path dasar
defined('BASEPATH') OR define('BASEPATH', realpath(__DIR__ . '/..') . '/');
defined('APPPATH')   OR define('APPPATH', BASEPATH . 'application/');
defined('FCPATH')    OR define('FCPATH', BASEPATH);

// 2️⃣ Set environment testing
defined('ENVIRONMENT') OR define('ENVIRONMENT', 'testing');
$_SERVER['CI_ENV'] = 'testing';

// 3️⃣ Load database config
// Load database config
require_once dirname(BASEPATH) . '/application/config/database.php';
global $db, $active_group;


// 4️⃣ Pastikan database testing ada
if (!isset($db['testing'])) {
    die("Database testing belum dikonfigurasi di application/config/database.php");
}

// 5️⃣ Pakai database testing sebagai active group
$active_group = 'testing';

// 6️⃣ Tentukan path ke folder system
$system_path = dirname(APPPATH) . '/system/';

// 7️⃣ Load fungsi-fungsi inti CI
require_once $system_path . 'core/Common.php';
require_once $system_path . 'database/DB.php';

// 8️⃣ Buat class CI minimal untuk PHPUnit
class CI_Test {
    public $db;    // instance database
    public $load;  // loader minimal

    public function __construct() {
        global $db;

        // Loader minimal untuk autoload model
        $this->load = new class {
            public function model($name) {
                $path = APPPATH . "models/{$name}.php";
                if (!file_exists($path)) {
                    die("Model {$name} tidak ditemukan di folder models");
                }
                require_once $path;
            }
        };

        // Inisialisasi database testing via helper DB()
        $this->db = DB($db['testing']);
    }
}

// 9️⃣ Global CI instance
$CI = new CI_Test();

// 10️⃣ Contoh load model yang diuji
$CI->load->model('Transaksi_model');

// 🔹 Sekarang $CI->db dan model siap digunakan untuk PHPUnit
