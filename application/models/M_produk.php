<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_produk extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
	 * tabel user
	 */
	public function get_data_spesial($opsi){
		$this->db->select("produk.id_produk as idProduk,produk.nama_produk as namaProduk,produk.jumlah as stokProduk,produk.total_harga as hargaProduk, spesial.harga_diskon as hargaDiskon, produk.gambar");
		$this->db->join("produk", 'produk.id_produk=spesial.id_produk');
		if($opsi != null){
			$this->db->order_by('rand()');
			$this->db->limit(1);
		}
		return $this->db->get("spesial");
	}

	public function get_data_produk($opsi,$idKategori){
		$this->db->select("id_produk as idProduk,nama_produk as namaProduk,jumlah as stokProduk,total_harga as hargaProduk,produk.gambar");
		if($opsi == 1){
			$this->db->limit(5);
		}else if ($opsi ==2){

		}else {
			$this->db->where('id_kategori', $idKategori);
		}
		return $this->db->get("produk");

	}
}
