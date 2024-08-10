<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Myusers');
        $this->load->library('session');
        $this->load->library('excel');
        if (!$this->session->userdata('user_id')) {
            redirect('home');
        }
    }

    public function editprofile($id)
    {
        if ($this->session->userdata('user_id') == $id) {
            $where = array('id' => $id);
            $mhs['users'] = $this->myusers->ubah($where, 'users')->result();
            $data['title'] = 'Edit Profile';
            $this->load->view('front/front_header', $data);
            $this->load->view('profile/edit-profile', $mhs);
            $this->load->view('front/front_footer');
        } else {
            redirect(base_url('home'));
        }
    }

    public function updateprofile()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $old_password = $this->input->post('old_password');
        $old_profile_image = $this->input->post('old_profile_image');

        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $old_password;
        }

        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_image')) {
            $upload_data = $this->upload->data();
            $profile_image = $upload_data['file_name'];

            if (!empty($old_profile_image) && file_exists('./assets/img/upload/' . $old_profile_image)) {
                unlink('./assets/img/upload/' . $old_profile_image);
            }
        } else {
            $profile_image = $old_profile_image;
        }

        $data_update = array(
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'profile_image' => $profile_image
        );
        $where = array('id' => $id);

        if ($this->myusers->updateUsers($where, $data_update, 'users')) {
            $this->session->set_flashdata('success', 'Profile user berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profile user.');
        }
        redirect(base_url("profile/editprofile/$id"));
    }
}
