<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Produk extends RestController {

	public $produk;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_produk', 'produk');
	}

	public function spesial_get()
	{
		$opsi = $this->get('opsi');
		$getData = $this->produk->get_data_spesial($opsi);
		if($getData->num_rows() != 0){
			$dataResponse = [
				'status' => 'success',
				'message' => 'Data berhasil didapatkan !',
				'result' => $getData->result_array()
			];
			$this->response($dataResponse, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'Data kosong!',
				'result' => []
			];
			$this->response($dataResponse, 404);
		}
	}

	public function tampil_get()
	{
		//opsi =1 tampil di halaman depan dengan limit 5
		//opsi = 2 tampilkan semua
		//opsi = 3 tampilkan berdasarkan kategori
		$idKategori = $this->get('idKategori');
		$opsi = $this->get('opsi');
		$getData = $this->produk->get_data_produk($opsi,$idKategori);
		if($getData->num_rows() != 0){
			$dataResponse = [
				'status' => 'success',
				'message' => 'Data berhasil didapatkan !',
				'result' => $getData->result_array()
			];
			$this->response($dataResponse, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'Data kosong!',
				'result' => []
			];
			$this->response($dataResponse, 404);
		}
	}
}
