<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function insert_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function store_token($username, $token)
    {
        $data = array(
            'remember_me_token' => $token
        );
        $this->db->where('username', $username);
        $this->db->update('users', $data);
    }

    public function get_username_by_token($token)
    {
        $this->db->where('remember_me_token', $token);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row()->username;
        } else {
            return false;
        }
    }

    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function set_password_reset_token($email, $token)
    {
        $data = array(
            'password_reset_token' => $token,
            'token_expiration' => date('Y-m-d H:i:s', strtotime('+1 hour'))
        );
        $this->db->where('email', $email);
        $this->db->update('users', $data);
    }

    public function verify_reset_token($token)
    {
        $this->db->where('password_reset_token', $token);
        $this->db->where('token_expiration >=', date('Y-m-d H:i:s'));
        $query = $this->db->get('users');
        return $query->row();
    }

    public function update_password($token, $password)
    {
        $data = array(
            'password' => password_hash($password, PASSWORD_DEFAULT), // Or use password_hash() for better security
            'password_reset_token' => NULL,
            'token_expiration' => NULL
        );
        $this->db->where('password_reset_token', $token);
        $this->db->update('users', $data);
    }
}
