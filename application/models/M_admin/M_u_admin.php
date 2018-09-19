<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_u_admin extends CI_Model{

	function edit_data($id,$table){
		$this->db->where('id_admin', $id);
		return $this->db->get($table);
	}

	function update_data($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	public function getByEmail($email,$id){
		$this->db->where('id_admin !=', $id);
    $this->db->where('email_admin',$email);
   	$result = $this->db->get('tb_admin');
    if ($result->num_rows()>0) {
      return true; }
    else {return false;}
  }

	public function getByUsername($username,$id){
		$this->db->where('id_admin !=', $id);
    $this->db->where('username_admin',$username);
   	$result = $this->db->get('tb_admin');
    if ($result->num_rows()>0) {
      return true; }
    else {return false;}
  }
}
?>
