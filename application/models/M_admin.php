<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		return $this->db->get('user');
	}

	public function validasi_login($username)
	{
		$this->db->where('username', $username);
		return $this->db->get("admin");
	}

	public function simpan_kategori($data)
	{
		$this->db->insert("kategori",$data);
	}

	public function get_data_kategori($data)
	{
		if($data != null){
			$this->db->where('id_kategori',$data);
		}
		return $this->db->get('kategori');
	}

	public function hapus_kategori($id)
	{
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
	}

	public function simpan_merek($dataMerek)
	{
		$this->db->insert("merek",$dataMerek);
	}

	public function get_data_merek($data)
	{
		if($data != null){
			$this->db->where('id_merek',$data);
		}
		return $this->db->get('merek');
	}
	public function hapus_merek($id)
	{
		$this->db->where('id_merek', $id);
		$this->db->delete('merek');
	}

	public function get_data_produk($data)
	{
		$this->db->join('kategori', 'kategori.id_kategori=produk.id_kategori');
		$this->db->join('merek', 'merek.id_merek=produk.id_merek');
		if($data != null){
			$this->db->where('id_produk',$data);
		}
		return $this->db->get('produk');
	}

	public function update_admin($data)
	{
		$this->db->update("admin",$data);
	}

	public function get_data_user($data)
	{
		$this->db->join('detail_user', 'detail_user.id_user=user.id_user');
		if($data != null){
			$this->db->where('user.id_user',$data);
		}
		return $this->db->get('user');
	}

	public function get_data_pesanan($data)
	{
		$this->db->join('detail_user', 'detail_user.id_user=pesanan.id_user');
		if($data != null){
			$this->db->where('pesanan.id_pesanan',$data);
		}
		return $this->db->get('pesanan');
	}

}
