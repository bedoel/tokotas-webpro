<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Myorder extends CI_Controller
{
    private $id;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->library('session');
        $this->load->model('Myorders');
        $this->id = $this->session->userdata('user_id');

        if (!$this->session->userdata('user_id')) {
            redirect('auth');
        }
    }

    public function index()
    {
        $userId = $this->session->userdata('user_id');
        $this->data['myorder'] = $this->Myorders->getMyorders($userId);
        $this->data['no'] = 1;
        $this->data['title'] = 'My Order';
        $this->load->view('front/front_header', $this->data);
        $this->load->view('myorder/index', $this->data);
        $this->load->view('front/front_footer');
    }

    /**
     * Untuk melihat detail dari suatu order
     */
    public function detail($invoice)
    {
        $data['order'] = $this->Myorders->getInvoice($invoice);

        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect(base_url('myorder'));
        }
        if ($data['order']->id_user != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('myorder'));
        }

        $data['order_detail'] = $this->Myorders->getOrderDetails($data['order']->id);

        if ($data['order']->status !== 'waiting') {
            $data['order_confirm'] = $this->Myorders->getOrderConfirmation($data['order']->id);
        }
        $data['title'] = 'Detail Pesanan';
        $this->load->view('front/front_header', $data);
        $this->load->view('myorder/detail', $data);
        $this->load->view('front/front_footer');
    }

    /**
     * Untuk melakukan konfirmasi pembayaran
     */
    public function confirm($invoice)
    {
        $data['order'] = $this->Myorders->getInvoice($invoice);

        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect('myorder');
        }

        if ($this->input->post()) {
            // Lakukan validasi input
            $this->load->library('form_validation');
            $this->form_validation->set_rules('nama_rek', 'Nama Rekening', 'required');
            $this->form_validation->set_rules('no_rek', 'Nomor Rekening', 'required');
            $this->form_validation->set_rules('nominal', 'Nominal', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
                // Upload gambar
                $config['upload_path'] = './assets/img/upload/';
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '3000';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('gambar_bukti')) {
                    $upload_data = $this->upload->data();
                    $gambar = $upload_data['file_name'];

                    // Simpan data konfirmasi ke database
                    $confirm_data = [
                        'id_orders' => $data['order']->id,
                        'nama_rek' => $this->input->post('nama_rek'),
                        'no_rek' => $this->input->post('no_rek'),
                        'nominal' => $this->input->post('nominal'),
                        'note' => $this->input->post('note'),
                        'gambar_bukti' => $gambar
                    ];
                    $this->Myorders->simpan('orders_confirm', $confirm_data);

                    // Update status order di tabel orders
                    $this->Myorders->updateOrderStatus($data['order']->id, 'paid');

                    echo "<script>
                        alert('Pembayaran berhasil dikonfirmasi');
                        window.location.href = '" . base_url('myorder/detail/' . $invoice) . "';
                    </script>";
                    return;
                } else {
                    $error = $this->upload->display_errors();
                    echo "<script>
                        alert('Gagal mengupload gambar');
                        window.location.href = '" . base_url('myorder/confirm/' . $invoice) . "';
                    </script>";
                    return;
                }
            }
        }

        $data['title'] = 'Konfirmasi Pesanan';
        $this->load->view('front/front_header', $data);
        $this->load->view('myorder/confirm', $data);
        $this->load->view('front/front_footer');
    }

    public function image_required()
    {
        // Jika file upload kosong, 
        // atau file upload pada field image namanya itu kosong
        if (empty($_FILES) || $_FILES['image']['name'] === '') {
            $this->session->set_flashdata('image_error', 'Bukti transfer tidak boleh kosong');
            return false;   // Return false agar tidak melanjutkan proses
        }

        return true;
    }

    public function do_delete($id)
    {
        $order = $this->orderm->getId($id);

        if (!$order) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect(base_url('myorder'));
        }

        if ($order->id_user != $this->session->userdata('user_id')) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk menghapus pesanan ini.');
            redirect(base_url('myorder'));
        }

        $orderDetails = $this->Myorders->getOrderDetailsByOrderId($id);

        foreach ($orderDetails as $detail) {
            $this->db->set('stok_barang', 'stok_barang+' . $detail->qty, FALSE);
            $this->db->where('kd_barang', $detail->kd_barang);
            $this->db->update('barang');
        }

        $where = array('id' => $id);
        $w = array('id_orders' => $id);
        $res = $this->orderm->hapus('orders', $where);
        if ($res >= 1) {
            $this->orderm->hapus('orders_confirm', $w);
            $this->orderm->hapus('order_detail', $w);
            echo "<script>
            alert('Hapus Sukses');
            window.location.href = '" . base_url('myorder') . "';
        </script>";
        }
    }
}

/* End of file Myorder.php */
