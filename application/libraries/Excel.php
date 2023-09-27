<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
require_once dirname(__FILE__) . '/phpexcel/PHPExcel.php';
 
class Excel extends PHPExcel{
    public function __construct() {
        parent::__construct();
    }
}
