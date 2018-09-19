<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_t_admin extends CI_Model{
	function tambah_($data){
		$this->db->set('nama_admin',$data['nama_admin']);
		$this->db->set('username_admin',$data['username_admin']);
		$this->db->set('email_admin',$data['email_admin']);
		$this->db->set('pass_admin',$data['pass_admin']);
		$this->db->insert('tb_admin');
		return $this->db->affected_rows();
	}

	public function getByEmail($email){
    $this->db->where('email_admin',$email);
   	$result = $this->db->get('tb_admin');
    if ($result->num_rows()>0) {
      return true; }
    else {return false;}
  }

	public function getByUsername($username){
    $this->db->where('username_admin',$username);
   	$result = $this->db->get('tb_admin');
    if ($result->num_rows()>0) {
      return true; }
    else {return false;}
  }
}
?>
