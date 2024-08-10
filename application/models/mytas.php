<?php
class Mytas extends CI_Model
{
    public function get_all_produks()
    {
        $query = $this->db->get('barang');
        return $query->result();
    }

    public function simpan($table, $data)
    {
        $this->db->insert($table, $data);
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

    public function updateBarang($where, $data, $table_name)
    {
        $this->db->where($where);
        $this->db->update($table_name, $data);
    }
}
