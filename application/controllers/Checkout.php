<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends MY_Controller
{
    private $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Mycheckout');
        $this->id = $this->session->userdata('user_id');

        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }
        $data['title'] = 'Checkout';
        $this->load->view('front/front_header', $data);
        $this->load->view('checkout/index');
        $this->load->view('front/front_footer');
    }

    /**
     * Fungsi ini memasukan suatu pesanan ke tabel 'orders' 
     * dan memindahkan list cart user ke 'order_detail'
     */
    public function create()
    {
        if (!$_POST) {
            redirect(base_url('checkout'));
        }

        // Memeriksa stok barang sebelum proses checkout dimulai
        foreach ($this->cart->contents() as $item) {
            $barang = $this->Mycheckout->getById('barang', ['kd_barang' => $item['id']]);
            if (!$barang || $barang->stok_barang < $item['qty']) {
                echo '<script>alert("Stok barang ' . $item['name'] . ' tidak mencukupi."); window.location.href = "' . base_url('checkout') . '";</script>';
                exit;
            }
        }

        $name = $this->input->post('name');
        $alamat = $this->input->post('alamat');
        $hp = $this->input->post('hp');


        // Menyiapkan insert table orders
        $data = [
            'id_user'   => $this->id,
            'tanggal'      => date('Y-m-d'),
            'invoice'   => $this->id . date('YmdHis'),
            'total'     => $this->cart->total(),
            'nama'      => $name,
            'alamat'   => $alamat,
            'hp'    => $hp,
            'status'    => 'waiting'
        ];

        $this->db->trans_start();

        $order_id = $this->mycheckout->simpan('orders', $data);

        foreach ($this->cart->contents() as $item) {
            $order_detail = [
                'id_orders' => $order_id,
                'kd_barang' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ];
            $this->mycheckout->simpan('order_detail', $order_detail);

            // kurangi stok barang
            $barang = $this->mycheckout->getById('barang', ['kd_barang' => $item['id']]);
            $new_stock = $barang->stok_barang - $item['qty'];
            $this->Mycheckout->updateChekout(['kd_barang' => $item['id']], ['stok_barang' => $new_stock], 'barang');
        }
        $this->db->trans_complete();

        $this->cart->destroy();
        $this->data['data'] = $data;
        $this->load->view('front/front_header');
        $this->load->view('checkout/success', $this->data);
        $this->load->view('front/front_footer');
    }
}

/* End of file Checkout.php */
