<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session'); // Pastikan session library dimuat
        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }
    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }
        $data['title'] = 'Keranjang Belanja';
        $this->load->view('front/front_header', $data);
        $this->load->view('cart/cart');
        $this->load->view('front/front_footer');
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('harga'),
            'name'    => $this->input->post('nama'),
            'gambar'    => $this->input->post('gambar')
        );

        $this->cart->insert($data);
        redirect($redirect_page, 'refresh');
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('cart');
    }
    public function clear()
    {
        $this->cart->destroy();
        redirect('cart');
    }

    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $item) {
            $data = array(
                'rowid' => $item['rowid'],
                'qty' => $this->input->post($i . '[qty]')
            );
            $this->cart->update($data);
            $i++;
        }
        redirect('cart');
    }
}
