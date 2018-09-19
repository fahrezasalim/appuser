<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_access extends CI_Controller {
   public function __construct() 
        {
        //jika belum login redirect ke halaman login
        if ($this->session->userdata('logged')<>1){
            redirect(site_url('login'));
            }
        }

	public function index()
	{
		$data['content'] = 'index/dashboard';
		$this->load->view('template', $data);
	}
}
