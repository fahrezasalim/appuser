<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	
	function validasi($table,$where){		
		return $this->db->get_where($table,$where);
	}
	
	public function getByEmail($email){
      $this->db->where('email_user',$email);
      $result = $this->db->get('tb_user');
      return $result;
    }
 
    public function simpanToken($data){
      $this->db->insert('tbl_forgot_password', $data);
      return $this->db->affected_rows();
    }
 
    public function cekToken($token){
      $this->db->where('token',$token);
      $result = $this->db->get('tbl_forgot_password');
      return $result;
    }
    
    function ubahData($where,$data_admin,$table){
		$this->db->where($where);
		$this->db->update($table,$data_admin);
		return $this->db->affected_rows();
	}
}
?>