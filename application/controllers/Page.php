<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

    public function buku()
    {
        $data = [
            'title'    => 'Buku',
            'buku'     => $this->db->order_by('id', 'desc')->get('buku')->result_array()
        ];
        $this->template->load('user/template', 'pages/buku', $data);
    }

    public function tentang()
    {
        $data['title'] = 'Tentang';
        $this->template->load('user/template', 'pages/kontak', $data);
    }

    public function kontak()
    {
        $data['title'] = 'Kontak';
        $this->template->load('user/template', 'pages/kontak', $data);
    }
}
