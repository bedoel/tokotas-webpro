<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }

    public function register()
    {
        $data['title'] = 'Register';
        $this->load->view('auth/register', $data);
    }

    public function register_user()
    {
        // Set rules for form validation
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|matches[password]');
        $role = 'user';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/register');
        } else {
            $profile_image = 'default.png';

            $data = [
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'profile_image' => $profile_image,
                'role' => $role
            ];

            $insert = $this->User_model->insert_user($data);

            if ($insert) {
                $this->session->set_flashdata('success', 'Registrasi berhasil. Kamu bisa login sekarang.');
                redirect('auth');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal. Mohon coba lagi.');
                redirect('auth/register');
            }
        }
    }


    public function login()
    {
        $data['title'] = 'Login';
        $this->load->view('auth/login', $data);
    }

    public function login_submit()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');

        $user = $this->User_model->get_user($username, $password);

        if ($user && password_verify($password, $user['password'])) {
            $this->session->set_userdata('user_id', $user['id']);
            $this->session->set_userdata('username', $user['username']);
            $this->session->set_userdata('role', $user['role']);
            $this->session->set_userdata('profile_image', $user['profile_image']);
            if ($remember_me) {
                // Set remember me cookie
                $this->input->set_cookie('remember_me', $username, 86500 * 30); // Expire in 30 days
            }
            $role = $this->session->userdata('role');
            if ($role == 'admin') {
                redirect('dashboard');
            } else {
                redirect('home');
            }
        } else {
            $this->session->set_flashdata('error', 'Invalid login. User not found');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        delete_cookie('remember_me');
        redirect('auth');
    }

    public function forgot_password()
    {
        $data['title'] = 'Forgot Password';
        $this->load->view('auth/forgot_password', $data);
    }

    public function forgot_password_submit()
    {
        $email = $this->input->post('email');

        // Check if email exists
        $user = $this->User_model->get_user_by_email($email);
        if ($user) {
            // Generate token
            $token = random_string('alnum', 50);

            // Save token in the database
            $this->User_model->set_password_reset_token($email, $token);

            // Send email
            $this->email->from('gamefadlur1969@gmail.com', 'TASTAS');
            $this->email->to($email);
            $this->email->subject('Permintaan Reset Password');
            $this->email->message('Klik tautan berikut untuk mereset password Anda: ' . site_url('auth/reset_password/' . $token));

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Periksa email Anda untuk tautan reset password.');
            } else {
                $this->session->set_flashdata('error', 'Ada masalah saat mengirim email. ' . $this->email->print_debugger());
            }
        } else {
            $this->session->set_flashdata('error', 'Email tidak ditemukan.');
        }

        redirect('auth/forgot_password');
    }

    public function reset_password($token)
    {
        $data['title'] = 'Reset Password';
        $data['token'] = $token;
        $this->load->view('auth/reset_password', $data);
    }

    public function reset_password_submit()
    {
        $token = $this->input->post('token');
        $password = $this->input->post('password');

        // Verify token and reset password
        if ($this->User_model->verify_reset_token($token)) {
            $this->User_model->update_password($token, $password);
            $this->session->set_flashdata('success', 'Password berhasil direset.');
            redirect('auth/login');
        } else {
            $this->session->set_flashdata('error', 'Token tidak valid atau sudah kadaluarsa.');
            redirect('auth/forgot_password');
        }
    }
}
