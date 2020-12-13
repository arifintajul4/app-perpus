<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $data = [
            'title'    => 'Home',
            'buku'     => $this->db->get('buku')->result_array()
        ];
        $this->template->load('user/template', 'user/home', $data);
    }
}
