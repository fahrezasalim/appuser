<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_h_admin extends CI_Model{
	function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
	}
}
?>
