<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
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
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $this->load->model('Myusers');
        $this->data['users'] = $this->Myusers->getUsers()->result();
        $this->data['no'] = 1;
        $this->data['title'] = 'Admin: Users';
        $this->load->view('templates/auth_header', $this->data);
        $this->load->view('users/view-users', $this->data);
        $this->load->view('templates/auth_footer');
    }
    public function tambah()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }
        $data['title'] = 'Admin: Tambah User';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('users/input-users');
        $this->load->view('templates/auth_footer');
    }

    public function tambahaksi()
    {
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Anda tidak memiliki izin untuk mengakses detail pesanan ini.');
            redirect(base_url('home'));
        }

        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');

        $password_hashed = password_hash($password, PASSWORD_DEFAULT);

        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '3000';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_image')) {
            $upload_data = $this->upload->data();
            $profile_image = $upload_data['file_name'];
        } else {
            $profile_image = 'default.png';
        }

        $data_insert = array(
            'id' => $id,
            'username' => $username,
            'password' => $password,
            'role' => $role,
            'profile_image' => $profile_image
        );

        $this->load->model('Myusers');
        if ($this->Myusers->simpan('users', $data_insert)) {
            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data user.');
        }
        redirect(base_url('users'));
    }

    public function do_delete($id)
    {
        $where = array('id' => $id);
        $res = $this->myusers->hapus('users', $where);
        if ($res >= 1) {
            echo "<script>
            alert('Hapus Sukses');
            window.location.href = '" . base_url('users') . "';
        </script>";
        }
    }

    public function editdata($id)
    {
        $where = array('id' => $id);
        $mhs['users'] = $this->myusers->ubah($where, 'users')->result();
        $data['title'] = 'Admin: Edit Data User';
        $this->load->view('templates/auth_header', $data);
        $this->load->view('users/edit-users', $mhs);
        $this->load->view('templates/auth_footer');
    }

    public function updatedata()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $role = $this->input->post('role');
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
            'role' => $role,
            'profile_image' => $profile_image
        );
        $where = array('id' => $id);

        if ($this->myusers->updateUsers($where, $data_update, 'users')) {
            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data user.');
        }
        redirect(base_url("users/editdata/$id"));
    }

    public function export_to_excel()
    {
        $users = $this->myusers->get_all_users(); // Fetch users data from model

        // Create new PHPExcel object
        $objPHPExcel = new Excel();

        // Set document properties
        $objPHPExcel->getProperties()->setCreator("TASTAS")
            ->setTitle("Users Data");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'ID')
            ->setCellValue('B1', 'Username')
            ->setCellValue('C1', 'Role');

        // Fetch data
        $row = 2; // Starting row for data
        foreach ($users as $user) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $user->id);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $user->username);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $user->role);
            $row++;
        }

        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Users');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="users.xlsx"');
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
