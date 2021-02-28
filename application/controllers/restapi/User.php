<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController {

	public $userm;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_user', 'userm');
	}

	public function login_post()
	{
		$email = $this->post('email');
		$password = md5($this->post('password'));
		$cekLogin = $this->admin->cek_login($email,$password);
		if($cekLogin->num_rows() != 0){
			$dataSession = [
				'id_user' => $cekLogin->row()->id_user
			];
			$this->response($dataSession, 200);
		}else{
			$this->response([
				'message' => 'Username atau Password yang anda masukkan salah'
			], 404);
		}
	}

	public function akun_get()
	{
		$idUser = $this->get('id_user');
		$dataUser = $this->userm->get_data_user($idUser);
		if($dataUser->num_rows() != 0){
			foreach($dataUser->result_array() as $row){
				$data['status'] = "success";
				$data['message'] = "berhasil";
				$data['namaUser'] =$row['nama'];
				$data['alamatUser'] =$row['alamat'];
				$data['kecamatanUser'] =$row['kecamatan'];
				$data['kabupatenUser'] =$row['kabupaten'];
				$data['provinsiUser'] =$row['provinsi'];
				$data['kodepos'] =$row['kodepos'];
				$data['telp'] =$row['telp'];
				$data['emailUser'] =$row['email'];
			};
			$this->response($data, 200);
		} else {
			$dataResponse = [
				'status' => 'failed',
				'message' => 'User tidak ditemukan, silahkan logout dan login ulang!'
			];
			$this->response($dataResponse, 404);
		}
	}
}
