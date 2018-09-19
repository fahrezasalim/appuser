<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends CI_Controller {
    
        function __construct() 
        {
            parent::__construct();
//            jika belum login redirect ke login
            if ($this->session->userdata('logged')<>1) {
                redirect(site_url('admin'));
            }
        }
    	public function index()
	{
		$data['content']='index/dashboard';
		$this->load->view('template',$data);
	}