<?php

class Login extends CI_Controller {

	public function index(){
		$this->load->view('login');
	}

    function __construct(){
         parent::__construct();
		 $this->load->helper('form');
		 $this->load->model('M_login','',TRUE);
    }

    public function login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$where = array(
			'username' => $username,
			'password' => $password
			);

		// menjalankan validasi

            $cek = $this->M_login->validasi('tb_user',$where)->num_rows();
            $kepo['data'] = $this->M_login->validasi('tb_user',$where)->result();
		    if($cek > 0){

            foreach ($kepo['data'] as $row){
              $data_session = array(
                'id_user' => $row->id_user,
                'nama_user' => $row->nama_user,
                'status' => 'login',
                'level' => 'admin'
              );
            }

			$this->session->set_userdata($data_session);
			redirect(base_url().'admin');
            }
		    else{
		        $this->session->set_flashdata('style', 'danger');
                $this->session->set_flashdata('alert', 'Email atau password anda salah!');
                $this->session->set_flashdata('message', 'Cek kembali email dan password anda');
			    redirect(base_url().'Login');
        }
	}

    public function logout() {
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

}
