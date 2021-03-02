<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_order extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_data_order($idUser)
	{
		$this->db->select("id_order as idOrder,judul,tanggal,total_jumlah as totalOrder, status as statusOrder");
		$this->db->where('id_user', $idUser);
		return $this->db->get("pesanan");
	}

}
