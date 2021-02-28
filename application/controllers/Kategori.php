<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
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
		$this->form_validation->set_rules(
			'namaKategori',
			'namaKategori',
			'trim|required',
			[
				'required' => 'Username harus diisi!'
			]
		);
		$this->form_validation->set_rules(
			'deskripsi',
			'deskripsi',
			'trim|required',
			[
				'required' => 'Username harus diisi!'
			]
		);
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger" role="alert">', '</div>');
		if ($this->form_validation->run() === false) {
			$this->session->set_flashdata('notifikasi', validation_errors());
			$data['title'] = "Dashboard | Myrice - Administrator";
			$data['dataKategori'] = $this->admin->get_data_kategori(null);
			$view = 'v_kategori';
			$this->_template($data, $view);
		} else {
			$namaKategori = $this->input->post('namaKategori', TRUE);
			$deskripsi = $this->input->post('deskripsi', TRUE);
			$dataKategori = [
				'nama_kategori' => $namaKategori,
				'deskripsi' => $deskripsi
			];
			$this->admin->simpan_kategori($dataKategori);
			$this->session->set_flashdata('notifikasi2', '<div class="alert alert-success" role="alert">Berhasil Menambah data kategori!</div>');
			redirect('Kategori');
		}
	}

	public function hapus($idx=null)
	{
		$cekData = $this->admin->get_data_kategori($idx)->num_rows();
		if(!empty($idx)){
			if($cekData != 0){
				$this->admin->hapus_kategori($idx);
				$this->session->set_flashdata('notifikasi2', '<div class="alert alert-danger" role="alert">Data berhasil dihapus!</div>');
				redirect('Kategori');
			}else{
				redirect('Kategori');
			}
		} else {
			redirect('Kategori');
		}
	}

	/** Method untuk Logout */
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
