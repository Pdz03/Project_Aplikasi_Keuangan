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
        require_once APPPATH . '../vendor/autoload.php';

        // set opsi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); 
        $options->set('defaultFont', 'DejaVu Sans'); 
 
        // buat instance Dompdf
        $this->dompdf = new Dompdf($options);
    }
}
  