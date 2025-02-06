<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_Barcode extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');

        // Initialize Zend library
        $this->load->library('zend');
        // Add Zend's library directory to the include path
        ini_set(
            'include_path',
            ini_get('include_path') . PATH_SEPARATOR . APPPATH . 'third_party'
        );
    }

    public function index()
    {
        $data['products'] = $this->Product_Barcode->get_all_products();
        $this->load->view('products/list', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $data = array(
                'name' => $this->input->post('name'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'barcode' => $this->generate_barcode($this->input->post('sku'))
            );

            $this->Product_Barcode->insert_product($data);
            redirect('products');
        }

        $this->load->view('products/create');
    }

    public function edit($id)
    {
        if ($this->input->post()) {
            $data = array(
                'name' => $this->input->post('name'),
                'sku' => $this->input->post('sku'),
                'price' => $this->input->post('price'),
                'barcode' => $this->generate_barcode($this->input->post('sku'))
            );

            $this->Product_Barcode->update_product($id, $data);
            redirect('products');
        }

        $data['product'] = $this->Product_Barcode->get_product($id);
        $this->load->view('products/edit', $data);
    }

    public function delete($id)
    {
        $this->Product_Barcode->delete_product($id);
        redirect('products');
    }

    private function generate_barcode($sku)
    {
        // Make sure the Barcode class exists
        require_once APPPATH . 'third_party/Zend/Barcode.php';

        // Generate barcode
        $renderOptions = array(
            'text' => $sku,
            'imageType' => 'png'
        );

        $file = Zend_Barcode::factory('code128', 'image', $renderOptions)->draw();
        $barcode_path = 'barcodes/' . $sku . '.png';

        // Save the image
        imagepng($file, FCPATH . $barcode_path);
        imagedestroy($file);

        return $barcode_path;
    }

    public function show_barcode($sku)
    {
        Zend_Barcode::render('code128', 'image', array('text' => $sku));
    }
}
