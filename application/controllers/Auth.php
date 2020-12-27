<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        isLogin();
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Login'
            ];
            $this->template->load('auth/template', 'auth/login', $data);
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('admin', ['username' => $username])->row_array();
            if($user['status']=='1'){
                $hak_akses = 'admin';
            }else{
                $hak_akses = 'keperpus';
            }
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'isLogin'   => true,
                        'username'  => $user['username'],
                        'nama'      => $user['nama_lengkap'],
                        'hak_akses' => $hak_akses,
                    ];
                    $this->session->set_userdata($data);
                    redirect('/admin');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username belum terdaftar!</div>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('isLogin');
        session_destroy();
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('/');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
