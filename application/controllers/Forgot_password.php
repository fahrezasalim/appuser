<?php

class Forgot_password extends CI_Controller {

	function __construct(){
         parent::__construct();
		 $this->load->helper('form');
		 $this->load->model('M_login','',TRUE);
         $this->load->model('M_user/m_v_user');
    }

	public function index()
	{
		$this->load->view('admin/login/forgot_password');
	}

	public function kirim_email(){
  date_default_timezone_set("Asia/jakarta");

  $email = $this->input->post('email');

  $rs = $this->M_login->getByEmail($email);

  // cek email ada atau engga
  if (!$rs->num_rows() > 0){
    $this->session->set_flashdata('style', 'danger');
    $this->session->set_flashdata('alert', 'Email tidak ditemukan!');
    $this->session->set_flashdata('message', 'Cek kembali email yang terdaftar.');

    redirect ('forgot_password');
  }

  $user = $rs->row();

  // get id user
  $user_token = $user->id_admin;

  //create valid dan expire token
  $date_create_token = date("Y-m-d H:i");
  $date_expired_token = date('Y-m-d H:i',strtotime('+2 hour',strtotime($date_create_token)));

  // create token string
  $tokenstring = md5(sha1($user_token.$date_create_token));

  // simpan data token
  $data = array('token'=>$tokenstring,'id_admin'=>$user_token,'created'=>$date_create_token,'expired'=>$date_expired_token);
  $simpan = $this->M_login->simpanToken($data);

  if ($simpan > 0){

    // email link reset
    $config['protocol'] = "smtp";
    $config['smtp_host'] = "ssl://smtp.gmail.com";
    $config['smtp_port'] = "465";
    $config['smtp_user'] = "mfahmirizal48@gmail.com";
    $config['smtp_pass'] = "SembaranG96";
    $config['wordwrap']  = TRUE;
    $config['wrapchars'] = 80;
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";

    $this->email->initialize($config);

    $this->email->from('mfahmirizal48@gmail.com', 'Putri Tunggal');
    $this->email->to($email);
    $this->email->subject('Reset Password');

    $this->email->message("
       Token ini berlaku untuk 2 jam dari pengiriman token ini:
       Klik disini untuk reset password anda : http://tesca.000webhostapp.com/forgot_password/reset/token/".$tokenstring
    );

    if (!$this->email->send()) {
        echo $this->email->print_debugger();
        exit;
    } 
        $this->session->set_flashdata('style', 'success');
        $this->session->set_flashdata('alert', 'Berhasil !');
        $this->session->set_flashdata('message', 'Silahkan cek email anda');
        redirect ('login');


    
  }
}

	public function reset(){
      date_default_timezone_set("Asia/jakarta");
      $token = $this->uri->segment(4);

      // get token ke nodel user
      $cekToken = $this->M_login->cekToken($token);
      $rs = $cekToken->num_rows();

      // cek token ada atau engga
      if ($rs > 0){

        $data = $cekToken->row();
        $tokenExpired = $data->expired;
        $timenow = date("Y-m-d H:i:s");

        // cek token expired atau engga
        if ($timenow < $tokenExpired){

          // tampilkan form reset
          $datatoken['token'] = $token;
          $this->load->view('admin/login/password_reset',$datatoken);

        }else{

          // redirect form forgot
          $this->session->set_flashdata('style', 'danger');
          $this->session->set_flashdata('alert', 'Maaf, Token Anda Sudah Expired!');
          $this->session->set_flashdata('message', 'Coba masukkan email anda kembali');

          redirect ('forgot_password');
        }
      }
    }

    public function kirim_reset(){
        $password = $this->input->post('password');
        $token = $this->input->post('token');
        $cekToken = $this->M_login->cekToken($token);
        $data = $cekToken->row();
        $id =  $data->id_admin;
        $where = array (
            'id_admin'     =>  $id,
        );

      // ubah password
      $data = array ('pass_admin'=>md5($password));

      if ($this->M_login->ubahData($where,$data,'tb_admin')){
        $this->session->set_flashdata('style', 'success');
        $this->session->set_flashdata('alert', 'Password Berhasil Dirubah!');
        $this->session->set_flashdata('message', 'Silahkan login kembali');
      }else{
        $this->session->set_flashdata('style', 'danger');
        $this->session->set_flashdata('alert', 'Password Gagal Dirubah');
        $this->session->set_flashdata('message', 'Pertanyaan atau Jawaban Anda Salah');
      }
      redirect(base_url().'Login');
    }
}
