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
    }
    public function index()
    {
        $data = [
            'title'    => 'Admin',
            'buku'     => $this->db->order_by('id', 'desc')->get('buku')->result_array()
        ];
        $this->template->load('admin/template', 'admin/home', $data);
    }
}
