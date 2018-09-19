<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();

        if($this->session->userdata('status') == "login" && $this->session->userdata('level') == "admin"){

        } else {
                 redirect(base_url().'login');
        }
    }

    public function index()
    {
        $data['content'] = 'index/dashboard';
        $this->load->view('template', $data);
    }
}
