<?php
class Myorders extends CI_Model
{
    public function getMyorders($userId)
    {
        $this->db->where('id_user', $userId);
        $query = $this->db->get('orders');
        return $query->result();
    }

    public function getInvoice($invoice)
    {
        return $this->db->get_where('orders', ['invoice' => $invoice])->row();
    }

    public function getOrderDetails($order_id)
    {
        $this->db->select('order_detail.id_orders, order_detail.kd_barang, order_detail.qty, order_detail.subtotal, barang.nama_barang, barang.gambar_barang, barang.harga_barang');
        $this->db->from('order_detail');
        $this->db->join('barang', 'order_detail.kd_barang = barang.kd_barang', 'left');
        $this->db->where('order_detail.id_orders', $order_id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getOrderConfirmation($order_id)
    {
        return $this->db->get_where('orders_confirm', ['id_orders' => $order_id])->row();
    }

    public function simpan($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function updateOrderStatus($order_id, $status)
    {
        $this->db->where('id', $order_id);
        $this->db->update('orders', ['status' => $status]);
    }

    public function hapus($table_name, $where)
    {
        $res = $this->db->delete($table_name, $where);
        return $res;
    }

    public function ubah($where, $table_name)
    {
        $data = $this->db->get_where($table_name, $where);
        return $data;
    }

    public function getOrderDetailsByOrderId($order_id)
    {
        return $this->db->get_where('order_detail', ['id_orders' => $order_id])->result();
    }
}
