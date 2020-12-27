<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{
    public function index()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') !== 'admin') {
            redirect(base_url());
        }

        $data = [
            'title'    => 'Buku',
            'buku'     => $this->db->order_by('id', 'desc')->get('buku')->result_array()
        ];
        $this->template->load('admin/template', 'admin/buku/index', $data);
    }

    public function add()
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        if(isset($_POST)){
            $data = [
                'kd_buku'=>$this->input->post('kd_buku'),
                'judul_buku'=>$this->input->post('judul_buku'),
                'penerbit'=>$this->input->post('penerbit'),
                'pengarang'=>$this->input->post('pengarang'),
                'tahun_terbit'=>$this->input->post('tahun_terbit'),
                'nomor_rak'=>$this->input->post('nomor_rak'),
                'jumlah'=>$this->input->post('jumlah'),
            ];
            
            $config['upload_path']          = 'assets/img/buku/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('sampul')){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal upload foto buku: '.$this->upload->display_errors().'!</div>');
                redirect('/buku');
            }
            else{
                $data['sampul'] = $this->upload->data('file_name'); 
                if($this->db->insert('buku', $data)){
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Tambah Data!</div>');
                    redirect('/buku');
                }else{
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, tambah data!</div>');
                    redirect('/buku');
                }
            }

            
        }
    }

    public function update($id)
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }

        if(isset($_POST)){
            $data = [
                'judul_buku'=>$this->input->post('judul_buku'),
                'penerbit'=>$this->input->post('penerbit'),
                'pengarang'=>$this->input->post('pengarang'),
                'tahun_terbit'=>$this->input->post('tahun_terbit'),
                'nomor_rak'=>$this->input->post('nomor_rak'),
                'jumlah'=>$this->input->post('jumlah'),
            ];
            $config['upload_path']          = 'assets/img/buku/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            if($_FILES['sampul']['name']!=''){
                if (!$this->upload->do_upload('sampul')){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal upload foto buku: '.$this->upload->display_errors().'!</div>');
                    redirect('/buku');
                }else{
                    $data['sampul'] = $this->upload->data('file_name');
                }
            }

            
            if($this->db->update('buku', $data, ['id'=>$id])){
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah Data!</div>');
                redirect('/buku');
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, ubah data!</div>');
                redirect('/buku');
            }
        }
    }

    public function getdata($id){
        $data = $this->db->get_where('buku', ['id'=>$id])->row_array();
        echo json_encode($data);
    }

    public function delete($id)
    {
        if (!$this->session->userdata('isLogin') || $this->session->userdata('hak_akses') != 'admin') {
            redirect(base_url());
        }
        
        if($this->db->delete('buku', ['id'=>$id])){
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Hapus Data!</div>');
            redirect('/buku');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"Maaf, gagal hapus data!</div>');
            redirect('/buku');
        }
    }
}
