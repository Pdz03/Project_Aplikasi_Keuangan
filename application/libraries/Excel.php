<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// include inti PHPExcel dari folder Classes
require_once APPPATH.'third_party/PHPExcel/Classes/PHPExcel.php';

class Excel extends PHPExcel {
    public function __construct() { parent::__construct(); }
}
