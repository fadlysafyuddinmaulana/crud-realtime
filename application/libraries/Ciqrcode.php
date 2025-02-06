<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party\phpqrcode\qrlib.php';

class Ciqrcode
{
    public function generate($params)
    {
        if (isset($params['save_path']) && isset($params['data'])) {
            QRcode::png(
                $params['data'],
                $params['save_path'],
                QR_ECLEVEL_H,
                10,
                2
            );
            return true;
        }
        return false;
    }
}
