<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
        $this->load->model('M_transaksi', 'm_transaksi');
    }

    public function getdata($id)
    {
        $data = $this->m_transaksi->getById($id);
        echo json_encode($data);
    }

    public function pinjam()
    {
        $data['title']  = 'Transaksi Pinjam';
        $data['transaksi'] = $this->m_transaksi->getPinjam();
        $this->template->load('admin/template', 'admin/transaksi/pinjam', $data);
    }

    public function kembali()
    {
        $data['title']  = 'Transaksi Kembali';
        $data['transaksi'] = $this->m_transaksi->getKembali();
        $this->template->load('admin/template', 'admin/transaksi/kembali', $data);
    }

    public function peminjaman()
    {
        $data = [
            'no_reg' => $this->input->post('no_reg'),
            'kd_buku' => $this->input->post('kd_buku'),
            'tgl_pinjam' => $this->input->post('tgl_pinjam'),
        ];

        if($this->db->insert('transaksi', $data)){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Tambah Data!</div>');
            redirect('/admin');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Gagal Tambah Data!</div>');
            redirect('/admin');
        }
    }

    public function pengembalian($id)
    {
        $data = [
            'tgl_kembali' => $this->input->post('tgl_kembali'),
            'denda' => $this->input->post('denda'),
        ];

        if($this->db->update('transaksi', $data, ['id'=>$id])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku Berhasil dikembalikan!</div>');
            redirect('/admin');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Gagal Tambah Data!</div>');
            redirect('/admin');
        }
    }
}
