<?php defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('dompdf');
        $this->load->model('orderm');
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect('home');
        }
    }

    public function index()
    {
        // Fetch data from the database
        $data['orders'] = $this->orderm->get_all_orders();
        $data['pendapatan_hari_ini'] = $this->orderm->getTodayEarnings();
        $data['total_pendapatan'] = $this->orderm->getTotalEarnings();

        // Load view and pass the data
        $html = $this->load->view('laporan/laporan_pdf', $data, true);

        // Create PDF file
        pdf_create($html, 'laporan_pesanan');
    }
}
