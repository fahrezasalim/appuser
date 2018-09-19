    <script>
    $('table#example1 td #hapus_admin').button().click(function(e){
      var id = $(this).parent().parent().attr('id');
      var data = 'id_admin=' + id ;
      var parent = $(this).parent().parent();
				swal({
	                          title: "Apakah Anda Yakin?",
	                          text: "Data Yang Terhapus Tidak Dapat Dikembalikan",
                            type: "warning",
	                          showCancelButton: true,
	                          confirmButtonColor: "#ec6c62",
	                          confirmButtonText: "Ya",
                            cancelButtonText: 'Tidak',
	                          closeOnConfirm: false,
	                          showLoaderOnConfirm: true,
          				}, function () { //apabila sweet alert d confirm maka akan mengirim data ke simpan.php melalui proses ajaxd
		                $.ajax({
                        type: 'POST',
		                    url: "<?php echo base_url()?>C_admin/delete_admin",
                        data: { 'id':id },
		                    cache: false,
		                    success: function(kepo){
                          if (kepo == 0){ //pada file check email.php, apabila email sudah ada di database makan akan mengembalikan nilai 0
                            setTimeout(function(){
                              swal({
                                title:"Admin Sedang Login",
                                text: "Tidak Dapat Menghapus Admin yang Sedang Login",
                                type: "error"
                              });
                            }, 2000);
                          } else if (kepo == 1) {
                            setTimeout(function(){
                              swal({
                                title:"Data Berhasil Di Hapus",
                                type: "success"
                              }, function(){
                                parent.fadeOut('slow', function() {$(this).remove();});;
                              });
                            }, 2000);
                          }
                        }
				});
           		});
		});
    </script>