<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_pusher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product_model');
    }

    function index()
    {
        $this->load->view('product_view');
    }

    function get_product()
    {
        $data = $this->product_model->get_product()->result();
        echo json_encode($data);
    }

    function create()
    {
        $product_name = $this->input->post('product_name', TRUE);
        $product_price = $this->input->post('product_price', TRUE);
        $this->product_model->insert_product($product_name, $product_price);

        require_once(APPPATH . 'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '21c71616d90119b9276f', //ganti dengan App_key pusher Anda
            'dc7dd3e77b797f48ca0f', //ganti dengan App_secret pusher Anda
            '1932005', //ganti dengan App_key pusher Anda
            $options
        );

        $data['message'] = 'success';
        $pusher->trigger('test-pusher', 'my-event', $data);
    }

    function update()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $product_name = $this->input->post('product_name', TRUE);
        $product_price = $this->input->post('product_price', TRUE);
        $this->product_model->update_product($product_id, $product_name, $product_price);

        require_once(APPPATH . 'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '21c71616d90119b9276f', //ganti dengan App_key pusher Anda
            'dc7dd3e77b797f48ca0f', //ganti dengan App_secret pusher Anda
            '1932005', //ganti dengan App_key pusher Anda
            $options
        );

        $data['message'] = 'success';
        $pusher->trigger('test-pusher', 'my-event', $data);
    }

    function delete()
    {
        $product_id = $this->input->post('product_id', TRUE);
        $this->product_model->delete_product($product_id);

        require_once(APPPATH . 'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '21c71616d90119b9276f', //ganti dengan App_key pusher Anda
            'dc7dd3e77b797f48ca0f', //ganti dengan App_secret pusher Anda
            '1932005', //ganti dengan App_key pusher Anda
            $options
        );

        $data['message'] = 'success';
        $pusher->trigger('test-pusher', 'my-event', $data);
    }
}
