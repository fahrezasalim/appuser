<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_v_admin extends CI_Model{
	function tampil_data(){
		$this->db->select('*');
		$this->db->from('tb_admin');

		$query=$this->db->get();
		if ($query->num_rows()>0) {return $query->result();}
		else {return array();}
	}
}
?>
