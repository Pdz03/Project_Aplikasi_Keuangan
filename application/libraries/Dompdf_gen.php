<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Dompdf_gen
{
    public $dompdf;

    public function __construct()
    {
        $this->dompdf = new Dompdf();
    }
}
