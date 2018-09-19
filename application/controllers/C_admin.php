<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_admin extends CI_Controller 
{
      function __construct()
      {
      parent::__construct();
        if($this->session->userdata('status') != "login"){
         redirect(base_url().'login');
      }
		    $this->load->helper('form');
		    $this->load->model('M_admin');    }

	public function index()
	{
		$data['admins']=$this->M_admin->get_all_admin();
		$data['content']='content/v_admin';
		$this->load->view('template',$data);
	}
	public function admin_add()
		{
			$data = array(
				'nama_admin'		=> $this->input->post('nama_admin'),
				'email_admin'	    => $this->input->post('email_admin'),
				'username'		    => $this->input->post('username'),
				'password'		    => md5($this->input->post('passsword')),
				);
			$insert = $this->M_admin->admin_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->M_admin->get_by_id($id);



			echo json_encode($data);
		}

		public function admin_update()
	{
		$data = array(
				'nama_admin'		=> $this->input->post('nama_admin'),
				'email_admin'	    => $this->input->post('email_admin'),
				'username'		    => $this->input->post('username'),
				'password'		    => md5($this->input->post('passsword')),
			);
		$this->M_admin->admin_update(array('id_admin' => $this->input->post('id_admin')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function admin_delete($id)
	{
		$this->M_admin->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
?>