<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Keranjang extends RestController
{
	public $keranjang;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_keranjang', 'keranjang');
	}

//	public function tampil_get()
//	{
//		$idUser = $this->get('idUser');
//		$getData = $this->order->get_data_keranjang($idUser);
//	}

	public function tambah_post()
	{
		$idUser = $this->post('idUser');
		$idProduk = $this->post('idProduk');
		$jumlah = $this->post('jumlah');
		$hargaProduk = $this->post('harga');

		$biayaAntar = 20000;
		$hargaTProduk = $jumlah * $hargaProduk;

		//mengecek terlebih dahulu apakah keranjang ada atau tidak
		$cekTBKeranjang = $this->keranjang->get_data_tambahkeranjang($idUser);

		if($cekTBKeranjang->num_rows() !=0){
			##### saat keranjang ada isinya #####
				//mengecek apakah id_produk sudah ada atau belum
				$cekIdProduk = $this->keranjang->cek_id_produk($idProduk)->num_rows();
				if($cekIdProduk != 0){
					//id produk ada isinya
					echo "id sudah ada coy";
				} else {
					##### saat keranjang idProduk tidak ada #####
					$idKeranjang = $this->keranjang->get_data_tambahkeranjang($idUser)->row()->id_tkeranjang;
					$datakeranjang = [
						'id_krj' => $idKeranjang,
						'id_produk' => $idProduk,
						'jumlah' => $jumlah,
						'sub_total' => $hargaProduk
					];
					$simpanKeranjang = $this->keranjang->simpan_keranjang($datakeranjang);
					if($simpanKeranjang){
						$subTotal = $this->keranjang->get_sub_total($idKeranjang);
						$totalBiayaFix = $subTotal + $biayaAntar;
						//update keranjang belanja total
						$dataTKeranjang = [
							'sub_total' => $subTotal,
							'biaya_antar' => $biayaAntar,
							'total_biaya' => $totalBiayaFix
						];
						$this->keranjang->update_total_keranjang($dataTKeranjang,$idUser);
						$dataResponse = [
							'status' => 'success',
							'message' => 'Data gagal disimpan !',
						];
						$this->response($dataResponse, 200);
					} else{
						$dataResponse = [
							'status' => 'failed',
							'message' => 'Data gagal disimpan !',
						];
						$this->response($dataResponse, 404);
					}
				}

		} else {
			##### saat keranjang tidak ada isinya #####
			//menyimpan ke total_keranjang
			$dataTotalKeranjang = [
				'id_user' => $idUser,
				'sub_total' => $hargaProduk,
				'biaya_antar' => $biayaAntar,
				'total_biaya' => $hargaTProduk
			];
			$idTbKeranjang = $this->keranjang->simpan_total_keranjang($dataTotalKeranjang);
			//menyimpan ke dalam keranjang
			$dataKeranjang =[
				'id_krj' => $idTbKeranjang,
				'id_produk' => $idProduk,
				'jumlah' => $jumlah,
				'sub_total' =>$hargaTProduk
			];
			$simpanKeranjang = $this->keranjang->simpan_keranjang($dataKeranjang);
			if($simpanKeranjang){
				$dataResponse = [
					'status' => 'success',
					'message' => 'Data berhasil disimpan ke dalam tabel total keranjang dan keranjang !',
				];
				$this->response($dataResponse, 200);
			} else{
				$dataResponse = [
					'status' => 'success',
					'message' => 'Data gagal disimpan !',
				];
				$this->response($dataResponse, 404);
			}
		}
	}
}
