<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_transaksi', 'm_transaksi');
  }

  public function profile()
  {
    $data['title'] = 'user';
    $data['siswa'] = $this->db->get_where('siswa', ['no_reg' => $this->session->userdata('no_reg')])->row_array();
    $this->template->load('user/template', 'user/profile', $data);
  }

  public function update()
  {
    if (isset($_POST['no_reg'])) {
      $config['upload_path']          = './assets/img/profile/';
      $config['allowed_types']        = 'gif|jpg|png';
      $config['encrypt_name']         = TRUE;
      $this->load->library('upload', $config);

      $data = [
        'nama_siswa'  => $this->input->post('nama_siswa'),
      ];
      if ($_FILES['foto']['name'] !== '') {
        if (!$this->upload->do_upload('foto')) {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal upload foto! ' . $this->upload->display_errors() . '</div>');
          redirect('user/profile');
        } else {
          $data['foto'] = $this->upload->data()['file_name'];
        }
      }

      if ($this->input->post('password') !== '') {
        $data['password'] =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
      }
      if ($this->db->update('siswa', $data, ['no_reg' => $_POST['no_reg']])) {
        $data = [
          'isLogin'   => true,
          'foto'      => $data['foto'],
          'no_reg'    => $this->input->post('no_reg'),
          'nama'      => $this->input->post('nama_siswa'),
          'hak_akses' => 'siswa',
        ];
        $this->session->set_userdata($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Ubah Data!</div>');
        redirect('user/profile');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal Ubah Data!</div>');
        redirect('user/profile');
      }
    } else {
      redirect('user/profile');
    }
  }
}
