<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
	 * tabel user
	 */
	public function get_data_user($idUser){
		$this->db->join("detail_user", "detail_user.id_user = user.id_user");
		$this->db->where("user.id_user",$idUser);
		return $this->db->get("user");
	}
}
