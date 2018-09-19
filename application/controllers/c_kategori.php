<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class c_kategori extends CI_Controller 
{
      function __construct()
      {
      parent::__construct();
        if($this->session->userdata('status') != "login"){
         redirect(base_url().'login');
      }
		    $this->load->helper('form');
		    $this->load->model('m_kategori');    }

	public function index()
	{
		$data['kategoris']=$this->m_kategori->get_all_kategori();
		$data['content']='content/view_kategori';
		$this->load->view('template',$data);
	}
	public function kategori_add()
		{
			$data = array(
				'nama_kategori'		=> $this->input->post('nama_kategori'),
				);
			$insert = $this->m_kategori->kategori_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->m_kategori->get_by_id($id);



			echo json_encode($data);
		}

		public function kategori_update()
	{
		$data = array(
				'nama_kategori'		=> $this->input->post('nama_kategori'),
			);
		$this->m_kategori->kategori_update(array('id_kategori' => $this->input->post('id_kategori')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function kategori_delete($id)
	{
		$this->m_kategori->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
?>