<script>

$(document).ready(function() {

	// set CK editor
	CKEDITOR.replace('catatan_koordinator')

	//menampilkan view data approval
	$(document).on("click", ".approval-list", function()
	{
		var kd_perbaikan = $(this).data("id")
		var tgl_permohonan = $(this).data("tgl_permohonan")
		var nip_pemohon = $(this).data("nip_pemohon")
		var nama_pemohon = $(this).data("nama_pemohon")
		var nip_approval_unit = $(this).data("nip_approval_unit")
		
		$("#approvalKoordinatorModal").modal("show")
		
		$("#kd_perbaikan").val(kd_perbaikan)
		$("#tgl_permohonan").text(tgl_permohonan)
		$("#nip_pemohon").text(nip_pemohon)
		$("#nama_pemohon").text(nama_pemohon)

		// set nama kepala unit
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/persetujuan_unit/getViewKepalaUnit",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "json",
            success: function(data) {
				$("#nip_pejabat").text(data.nip_pejabat)
				$("#nama_pejabat").text(data.nama_pejabat)
				$("#nip_pejabat").text(data.nip_pejabat)
				$("#unit_kerja").text(data.unit_kerja)
				$("#telp").text(data.telp)
				$("#email").text(data.email)
            }
        })

		//set rincian perbaikan
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/permohonan/getRincianPerbaikanView",
            data: {kd_perbaikan:kd_perbaikan},
            dataType: "html",
            success: function(data) {
                $("#data-rincian").html(data);
            }
        })
	})
	
	$(document).on('click', '.view', function()
    { 
    	//kosongkan data
		$("#view_tgl_permohonan").text('')
		$("#view_nip_pemohon").text('')
		$("#view_nama_pemohon").text('')
		$("#view_nip_pejabat").text('')
		$("#view_nama_pejabat").text('')
		$("#view_unit_kerja").text('')

		// set data
		var kd_perbaikan = $(this).data("id")
		var tgl_permohonan = $(this).data("tgl_permohonan")
		var nip_pemohon = $(this).data("nip_pemohon")
		var nama_pemohon = $(this).data("nama_pemohon")
		
		$("#view_tgl_permohonan").text(tgl_permohonan)
		$("#view_nip_pemohon").text(nip_pemohon)
		$("#view_nama_pemohon").text(nama_pemohon)
		
		// set data pejabat / kepala unit
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/persetujuan_unit/getViewKepalaUnit",
            data: {kd_perbaikan:kd_perbaikan},
           dataType: "json",
            success: function(data) {

				$("#view_nip_pejabat").text(data.nip_pejabat)
				$("#view_nama_pejabat").text(data.nama_pejabat)
				$("#view_unit_kerja").text(data.unit_kerja)
            }
			
		})
		
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
	
	$(document).on('click', '.view-direct', function()
    { 
    	//kosongkan data
		$("#view_tgl_permohonan").text('')
		$("#view_nip_pemohon").text('')
		$("#view_nama_pemohon").text('')
		$("#view_nip_pejabat").text('')
		$("#view_nama_pejabat").text('')
		$("#view_unit_kerja").text('')
		
		// set data pemohon
		var tgl_permohonan = $(this).data("tgl_permohonan")
		var nip_pemohon = $(this).data("nip_pemohon")
		var nama_pemohon = $(this).data("nama_pemohon")
		
		$("#view_tgl_permohonan").text(tgl_permohonan)
		$("#view_nip_pemohon").text(nip_pemohon)
		$("#view_nama_pemohon").text(nama_pemohon)
		
		
		var kd_perbaikan = $(this).data("id")
		
		// set data pejabat / kepala unit
		$.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>perbaikan/persetujuan_unit/getViewKepalaUnit",
            data: {kd_perbaikan:kd_perbaikan},
           dataType: "json",
            success: function(data) {

				$("#view_nip_pejabat").text(data.nip_pejabat)
				$("#view_nama_pejabat").text(data.nama_pejabat)
				$("#view_unit_kerja").text(data.unit_kerja)
            }
			
		})
		
		// ambil data rincian
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
		
		$("#modal-view").modal("show")

    })

	$(document).on("click", "#submit", function()
	{
		var kd_perbaikan = $("#kd_perbaikan").val()
		var catatan = $("#catatan_"+kd_perbaikan).html()
		
		CKEDITOR.instances.catatan_koordinator.setData(catatan);
		$("#catatanKoordinatorModal").modal("show")
		
	})

	$(document).on("click", "#simpan-catatan", function(){
		
		var r = confirm("Anda yakin data permohonan sudah diperiksa?");
		
		if (r == true) 
		{
			var kd_perbaikan = $("#kd_perbaikan").val()
			var catatan = CKEDITOR.instances.catatan_koordinator.getData();
	
			var tgl_permohonan = $("#tgl_permohonan").text()
			var nip_pemohon = $("#nip_pemohon").text()
			var nama_pemohon = $("#nama_pemohon").text()
			
			var nip_approval_koordinator = $("#nip_approval_koordinator").text()
		
		
			$.ajax({
				url: "<?php echo base_url(); ?>perbaikan/persetujuan_koordinator/approvalKoordinator",
				type: "POST",
				//dataType: "json",
				data: {kd_perbaikan:kd_perbaikan, catatan_koordinator:catatan},
				success: function(data)
				{
					$("#status_"+kd_perbaikan).html(data + '<i id="catatan_'+kd_perbaikan+'" style="color:green">'+catatan+'</i>');
					$("#kolom-aksi_"+kd_perbaikan).html('<div class="view-direct btn btn-warning btn-xs" data-id="'+kd_perbaikan+'" data-tgl_permohonan="'+tgl_permohonan+'" data-nip_pemohon="'+nip_pemohon+'" data-nama_pemohon="'+nama_pemohon+'" >View</div>');
					$("#kd_perbaikan").val("")
				},
				complete: function()
				{
					$("#catatanKoordinatorModal").modal("hide")
					$("#approvalKoordinatorModal").modal("hide")
				}
			})
		}
	})
})

</script>