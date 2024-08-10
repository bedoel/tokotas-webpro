<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $role = $this->id = $this->session->userdata('role');

        if ($role == 'admin') {
            // Dapatkan jumlah orderan hari ini
            $data['order_today'] = $this->orderm->get_orders_today();

            // Dapatkan jumlah total orderan
            $data['total_orders'] = $this->orderm->get_total_orders();
            $data['today_earnings'] = $this->orderm->getTodayEarnings();
            $data['total_earnings'] = $this->orderm->getTotalEarnings();

            $data['title'] = 'Dashboard';
            // Muat view untuk dashboard
            $this->load->view('templates/auth_header', $data);
            $this->load->view('home/dashboard', $data);
            $this->load->view('templates/auth_footer');
        } else {
            redirect(base_url('home'));
        }
    }
}
