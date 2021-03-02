<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_keranjang extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_keranjang($idKeranjang)
	{
		$this->db->select("keranjang.id_produk as idProduk,produk.nama_produk as namaProduk,produk.total_harga as hargaProduk, produk.gambar as gambarProduk, keranjang.jumlah as jumlahProduk, keranjang.sub_total as subTotalProduk");
		$this->db->join("produk", 'produk.id_produk=keranjang.id_produk');
		$this->db->where('keranjang.id_krj', $idKeranjang);
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
	}

	public function update_total_keranjang($dataTKeranjang,$idUser)
	{
		$this->db->where('id_user',$idUser);
		$this->db->update("total_keranjang",$dataTKeranjang);
	}

	public function update_keranjang($dataKeranjangNew, $idProduk)
	{
		$this->db->where('id_produk',$idProduk);
		$this->db->update("keranjang",$dataKeranjangNew);
	}

	public function get_keranjang_byidproduk($idProduk)
	{
		$this->db->select("keranjang.sub_total,keranjang.jumlah,keranjang.id_krj,produk.total_harga as hargaProduk");
		$this->db->join("produk", 'produk.id_produk=keranjang.id_produk');
		$this->db->where('keranjang.id_produk', $idProduk);
		return $this->db->get("keranjang");
	}

	public function get_data_totalkeranjang($idUser)
	{
		$this->db->where('id_user',$idUser);
		return $this->db->get("total_keranjang");
	}
}
