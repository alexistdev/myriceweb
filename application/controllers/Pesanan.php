<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan extends CI_Controller {

	public $session;
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
		$data['dataPesanan'] = $this->admin->get_data_pesanan(null);
		$view = 'v_pesanan';
		$this->_template($data, $view);
	}


}
