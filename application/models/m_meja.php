<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_meja extends CI_Model
{
  var $table = 'tb_meja';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }  

public function get_all_meja()
{
$this->db->from('tb_meja');
$query=$this->db->get();
return $query->result();
}

  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id_meja',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function meja_add($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function meja_update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id_meja', $id);
    $this->db->delete($this->table);
  }
}
 