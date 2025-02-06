<?php
defined('BASEPATH') or exit('No direct script access allowed'); {
    class Zend
    {
        public function __construct()
        {
            include_once APPPATH . 'third_party/Zend/Barcode.php';
        }

        public function load($class)
        {
            include_once APPPATH . 'third_party/' . str_replace('_', '/', $class) . '.php';
        }
    }
}
