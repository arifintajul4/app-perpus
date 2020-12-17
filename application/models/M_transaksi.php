<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

	public function getdata()
	{
		$this->db->select('siswa.nama_siswa, siswa.no_reg, buku.judul_buku, transaksi.*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.no_reg = siswa.no_reg');
		$this->db->join('buku', 'transaksi.kd_buku = buku.kd_buku');
		$this->db->order_by('id', 'desc');
		return $this->db->get()->result_array();
	}

	public function getById($id)
	{
		$this->db->select('siswa.nama_siswa, siswa.no_reg, buku.judul_buku, transaksi.*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.no_reg = siswa.no_reg');
		$this->db->join('buku', 'transaksi.kd_buku = buku.kd_buku');
		$this->db->where('transaksi.id', $id);
		return $this->db->get()->row_array();
	}

	public function getPinjam()
	{
		$this->db->select('siswa.nama_siswa, siswa.no_reg, buku.judul_buku, transaksi.*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.no_reg = siswa.no_reg');
		$this->db->join('buku', 'transaksi.kd_buku = buku.kd_buku');
		$this->db->where('transaksi.tgl_kembali', null);
		return $this->db->get()->result_array();
	}
	
	public function getKembali()
	{
		$this->db->select('siswa.nama_siswa, siswa.no_reg, buku.judul_buku, transaksi.*');
		$this->db->from('transaksi');
		$this->db->join('siswa', 'transaksi.no_reg = siswa.no_reg');
		$this->db->join('buku', 'transaksi.kd_buku = buku.kd_buku');
		$this->db->where('transaksi.tgl_kembali !=', '');
		return $this->db->get()->result_array();
	}
}