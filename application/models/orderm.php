<?php
class Orderm extends CI_Model
{
    public function get_all_orders()
    {
        $this->db->select('orders.*, order_detail.id_orders, order_detail.kd_barang, order_detail.subtotal, order_detail.qty, orders_confirm.id_orders, orders_confirm.nama_rek, orders_confirm.no_rek, orders_confirm.note, barang.nama_barang');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.id = order_detail.id_orders', 'left');
        $this->db->join('orders_confirm', 'orders.id = orders_confirm.id_orders', 'left');
        $this->db->join('barang', 'order_detail.kd_barang = barang.kd_barang', 'left');
        $query = $this->db->get();

        return $query->result();
    }

    public function getOrders()
    {
        $query = $this->db->get('orders');
        return $query;
    }

    public function getId($id)
    {
        return $this->db->get_where('orders', ['id' => $id])->row();
    }

    public function getOrderDetails($id)
    {
        $this->db->select('order_detail.id_orders, order_detail.kd_barang, order_detail.qty, order_detail.subtotal, barang.nama_barang, barang.gambar_barang, barang.harga_barang');
        $this->db->from('order_detail');
        $this->db->join('barang', 'order_detail.kd_barang = barang.kd_barang', 'left');
        $this->db->where('order_detail.id_orders', $id);
        $query = $this->db->get();
        return $query->result();
    }
    public function getOrderConfirmation($id)
    {
        return $this->db->get_where('orders_confirm', ['id_orders' => $id])->row();
    }

    public function hapus($table_name, $where)
    {
        $res = $this->db->delete($table_name, $where);
        return $res;
    }

    public function updateOrderStatus($order_id, $status)
    {
        $this->db->where('id', $order_id);
        $this->db->update('orders', ['status' => $status]);
        return $this->db->affected_rows() > 0;
    }
    public function get_orders_today()
    {
        $this->db->where('DATE(created_at)', 'CURDATE()', FALSE);
        return $this->db->count_all_results('orders');
    }

    public function get_total_orders()
    {
        return $this->db->count_all('orders');
    }

    public function getTodayEarnings()
    {
        $this->db->select_sum('total');
        $this->db->where('DATE(tanggal)', 'CURDATE()', FALSE);
        $query = $this->db->get('orders');
        return $query->row()->total;
    }

    public function getTotalEarnings()
    {
        $this->db->select_sum('total');
        $query = $this->db->get('orders');
        return $query->row()->total;
    }
}
