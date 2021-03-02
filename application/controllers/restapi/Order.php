<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Order extends RestController
{

	public $order;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_order', 'order');
	}

	public function tampil_get()
	{
		$idUser = $this->get('idUser');
		$getData = $this->order->get_data_order($idUser);
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
