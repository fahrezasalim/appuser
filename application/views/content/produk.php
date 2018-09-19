<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | CV. IRZAH</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <?php include 'application/views/style.php'?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include 'application/views/topbar.php'?>
  <!-- Left side column. contains the logo and sidebar -->
<?php include 'application/views/navigasi.php'?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Slider
        <small>Data Slider</small>
      </h1>
      <ol class="breadcrumb">
		<li><a href="<?php echo base_url();?>welcome"><i class="fa fa-dashboard"></i>Home</a></li>	
        <li class="active">Slider</li>
      </ol>
    </section>

    <!-- Main content -->
                <section class="content">
                    <?php if($this->session->flashdata('message')){?>
                	<div class="alert alert-block alert-info">
                    	<button type="button" class="close" data-dismiss="alert">
                        	<i class="ace-icon fa fa-times"></i>
                        </button>
                        <strong class="green">
                        	<?php echo $this->session->flashdata('message')?>
                        </strong>
                    </div>
                    <?php }?>
					 <a class="btn btn-success btn-sm" href="<?php echo base_url()?>produk/add"><i class="fa fa-plus bigger-130"></i> Tambah Data</a>
                    <div class="col-md-3 pull-right">
                        <form action="<?=base_url()?>slider/view_slider/cari" method="get">
                            <div class="input-group">
                                <input type="text" name="key" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">cari</button>
                                    </span>
                            </div>
                        </form>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Data slider</h3>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="example" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
						                <th data-field="no" data-sortable="true" width="10px">No</th>
						                 <th data-field="id_pegawai" data-sortable="true">Id Produk</th>
						                 <th data-field="nama_pegawai" data-sortable="true">Kategori</th>
						                 <th data-field="alamat" data-sortable="true">Nama Produk</th>
										 <th data-field="gambar_produk" data-sortable="true">Gambar</th>
						                 <th data-field="jenis_kelamin" data-sortable="true">Harga</th>
						                 <th>Aksi</th>
						                 </tr>
                                        </thead>
                                        <tbody>
										<?php $no = 0; foreach($dataproduk as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="nik"><?php echo $row->id_produk;?></td>
						        <td data-field="nama"><?php echo $row->nama_kategori;?></td>
						        <td data-field="alamat"><?php echo $row->nama_produk;?></td>
								<td align="center"><img src="<?php echo base_url()?>/images/produk/<?php echo $row->gambar_produk;?>" width="50px" height="50px"></td>
						        <td data-field="jk"><?php echo $row->harga;?></td>
						        <td> 
<a class="ubah btn btn-primary btn-xs" href="<?php echo base_url();?>produk/edit/<?php echo $row->id_produk;?>"><span class="glyphicon glyphicon-edit" ></span></a>
<a data-toggle="modal"  title="Hapus Kontak" class="hapus btn btn-danger btn-xs" href="#modKonfirmasi" data-id="<?php echo $row->id_produk;?>"><span class="glyphicon glyphicon-trash"></span></a>
</td>
						    </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
							<?php echo $this->session->flashdata("msg");?>

	
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						                });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>

						<?php $this->load->view('konfirmasi');?>

<script type="text/javascript">
$(document).ready(function(){

$(".hapus").click(function(){
var id = $(this).data('id');

$(".modal-body #mod").text(id);

});

});
</script>


                </section>
    <!-- /.content -->
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 Almsaeed Studio.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
<!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
<!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php include 'application/views/jscript.php'?>
<!-- jQuery 2.2.3 -->
</body>
</html>
