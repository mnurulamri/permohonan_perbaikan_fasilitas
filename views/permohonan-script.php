<script>

$(document).ready(function() {
	
	// set CK editor
	CKEDITOR.replace('lokasi')
	CKEDITOR.replace('jenis-perbaikan')
	CKEDITOR.replace('jumlah')
	CKEDITOR.replace('keterangan')
	
    function getDataListPerbaikan(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/ajaxListPerbaikan",
            //dataType: "html",
            success: function(data) {
                $("#data-list-perbaikan").html(data)
            }
        })
    }

    $(document).on('click', '#form-input', function()
    {   
        $("#modal-input").modal("show")

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getKodePerbaikan",
            //dataType:text,
            success: function(data) {
                $("#kd_perbaikan").val(data);
            }    
        })
    });

    $(document).on('click', '#tambah', function()
    {  
        $("#modal-tambah").modal("show")

        $("#lokasi").val('')
        $("#jenis-perbaikan").val('')
        $("#jumlah").val('')
        $("#keterangan").val('')

    });

    $(document).on('click', '#simpan-rincian-perbaikan', function()
    {  
        var kd_perbaikan = $("#kd_perbaikan").val()
        var nip = $("#nip").val()
        var kodebidang = $("#kodebidang").val()

        var lokasi = $("#lokasi").val()
        var jenis_perbaikan = $("#jenis-perbaikan").val()
        var jumlah = $("#jumlah").val()
        var keterangan = $("#keterangan").val()

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/simpanRincian",
            data: {kd_perbaikan:kd_perbaikan, nip:nip, kodebidang:kodebidang, lokasi:lokasi, jenis_perbaikan:jenis_perbaikan, jumlah:jumlah, keterangan:keterangan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                $("#data-rincian").html(data);
                setTimeout(function() { $("#modal-tambah").modal("hide"); }, 100);
                getDataListPerbaikan()
                
                //$(".alert-pesan").fadeIn();
                //$(".alert-pesan").html(data);
                //$(".alert-pesan").fadeOut(2300); 
            }   
        })

    });

    $(document).on('click', '.ajukan-list', function()
    {  
        $(".modal-ajukan").modal("show")
        var kd_perbaikan = $(this).data("id")
        $("#id_ajukan").val(kd_perbaikan)

        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanView",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                $("#data-rincian-view").html(data);
            },
            complete: function(data) {
                //setTimeout(function() { $('#modal-form-add').modal('hide'); }, 2300);
            }           
        })

    });

    $(document).on('click', '#ajukan-permohonan', function()
    {  
        var kd_perbaikan = $("#id_ajukan").val()
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/ajukanPermohonan",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
				setTimeout(function() { $('.modal-ajukan').modal('hide'); }, 100);
                $("#status_"+kd_perbaikan).html(data);
                $("#kolom-aksi_"+kd_perbaikan).html('<div class="view btn btn-warning btn-xs" data-id="'+kd_perbaikan+'">View</div>');
				/*$("#kolom-aksi-ajukan_"+kd_perbaikan).html('<div class="view btn btn-warning btn-xs">View</div>');
				$("#kolom-aksi-edit_"+kd_perbaikan).html("");
				$("#kolom-aksi-delete_"+kd_perbaikan).html("");*/
            }          
        })
    })

    $(document).on('click', '.edit-list', function()
    {  
        var kd_perbaikan = $(this).data("id")
		$("#id_edit").val(kd_perbaikan)
		$(".modal-edit").modal("show")

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanEdit",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                $("#data-rincian-edit").html(data);
            },
            complete: function(data) {
                //setTimeout(function() { $('#modal-form-add').modal('hide'); }, 2300);
            }           
        })
    });

    $(document).on('click', '.delete-list-confirm', function()
    {  
        var kd_perbaikan = $(this).data("id")
		$("#id_delete").val(kd_perbaikan)
		$(".modal-delete").modal("show")

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanView",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                $("#konfirm-data-rincian").html(data);
            }
        })
    });

	$(document).on('click', '.delete-list', function()
    {  
        var kd_perbaikan = $("#id_delete").val()

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/deleteListPerbaikan",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                //$("#pesan-delete-list").html(data);
                $("#pesan-delete-list").fadeIn();
                $("#pesan-delete-list").html(data);
                $("#pesan-delete-list").fadeOut(100);

                //get data list perbaikan
                getDataListPerbaikan();
            }
        })
		
		$("#pesan-delete-list").html('');

		setTimeout(function() { $('.modal-delete').modal('hide'); }, 100);
    });

	$(document).on('click', '.edit-rincian', function()
    { 
		var id = $(this).data("id")
		$("#id_edit_detail").val(id)
		$("#modal-edit-rincian").modal("show")

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanDetail",
            data: {id:id},
            dataType: "json",
            success: function(data) {
                console.log(data)
				//alert(data.lokasi)
                $("#edit-lokasi").val(data.lokasi);
				$("#edit-jenis-perbaikan").val(data.jenis_perbaikan);
				$("#edit-jumlah").val(data.jumlah);
				$("#edit-keterangan").val(data.keterangan);
            }     
        })
	})

	$(document).on('click', '.delete-rincian', function()
    {
    	var r = confirm("Anda yakin akan menghapus data?");
		
		if (r == true) 
		{
			var id = $(this).data("id")
    		
			$.ajax({
	            type: "POST",
	            url: "<?php echo base_url(); ?>perbaikan/permohonan/deleteRincianPerbaikanDetail",
	            data: {id:id},
	            success: function(data) {
					$.ajax({
			            type: "POST",
			            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanEdit",
			            data: {kd_perbaikan:data},
			            dataType: "html",
			            success: function(data) {
			                $("#data-rincian-edit").html(data);
			            }
			        })
			
					getDataListPerbaikan();
			
	            }     
	        })
		}
    	
    })

	$(document).on('click', '#simpan-edit-rincian', function()
    { 
		var id = $("#id_edit_detail").val()
		var lokasi = $("#edit-lokasi").val()
		var jenis_perbaikan = $("#edit-jenis-perbaikan").val()
		var jumlah = $("#edit-jumlah").val()
		var keterangan = $("#edit-keterangan").val()

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/editRincianPerbaikanDetail",
            data: {id:id, lokasi:lokasi, jenis_perbaikan:jenis_perbaikan, jumlah:jumlah, keterangan:keterangan},
            dataType: "json",
            success: function(data) {
                console.log(data)
				//alert("#lokasi_"+id)
                $("#lokasi_"+id).html(data.lokasi);
				$("#jenis-perbaikan_"+id).html(data.jenis_perbaikan);
				$("#jumlah_"+id).html(data.jumlah);
				$("#keterangan_"+id).html(data.keterangan);
				
				$.ajax({
					type: "POST",
            		url: "<?php echo base_url(); ?>perbaikan/permohonan/ajaxListPerbaikan",
					success: function(data) {
						$("#data-list-perbaikan").html(data)
					}
				})

				setTimeout(function() { $("#modal-edit-rincian").modal("hide"); }, 100);
            }     
        })

	})

	$(document).on('click', '#tambah-edit', function()
    {
		$("#modal-tambah-edit").modal("show")
	})

	$(document).on('click', '#simpan-tambah-edit-rincian-perbaikan', function()
	{ 
		var kd_perbaikan = $("#id_edit").val()
		var lokasi = $("#tambah-edit-lokasi").val()
		var jenis_perbaikan = $("#tambah-edit-jenis-perbaikan").val()
		var jumlah = $("#tambah-edit-jumlah").val()
		var keterangan = $("#tambah-edit-keterangan").val()
		
		//alert(kd_perbaikan+lokasi+jenis_perbaikan+jumlah+keterangan)

		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/tambahRincianPerbaikan",
            data: {kd_perbaikan:kd_perbaikan, lokasi:lokasi, jenis_perbaikan:jenis_perbaikan, jumlah:jumlah, keterangan:keterangan},
            dataType: "json",
            success: function(data) {
				
				$.ajax({
					type: "POST",
            		url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanEdit",
            		data: {kd_perbaikan:kd_perbaikan},
					success: function(data) {
						$("#data-rincian-edit").html(data)
					}
				})
				
				setTimeout(function() { $("#modal-tambah-edit").modal("hide"); }, 100);
				
				getDataListPerbaikan()
            }     
        })
	})

	$(document).on('click', '.view', function()
    { 
		var kd_perbaikan = $(this).data("id")
		$("#modal-view").modal("show")
		
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanView",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                console.log(data)
                $("#data-rincian-view-2").html(data);
            }
        })
	})
})
</script>