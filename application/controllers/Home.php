<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('username')) {
            $remember_me = $this->input->cookie('remember_me');
            if ($remember_me) {
                $this->session->set_userdata('username', $remember_me);
            }
        }
    }
    public function index()
    {
        $this->load->model('Mytas');
        $this->data['barang'] = $this->Mytas->get_all_produks();
        $data['title'] = 'Home';
        $this->load->view('front/front_header', $data);
        $this->load->view('home/home', $this->data);
        $this->load->view('front/front_footer');
    }
}
