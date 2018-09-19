<?php
class M_kategori extends CI_Model{

  var $table = 'tb_kategori';

  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }
 
  public function get_kategori(){
        $hasil=$this->db->query("SELECT * FROM tb_kategori");
        return $hasil;
    }
    public function get_all_kategori()
	{
	$this->db->from('tb_kategori');
	$query=$this->db->get();
	return $query->result();
	}

  public function get_by_id($id)
  {
    $this->db->from($this->table);
    $this->db->where('id_kategori',$id);
    $query = $this->db->get();

    return $query->row();
  }

  public function kategori_add($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function kategori_update($where, $data)
  {
    $this->db->update($this->table, $data, $where);
    return $this->db->affected_rows();
  }

  public function delete_by_id($id)
  {
    $this->db->where('id_kategori', $id);
    $this->db->delete($this->table);
  }
}