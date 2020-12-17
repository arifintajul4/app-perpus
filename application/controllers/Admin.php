<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
        $this->load->model('M_transaksi', 'm_transaksi');
    }
    public function index()
    {
        $data = [
            'title'     => 'Admin',
            'transaksi' => $this->m_transaksi->getData()
        ];
        $this->template->load('admin/template', 'admin/home', $data);
    }

    function get_siswa(){
        if (isset($_GET['term'])) {
            $this->db->like('nama_siswa', $_GET['term']);
            $result = $this->db->get('siswa')->result();
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->nama_siswa,
                    'no_reg' => $row->no_reg,
                );
                echo json_encode($arr_result);
            }
        }
    }

    function get_buku(){
        if (isset($_GET['term'])) {
            $this->db->like('judul_buku', $_GET['term']);
            $result = $this->db->get('buku')->result();
            if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->judul_buku,
                    'kd_buku' => $row->kd_buku,
                );
                echo json_encode($arr_result);
            }
        }
    }
}
