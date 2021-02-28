<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public $session;
	public $form_validation;
	public $admin;
	public $input;

	/** Constructor dari Class Login */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin', 'admin');
		if ($this->session->userdata('is_login_in') !== TRUE) {
			redirect('login');
		}
	}

	/** Template untuk memanggil view */
	private function _template($data, $view)
	{
		$this->load->view('users/' . $view, $data);
	}

	/** Menampilkan halaman index Member */
	public function index()

	{
			$this->session->set_flashdata('notifikasi', validation_errors());
			$data['title'] = "Dashboard | Myrice - Administrator";
			$data['dataProduk'] = $this->admin->get_data_produk(null);
			$view = 'v_produk';
			$this->_template($data, $view);
	}

	public function hapus($idx=null)
	{
		$cekData = $this->admin->get_data_merek($idx)->num_rows();

		if(!empty($idx)){
			if($cekData != 0){
				$this->admin->hapus_merek($idx);
				$this->session->set_flashdata('notifikasi2', '<div class="alert alert-danger" role="alert">Data berhasil dihapus!</div>');
				redirect('Merek');
			}else{
				redirect('Merek');
			}
		} else {
			redirect('Merek');
		}
	}
}
