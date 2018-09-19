<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class c_meja extends CI_Controller 
{
      function __construct()
      {
      parent::__construct();
        if($this->session->userdata('status') != "login"){
         redirect(base_url().'login');
      }
		    $this->load->helper('form');
		    $this->load->model('m_meja');    }

	public function index()
	{
		$data['mejas']=$this->m_meja->get_all_meja();
		$data['content']='content/view_meja';
		$this->load->view('template',$data);
	}
	public function meja_add()
		{
			$data = array(
				'nama_meja'		=> $this->input->post('nama_meja'),
				'status'	    => 0,
				);
			$insert = $this->m_meja->meja_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->m_meja->get_by_id($id);



			echo json_encode($data);
		}

		public function meja_update()
	{
		$data = array(
				'nama_meja'		=> $this->input->post('nama_meja'),
			);
		$this->m_meja->meja_update(array('id_meja' => $this->input->post('id_meja')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function meja_delete($id)
	{
		$this->m_meja->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
?>