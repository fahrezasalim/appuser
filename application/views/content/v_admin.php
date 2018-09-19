  <link href="<?php echo base_url('asset/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Admin</h3>
            </div>
            <!-- /.box-header -->
             <div class="box-footer">
             <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i> Tambah Admin</button>
             </div>
            <div class="box-body">

              <table id="table_id" class="table table-bordered table-striped">
              <thead>
                <tr>
                 <th>ID</th>
                 <th>Nama</th>
                 <th>Email</th>
                 <th>Username</th>
                 <th style="width:125px;">Action</p></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach($admins as $row){?>
               <tr>
                 <td><?php echo $row->id_admin; ?></td>
                 <td><?php echo $row->nama_admin;?></td>
                 <td><?php echo $row->email_admin;?></td>
                 <td><?php echo $row->username;?></td>
                 <td>
                <button class="btn btn-primary btn" onclick="edit_admin(<?php echo $row->id_admin;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                <button class="btn btn-danger btn" onclick="delete_admin(<?php echo $row->id_admin;?>)"><i class="glyphicon glyphicon-remove"></i></button>
                </td>
              </tr>
             <?php }?>
             </tbody>
                <tfoot>
                <tr>
                 <th>ID</th>
                 <th>Nama</th>
                 <th>Email</th>
                 <th>Username</th>
                 <th style="width:125px;">Action</p></th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
  </div>
  <script src="<?php echo base_url('asset/jquery/jquery-3.1.0.min.js')?>"></script>
  <script src="<?php echo base_url('asset/bootstrap/js/bootstrap.min.js')?>"></script>
  <script src="<?php echo base_url('asset/datatables/js/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('asset/datatables/js/dataTables.bootstrap.js')?>"></script>
    <script type="text/javascript">
  $(document).ready( function () {
      $('#table_id').DataTable();
  } );
    var save_method; //for save method string
    var table;


    function add()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
    //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
    }

    function edit_admin(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/c_admin/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id_admin"]').val(data.id_admin);
            $('[name="nama_admin"]').val(data.nama_admin);
            $('[name="email_admin"]').val(data.email_admin);
            $('[name="username"]').val(data.username);
            $('[name="password"]').val(data.password);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit admin'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }



    function save()
    {
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('index.php/c_admin/admin_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/c_admin/admin_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

    function delete_admin(id)
    {
      if(confirm('Anda Yakin ingin Menghapus Data ini?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('index.php/C_admin/admin_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>
  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">admin Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id_admin"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama_admin" placeholder="nama lengkap" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Email</label>
              <div class="col-md-9">
                <input type="email" name="email_admin" placeholder="email" class="form-control" type="text">
              </div> 
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Username</label>
              <div class="col-md-9">
                <input name="username" placeholder="@username" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input name="password" placeholder="password" class="form-control" type="password">
              </div>
            </div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    </section>
    <!-- /.content -->