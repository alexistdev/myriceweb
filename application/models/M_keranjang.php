<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_keranjang extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_keranjang($idUser)
	{
		$this->db->select("keranjang.id_produk as idProduk,judul,tanggal,total_jumlah as totalOrder, status as statusOrder");
		$this->db->join("produk", 'produk.id_produk=keranjang.id_produk');
		$this->db->where('keranjang.id_user', $idUser);
		return $this->db->get("keranjang");
	}

	public function get_data_tambahkeranjang($idUser)
	{
		$this->db->where('id_user',$idUser);
		return $this->db->get("total_keranjang");
	}

	public function simpan_total_keranjang($data)
	{
		$this->db->insert("total_keranjang",$data);
		return $this->db->insert_id();
	}

	public function simpan_keranjang($data)
	{
		return $this->db->insert("keranjang",$data);
	}

	public function cek_id_produk($idProduk)
	{
		$this->db->where('id_produk', $idProduk);
		return $this->db->get("keranjang");
	}
	public function get_sub_total($idKrj)
	{
		$this->db->select_sum('sub_total');
		$result = $this->db->get('keranjang')->row();
		return $result->sub_total;

//		$this->db->select_sum("sub_total");
//		$this->db->select("sub_total as TotalOrder");
//		$this->db->where('id_krj', $idKrj);
//		return $this->db->get("keranjang");
	}

	public function update_total_keranjang($dataTKeranjang,$idUser)
	{
		$this->db->where('id_user',$idUser);
		$this->db->update("total_keranjang",$dataTKeranjang);
	}
}
