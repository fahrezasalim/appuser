<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
  var $table = 'tb_admin';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }  

public function get_all_admin()
{
$this->db->from('tb_admin');
$query=$this->db->get();
return $query->result();
}

  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id_admin',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function admin_add($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function admin_update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id_admin', $id);
    $this->db->delete($this->table);
  }

  public function buat_kode()  
    {
      $this->db->select('RIGHT(tb_admin.id_admin,4) as id_admin', FALSE);
      $this->db->order_by('id_admin','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('tb_admin');      //cek dulu apakah ada sudah ada kode di tabel.    
      if($query->num_rows() <> 0){      
       //jika kode ternyata sudah ada.      
       $data = $query->row();      
       $kode = intval($data->id_admin) + 1;    
      }
      else {      
       //jika kode belum ada      
       $kode = 1;    
      }
      $kodemax = str_pad($kode, 2, "0", STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
      $kodejadi = "AD-1".$kodemax;    // hasilnya ODJ-9921-0001 dst.
      return $kodejadi;  
  }
}
 