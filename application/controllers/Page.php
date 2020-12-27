<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi', 'm_transaksi');
    }

    public function buku()
    {
        $data['title'] = 'Buku';
        if(isset($_GET['cari'])){
            $data['buku'] = $this->db->order_by('id', 'desc')->like('judul_buku', $_GET['cari'])->get('buku')->result_array();
        }else{
            $data['buku'] = $this->db->order_by('id', 'desc')->get('buku')->result_array();
        }
        $this->template->load('user/template', 'pages/buku', $data);
    }

    public function tentang()
    {
        $data['title'] = 'Tentang';
        $this->template->load('user/template', 'pages/tentang', $data);
    }

    public function kontak()
    {
        $data['title'] = 'Kontak';
        $this->template->load('user/template', 'pages/kontak', $data);
    }

    public function history()
    {
        $data['title'] = 'History';
        $no_reg = $this->session->userdata('no_reg');
        $data['transaksi'] = $this->m_transaksi->getByUser($no_reg);
        $this->template->load('user/template', 'pages/history', $data);
    }

    public function login()
    {
        $data['title'] = "Login";
        if(isset($_POST['submit'])){
            $no_reg = $this->input->post('no_reg');
            $password = $this->input->post('password');

            $user = $this->db->get_where('siswa', ['no_reg' => $no_reg])->row_array();

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'isLogin'   => true,
                        'no_reg'    => $user['no_reg'],
                        'nama'      => $user['nama_siswa'],
                        'hak_akses' => 'siswa',
                    ];
                    $this->session->set_userdata($data);
                    redirect('/');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('/page/login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">No Registrasi belum terdaftar!</div>');
                redirect('/page/login');
            }
        }
        $this->template->load('user/template', 'pages/login', $data);
    }

    public function register()
    {
        $data['title'] = "Register";
        if(isset($_POST['submit'])){
            $query = $this->db->query("SELECT MAX(no_reg) as no_reg from siswa");
            $hasil = $query->row();
            $nourut = substr($hasil->no_reg, 3, 3);
            $no_reg = (int)$nourut + 1;
            $no_reg = "REG".sprintf("%03s", $no_reg);
            $data = [
                'no_reg' => $no_reg,
                'nama_siswa' => $this->input->post('nama_siswa'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'kelas' => $this->input->post('kelas'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];
            if($this->db->insert('siswa', $data)){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Registrasi!<br>No Registrasi anda adalah <strong>'.$no_reg.'</strong>. Silahkan catat dan gunakan untuk login.</div>');
                redirect('/page/login');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal Registrasi!.</div>');
                redirect('/page/register');
            }
        }
        $this->template->load('user/template', 'pages/register', $data);
    }
}
