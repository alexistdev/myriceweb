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

	public function tampil_get()
	{
		$idUser = $this->get('idUser');
		$idKrj = $this->keranjang->get_data_tambahkeranjang($idUser)->row()->id_tkeranjang;
		$getData = $this->keranjang->get_data_keranjang($idKrj);
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

					##### saat keranjang idProduk ada maka akan diperbaharui jumlahnya#####
					$jumlahProduk = $this->keranjang->cek_id_produk($idProduk)->row()->jumlah;
					$NewJumlah = $jumlah + $jumlahProduk;
					$NewHarga = $NewJumlah * $hargaProduk;
					$dataKeranjangNew = [
						'jumlah' => $NewJumlah,
						'sub_total' => $NewHarga
					];
					$this->keranjang->update_keranjang($dataKeranjangNew, $idProduk);
					$idKeranjang = $this->keranjang->get_data_tambahkeranjang($idUser)->row()->id_tkeranjang;
					$subTotal = $this->keranjang->get_sub_total($idKeranjang);
					$totalBiayaFix = $subTotal + $biayaAntar;
					$dataTotalKeranjangNew = [
						'sub_total' => $subTotal,
						'biaya_antar' => $biayaAntar,
						'total_biaya' => $totalBiayaFix
					];
					$this->keranjang->update_total_keranjang($dataTotalKeranjangNew,$idUser);
					$dataResponse = [
						'status' => 'success',
						'message' => 'Data berhasil diupdate !',
					];
					$this->response($dataResponse, 200);
				} else {
					##### saat keranjang idProduk tidak ada maka akan ditambahkan ke dalam data keranjang#####
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
							'message' => 'Data berhasil diupdate !',
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
				'total_biaya' => $hargaTProduk+$biayaAntar
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
					'status' => 'failed',
					'message' => 'Data gagal disimpan !',
				];
				$this->response($dataResponse, 404);
			}
		}
	}

	public function ubah_post()
	{
		$idUser = $this->post('idUser');
		$idProduk = $this->post('idProduk');
		$opsi = $this->post('opsi');

		$dataKeranjang = $this->keranjang->get_keranjang_byidproduk($idProduk)->row();
		//$biayaAntar = 20000;
		$hargaProduk = $dataKeranjang->hargaProduk;
		$jumlah = $dataKeranjang->jumlah;
		$idKrj = $dataKeranjang->id_krj;
		switch ($opsi) {
			### Menambahkan jumlah produk ###
			case 1:
				$jumlah++;
				$subTotalHarga = $jumlah * $hargaProduk;
				//update keranjang
				$dataKeranjang = [
					'jumlah' => $jumlah,
					'sub_total' => $subTotalHarga
				];
				$this->keranjang->update_keranjang($dataKeranjang, $idProduk);
				//update data total_keranjang
				$subTotal = $this->keranjang->get_sub_total($idKrj);
				$dataTotalKeranjang = [
					'sub_total' => $subTotal,
					'total_biaya' => $subTotal+20000
				];
				$this->keranjang->update_total_keranjang($dataTotalKeranjang,$idUser);
				$dataResponse1 = [
					'status' => "success",
					'message' => 'Produk ditambahkan !',
				];
				$this->response($dataResponse1, 200);
				break;
			case 2:
				$jumlah--;
				$subTotalHarga = $jumlah * $hargaProduk;
				//update keranjang
				$dataKeranjang = [
					'jumlah' => $jumlah,
					'sub_total' => $subTotalHarga
				];
				$this->keranjang->update_keranjang($dataKeranjang, $idProduk);
				//update data total_keranjang
				$subTotal = $this->keranjang->get_sub_total($idKrj);
				$dataTotalKeranjang = [
					'sub_total' => $subTotal,
					'total_biaya' => $subTotal+20000
				];
				$this->keranjang->update_total_keranjang($dataTotalKeranjang,$idUser);
				$dataResponse2 = [
					'status' => "success",
					'message' => 'Produk dikurangi !',
				];
				$this->response($dataResponse2, 200);
				break;
			case 3:
				break;
			default:
				$dataResponse = [
					'status' => 'failed',
					'message' => 'Gagal Mendapatkan Data !',
				];
				$this->response($dataResponse, 404);
				break;
		}
	}

	public function total_get()
	{
		$idUser = $this->get('idUser');
		$getData = $this->keranjang->get_data_totalkeranjang($idUser);
		if($getData->num_rows() != 0){
			$rowData = $getData->row();
			$data['subTotalKeranjang'] = $rowData->sub_total;
			$data['biayaAntarKeranjang'] = $rowData->biaya_antar;
			$data['totalBiayaKeranjang'] = $rowData->total_biaya;
			$data['status'] = "success";
			$data['message'] = "Berhasil mendapatkan data!";

			$this->response($data, 200);

		}else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'Gagal Mendapatkan Data !',
			];
			$this->response($dataResponse, 404);
		}
	}
}
