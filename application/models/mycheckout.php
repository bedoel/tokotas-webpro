<?php
class Mycheckout extends CI_Model
{
    public function getCheckout()
    {
        $query = $this->db->get('orders');
        return $query;
    }
    public function getIdBarang()
    {
        $query = $this->db->get('barang');
        return $query;
    }

    public function simpan($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function getById($table, $where)
    {
        return $this->db->get_where($table, $where)->row();
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

    public function updateChekout($where, $data, $table_name)
    {
        $this->db->where($where);
        $this->db->update($table_name, $data);
    }
}
