<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
    }

    public function index()
    {
        $data = [
            'title'    => 'Siswa',
            'siswa'     => $this->db->get('siswa')->result_array()
        ];
        $this->template->load('admin/template', 'admin/siswa/index', $data);
    }

    public function add()
    {
        if(isset($_POST)){
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
                redirect('/siswa');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal Registrasi!.</div>');
                redirect('/siswa');
            }
        }
    }

    public function update($id)
    {
        if(isset($_POST['submit'])){    
            $data= [
                'nama_siswa' => $this->input->post('nama_siswa'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'kelas' => $this->input->post('kelas'),
            ];
            if( $this->input->post('password') !== '' ){
                $data['password'] =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            if($this->db->update('siswa', $data, ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah Data!</div>');
                redirect('/siswa');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Ubah Data!</div>');
                redirect('/siswa');
            }
        }else{
            redirect('/siswa');
        }
    }

    public function getdata($id){
        $data = $this->db->get_where('siswa', ['id'=>$id])->row_array();
        echo json_encode($data);
    }

    public function delete($id)
    {
        if($this->db->delete('siswa', ['id'=>$id])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Data!</div>');
            redirect('/siswa');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal hapus data!</div>');
            redirect('/siswa');
        }
    }
}
