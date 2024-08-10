<?php
class Myusers extends CI_Model
{
    public function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function getUsers()
    {
        $query = $this->db->get('users');
        return $query;
    }

    public function simpan($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows() > 0;
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

    public function updateUsers($where, $data, $table_name)
    {
        $this->db->where($where);
        $this->db->update($table_name, $data);
        return $this->db->affected_rows() > 0;
    }
}
