<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
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
            'title'    => 'Buku',
            'buku'     => $this->db->order_by('id', 'desc')->get('buku')->result_array()
        ];
        $this->template->load('admin/template', 'admin/buku/index', $data);
    }

    public function add()
    {
        if(isset($_POST)){
            $data = [
                'judul_buku'=>$this->input->post('judul_buku'),
                'kategori'=>$this->input->post('kategori'),
                'penerbbit'=>$this->input->post('penerbbit'),
                'pengarang'=>$this->input->post('pengarang'),
            ];

            if($this->db->insert('buku', $data)){
                
            }
        }
    }
}
