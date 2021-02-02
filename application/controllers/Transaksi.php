<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_transaksi', 'm_transaksi');
    }

    public function getdata($id)
    {
        $data = $this->m_transaksi->getById($id);
        echo json_encode($data);
    }

    public function pinjam()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        $data['title']  = 'Transaksi Pinjam';
        $data['transaksi'] = $this->m_transaksi->getPinjam();
        $this->template->load('admin/template', 'admin/transaksi/pinjam', $data);
    }

    public function kembali()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        $data['title']  = 'Transaksi Kembali';
        $data['transaksi'] = $this->m_transaksi->getKembali();
        $this->template->load('admin/template', 'admin/transaksi/kembali', $data);
    }

    public function peminjaman()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        $kd_buku = $this->input->post('kd_buku');
        $buku = $this->db->get_where('buku', ['kd_buku'=>$kd_buku])->row_array();
        $jml_buku = (int)$buku['jumlah'];
        $stokbaru = $jml_buku - 1;

        $data = [
            'no_reg'     => $this->input->post('no_reg'),
            'kd_buku'    => $kd_buku,
            'tgl_pinjam' => $this->input->post('tgl_pinjam'),
        ];
        
        if($this->db->insert('transaksi', $data) && $this->db->update('buku', ['jumlah'=>$stokbaru], ['kd_buku'=>$kd_buku])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Tambah Data!</div>');
            redirect('/admin');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Gagal Tambah Data!</div>');
            redirect('/admin');
        }
    }

    public function pengembalian($id)
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        $trx = $this->db->get_where('transaksi', ['id'=>$id])->row_array();
        $buku = $this->db->get_where('buku', ['kd_buku'=>$trx['kd_buku']])->row_array();
        $jml_buku = (int)$buku['jumlah'];
        $stokbaru = $jml_buku + 1;

        $data = [
            'tgl_kembali' => $this->input->post('tgl_kembali'),
            'denda' => $this->input->post('denda'),
        ];

        if($this->db->update('transaksi', $data, ['id'=>$id]) && $this->db->update('buku', ['jumlah'=>$stokbaru], ['kd_buku'=>$trx['kd_buku']])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku Berhasil dikembalikan!</div>');
            redirect('/admin');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Gagal Tambah Data!</div>');
            redirect('/admin');
        }
    }

    public function userpinjam($id)
    {
        if (!$this->session->userdata('isLogin')) {
            redirect(base_url());
        }

        $no_reg = $this->session->userdata('no_reg');

        $buku = $this->db->get_where('buku', ['id'=>$id])->row_array();
        $jml_buku = (int)$buku['jumlah'];
        $stokbaru = $jml_buku - 1;

        $data = [
            'no_reg'     => $no_reg,
            'kd_buku'    => $buku['kd_buku'],
            'tgl_pinjam' => $this->input->post('tgl_pinjam'),
        ];

        if($this->db->insert('transaksi', $data) && $this->db->update('buku', ['jumlah'=>$stokbaru], ['kd_buku'=>$buku['kd_buku']])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Melakukan Peminjaman Buku!</div>');
            redirect('/');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maaf, Melakukan Peminjaman Buku!</div>');
            redirect('/');
        }
    }

    public function hapus($id)
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
        
        $trx = $this->db->get_where('transaksi', ['id'=>$id])->row_array();
        $buku = $this->db->get_where('buku', ['kd_buku'=>$trx['kd_buku']])->row_array();

        if($trx['tgl_kembali'] == ''){
            $jml_buku = (int)$buku['jumlah'];
            $stokbaru = $jml_buku + 1;
        }else{
            $stokbaru = $buku['jumlah'];
        }

        if($this->db->delete('transaksi', ['id'=> $id]) && $this->db->update('buku', ['jumlah'=>$stokbaru], ['kd_buku'=>$trx['kd_buku']])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Data!</div>');
            redirect('/admin');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Gagal Hapus Data!</div>');
            redirect('/admin');
        }
    }
}
