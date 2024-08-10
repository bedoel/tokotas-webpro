<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('excel');
        $this->load->model('Myorders');
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
        $this->data['orders'] = $this->orderm->getOrders()->result();
        $this->data['no'] = 1;
        $this->data['title'] = 'Admin: Pesanan';
        $this->load->view('templates/auth_header', $this->data);
        $this->load->view('order/index', $this->data);
        $this->load->view('templates/auth_footer');
    }

    public function detail($id)
    {
        $data['order'] = $this->orderm->getId($id);

        if (!$data['order']) {
            $this->session->set_flashdata('warning', 'Data tidak ditemukan');
            redirect('myorder');
        }

        $data['order_detail'] = $this->orderm->getOrderDetails($data['order']->id);

        if ($data['order']->status !== 'waiting') {
            $data['order_confirm'] = $this->orderm->getOrderConfirmation($data['order']->id);
        }
        $data['title'] = 'Admin: Detail Pesanan';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('order/detail', $data);
        $this->load->view('templates/auth_footer');
    }

    public function do_delete($id)
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
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
            window.location.href = '" . base_url('order') . "';
        </script>";
        }
    }

    public function update($id)
    {
        $status = $this->input->post('status');
        if ($this->orderm->updateOrderStatus($id, $status)) {
            $this->session->set_flashdata('success', 'Status berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status.');
        }
        redirect(base_url("order/detail/$id"));
    }

    public function export_to_excel()
    {
        $orders = $this->orderm->get_all_orders(); // Fetch users data from model

        // Create new PHPExcel object
        $objPHPExcel = new Excel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("TASTAS")
            ->setTitle("Data Orders");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID_Order')
            ->setCellValue('B1', 'Invoice')
            ->setCellValue('C1', 'ID_User')
            ->setCellValue('D1', 'Nama')
            ->setCellValue('E1', 'No Hp')
            ->setCellValue('F1', 'Alamat')
            ->setCellValue('G1', 'Tanggal')
            ->setCellValue('H1', 'Nama Produk')
            ->setCellValue('I1', 'QTY')
            ->setCellValue('J1', 'Subtotal')
            ->setCellValue('K1', 'Nama Rekening')
            ->setCellValue('L1', 'No Rekening')
            ->setCellValue('M1', 'Note')
            ->setCellValue('N1', 'Total')
            ->setCellValue('O1', 'Status');

        // Fetch data
        $row = 2; // Starting row for data
        foreach ($orders as $order) {
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('A' . $row, $order->id, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('B' . $row, $order->invoice, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $order->id_user);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $order->nama);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E' . $row, $order->hp, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, $order->alamat);
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, $order->tanggal);
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, $order->nama_barang);
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, $order->qty);
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, $order->subtotal);
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, $order->nama_rek);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('L' . $row, $order->no_rek, PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, $order->note);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('N' . $row, $order->total);
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, $order->status);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Orders');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="orders.xlsx"');
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
