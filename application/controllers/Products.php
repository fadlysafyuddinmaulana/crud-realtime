<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->helper('url');
        $this->load->library('ciqrcode');
    }

    private function generate_qr($code)
    {
        // Create directory if not exists
        if (!file_exists(FCPATH . 'qrcodes')) {
            mkdir(FCPATH . 'qrcodes', 0777, true);
        }

        $qr_image = 'qrcodes/qr_' . $code . '.png';
        $params['data'] = $code;
        $params['save_path'] = FCPATH . $qr_image;

        $this->ciqrcode->generate($params);

        return $qr_image;
    }

    public function index()
    {
        $data['products'] = $this->product_model->get_all_products();
        $this->load->view('products/index', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            try {
                $qr_path = $this->generate_qr($this->input->post('sku'));

                $data = array(
                    'name' => $this->input->post('name'),
                    'sku' => $this->input->post('sku'),
                    'price' => $this->input->post('price'),
                    'barcode' => $qr_path  // We'll store QR path in barcode field
                );

                $this->product_model->insert_product($data);
                redirect('products');
            } catch (Exception $e) {
                $this->session->set_flashdata('error', $e->getMessage());
                redirect('products/create');
            }
        }

        $this->load->view('products/create');
    }

    public function test_qr()
    {
        try {
            // Test QR generation
            $test_path = FCPATH . 'qrcodes/test.png';
            $params['data'] = "Test QR Code";
            $params['save_path'] = $test_path;

            if ($this->ciqrcode->generate($params)) {
                echo "QR Code generated successfully at: qrcodes/test.png";
            } else {
                echo "Failed to generate QR Code";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
