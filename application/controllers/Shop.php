<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session'); // Pastikan session library dimuat
    }
    public function index()
    {
        $this->load->model('Mytas');
        $this->data['barang'] = $this->Mytas->get_all_produks();
        $data['title'] = 'Shop';
        $this->load->view('front/front_header', $data);
        $this->load->view('shop/index', $this->data);
        $this->load->view('front/front_footer');
    }
}
