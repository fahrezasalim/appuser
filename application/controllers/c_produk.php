<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class C_produk extends CI_Controller 
{
      function __construct()
      {
      parent::__construct();
        if($this->session->userdata('status') != "login"){
         redirect(base_url().'login');
      }
        $this->load->model('m_produk','produk');
        $this->load->model('m_kategori');    
      }
public function index()
      {
        $this->load->helper('url');
        $data['kategori']=$this->m_kategori->get_kategori();
        $data['content']='content/v_produk';
        $this->load->view('template',$data);
      }


public function ajax_list()
      {
        $this->load->helper('url');

        $list = $this->produk->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $produk) {
          $no++;
          $row = array();
          $row[] = $produk->id_produk;
          $row[] = $produk->nama_produk;
          $row[] = $produk->nama_kategori;
          $row[] = $produk->harga_produk;
          if($produk->photo)
            $row[] = '<a href="'.base_url('upload/'.$produk->photo).'" target="_blank"><img src="'.base_url('upload/'.$produk->photo).'" class="img-responsive" /></a>';
          else
            $row[] = '(No photo)';

          //add html for action
          $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$produk->id_produk."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
              <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$produk->id_produk."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
        
          $data[] = $row;
        }

        $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->produk->count_all(),
                "recordsFiltered" => $this->produk->count_filtered(),
                "data" => $data,
            );
        //output to json format
        echo json_encode($output);
      }



  public function ajax_edit($id)
      {
        $data = $this->produk->get_by_id($id);
        echo json_encode($data);
      }

  public function ajax_add() {
       
       $this->_validate();
        
        $data = array(
            'nama_produk' => $this->input->post('nama_produk'),
            'id_kategori' => $this->input->post('kategori'),
            'harga_produk' => $this->input->post('harga_produk'),
          );

     if(!empty($_FILES['photo']['name']))
          {
            $upload = $this->_do_upload();
            $data['photo'] = $upload;
          }

          $insert = $this->produk->save($data);

          echo json_encode(array("status" => TRUE));
        }

 public function ajax_update()
        {
          $this->_validate();
          $data = array(
              'nama_produk' => $this->input->post('nama_produk'),
              'harga_produk' => $this->input->post('harga_produk'),
            );

          if($this->input->post('remove_photo')) // if remove photo checked
              {
                if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
                  unlink('upload/'.$this->input->post('remove_photo'));
                $data['photo'] = '';
              }

          if(!empty($_FILES['photo']['name']))
              {
                $upload = $this->_do_upload();
                
                //delete file
                $produk = $this->produk->get_by_id($this->input->post('id_produk'));
                if(file_exists('upload/'.$produk->photo) && $produk->photo)
                  unlink('upload/'.$produk->photo);

                $data['photo'] = $upload;
              }

          $this->produk->update(array('id_produk' => $this->input->post('id_produk')), $data);
          echo json_encode(array("status" => TRUE));
        }

  public function ajax_delete($id)
  {
    //delete file
    $produk = $this->produk->get_by_id($id);
    if(file_exists('upload/'.$produk->photo) && $produk->photo)
      unlink('upload/'.$produk->photo);
    
    $this->produk->delete_by_id($id);
    echo json_encode(array("status" => TRUE));
  }


    private function _do_upload()
  {
        $config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
            $data['status'] = FALSE;
      echo json_encode($data);
      exit();
    }
    return $this->upload->data('file_name');
  }

  private function _validate()
  {
    $data = array();
    $data['error_string'] = array();
    $data['inputerror'] = array();
    $data['status'] = TRUE;

    if($this->input->post('nama_produk') == '')
    {
      $data['inputerror'][] = 'nama_produk';
      $data['error_string'][] = 'Nama Produk is required';
      $data['status'] = FALSE;
    }

    if($this->input->post('harga_produk') == '')
    {
      $data['inputerror'][] = 'harga_produk';
      $data['error_string'][] = 'Harga produk is required';
      $data['status'] = FALSE;
    }
    if($data['status'] === FALSE)
    {
      echo json_encode($data);
      exit();
    }
  }

 }
?>