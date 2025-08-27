<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_gen
{
    public $dompdf;

    public function __construct()
    {
        // load autoload Composer
        require_once FCPATH . 'vendor/autoload.php';

        // set opsi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // biar bisa load asset/gambar eksternal
        $options->set('defaultFont', 'DejaVu Sans'); // font default support UTF-8

        // buat instance Dompdf
        $this->dompdf = new Dompdf($options);
    }
}
