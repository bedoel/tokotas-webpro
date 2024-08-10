<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('excel');
        if (!$this->session->userdata('user_id')) {
            redirect('home');
        }
        $role = $this->session->userdata('role');
        if ($role != 'admin') {
            redirect('auth');
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $this->load->model('Mytas');
        $this->data['barang'] = $this->Mytas->get_all_produks();
        $this->data['no'] = 1;
        $this->data['title'] = 'Admin: Produk';
        $this->load->view('templates/auth_header', $this->data);
        $this->load->view('tampilan/view-tas', $this->data);
        $this->load->view('templates/auth_footer');
    }
    public function tambah()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $data['title'] = 'Admin: Tambah Produk';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('tampilan/view-input-tas');
        $this->load->view('templates/auth_footer');
    }

    public function tambahaksi()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $kd_barang = $this->input->post('kd_barang');
        $nama_barang = $this->input->post('nama_barang');
        $harga_barang = $this->input->post('harga_barang');
        $stok_barang = $this->input->post('stok_barang');
        $kategori = $this->input->post('kategori');

        // Konfigurasi upload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_barang')) {
            $upload_data = $this->upload->data();
            $gambar_barang = $upload_data['file_name'];
        } else {
            $gambar_barang = '';
        }

        $data_insert = array(
            'kd_barang' => $kd_barang,
            'nama_barang' => $nama_barang,
            'harga_barang' => $harga_barang,
            'stok_barang' => $stok_barang,
            'gambar_barang' => $gambar_barang,
            'kategori' => $kategori
        );

        $this->load->model('Mytas');
        $this->Mytas->simpan('barang', $data_insert);
        redirect(base_url('Tas'));
    }

    public function do_delete($kd_barang)
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $where = array('kd_barang' => $kd_barang);
        $res = $this->mytas->hapus('barang', $where);
        if ($res >= 1) {
            echo "<script>
            alert('Hapus Sukses');
            window.location.href = '" . base_url('Tas') . "';
        </script>";
        }
    }

    public function editdata($kd_barang)
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $where = array('kd_barang' => $kd_barang);
        $mhs['barang'] = $this->mytas->ubah($where, 'barang')->result();
        $data['title'] = 'Admin: Edit Produk';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('tampilan/view-edit-tas', $mhs);
        $this->load->view('templates/auth_footer');
    }

    public function updatedata()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $kd_barang = $this->input->post('kd_barang');
        $nama_barang = $this->input->post('nama_barang');
        $harga_barang = $this->input->post('harga_barang');
        $stok_barang = $this->input->post('stok_barang');
        $gambar_barang = $this->input->post('gambar_barang');
        $kategori = $this->input->post('kategori');

        // Konfigurasi upload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('gambar_barang')) {
            $upload_data = $this->upload->data();
            unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
            $gambar_barang = $upload_data['file_name'];
        } else {
            $gambar_barang = $this->input->post('old_pict', TRUE);
        }



        $data_update = array(
            'kd_barang' => $kd_barang,
            'nama_barang' => $nama_barang,
            'harga_barang' => $harga_barang,
            'stok_barang' => $stok_barang,
            'gambar_barang' => $gambar_barang,
            'kategori' => $kategori
        );
        $where = array('kd_barang' => $kd_barang);

        $this->mytas->updateBarang($where, $data_update, 'barang');
        redirect(base_url('Tas'));
    }

    public function export_to_excel()
    {
        $produks = $this->mytas->get_all_produks(); // Fetch users data from model

        // Create new PHPExcel object
        $objPHPExcel = new Excel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("TASTAS")
            ->setTitle("Data Barang");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Kode Barang')
            ->setCellValue('B1', 'Nama Barang')
            ->setCellValue('C1', 'Harga')
            ->setCellValue('D1', 'Stok')
            ->setCellValue('E1', 'Kategori');

        // Fetch data
        $row = 2; // Starting row for data
        foreach ($produks as $produk) {
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $row, $produk->kd_barang, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $row, $produk->nama_barang, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $produk->harga_barang);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $produk->stok_barang);
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, $produk->kategori);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Barang');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="barang.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1'); // If you're serving to IE 9, set the following headers
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}
