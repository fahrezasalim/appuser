<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class c_user extends CI_Controller 
{
      function __construct()
      {
      parent::__construct();
        if($this->session->userdata('status') != "login"){
         redirect(base_url().'login');
      }
		    $this->load->helper('form');
		    $this->load->model('m_user');    }

	public function index()
	{
		$data['users']=$this->m_user->get_all_user();
		$data['content']='content/view_user';
		$this->load->view('template',$data);
	}
	public function user_add()
		{
			$data = array(
				'nama_user'		=> $this->input->post('nama_user'),
				'email_user'	    => $this->input->post('email_user'),
				'username'		    => $this->input->post('username'),
				'password'		    => md5($this->input->post('password')),
				);
			$insert = $this->m_user->user_add($data);
			echo json_encode(array("status" => TRUE));
		}
		public function ajax_edit($id)
		{
			$data = $this->m_user->get_by_id($id);



			echo json_encode($data);
		}

		public function user_update()
	{
		$data = array(
				'nama_user'		=> $this->input->post('nama_user'),
				'email_user'	    => $this->input->post('email_user'),
				'username'		    => $this->input->post('username'),
				'password'		    => md5($this->input->post('password')),
			);
		$this->m_user->user_update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function user_delete($id)
	{
		$this->m_user->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}
?>