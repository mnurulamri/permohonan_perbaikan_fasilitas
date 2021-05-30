<?php
$unit_kerja = unitKerja($pemohon['kodebidang']);
$nama = $pemohon['nama'];
$nip = $pemohon['nip'];
$telp = $pemohon['telp'];
$email = $pemohon['email'];

function dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email)
{
	$html = '
	
					<table class="table">
						<tr>
							<td>Tanggal Permohonan</td>
							<td>:</td>
							<td>'.$tanggal.'</td>
						</tr>
						<tr>
							<td>Program Studi/Unit</td>
							<td>:</td>
							<td>'.$unit_kerja.'</td>
						</tr>
						<tr>
							<td>Nama</td>
							<td>:</td>
							<td>'.$nama.'</td>
						</tr>
						<tr>
							<td>NPM/NIP/NUP</td>
							<td>:</td>
							<td>'.$nip.'</td>
						</tr>
						<tr>
							<td>No. Telepon</td>
							<td>:</td>
							<td>'.$telp.'</td>
						</tr>
						<tr>
							<td>E-mail</td>
							<td>:</td>
							<td>'.$email.'</td>
						</tr>
					</table>';
					
	echo $html;
}

// dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email);
?>

<div>
	<!--<span><button id="testlink" class="page test btn btn-info pull-right" rel="<?=base_url()?>perbaikan/permohonan/daftarPermohonan">Save</button></span>-->
	<span><button id="form-input" class="test btn btn-info pull-right">Data Baru</button></span>
</div>
<!--<div class="ajukan btn btn-primary btn-xs">ajukan</div>-->
<input type="hidden" id="kd_perbaikan" name="kd_perbaikan" class="kd_perbaikan form-control" value="<?php echo $kd_perbaikan?>"/>
<input type="hidden" id="kodebidang" name="kodebidang" class="kodebidang form-control" value="<?php echo $pemohon['kodebidang']?>"/>
<input type="hidden" id="nip" name="nip" class="nip form-control" value="<?php echo $nip?>"/>

<div class="box box-info" style="overflow:auto">
	<div class="box-header with-border" style="text-align:center">
		<h3 class="box-title">Data Permohonan Perbaikan</h3>
	</div>
	<div class="box-body">
		<div id="data-list-perbaikan">
			<?php print_r( $list_perbaikan ); ?>
		</div> <!-- /. data-list-perbaikan -->		
	</div>

</div>

<div class="modal fade modal-input" id="modal-input" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

			<div class="modal-body">

				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Pemohon</h3>
					</div>
					<!-- /.box-header -->
				
					<!-- data pemohon -->
					<?php print_r( dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email) ); ?>
				</div>
				<!-- /.box-info -->

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Rincian Perbaikan</h3>
					</div>
					<!-- /.box-header -->

					<div id="data-rincian" style="overflow:auto">

						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Tempat/Lokasi</th>
									<th>Jenis Pekerjaan</th>
									<th>Jumlah</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>

					</div>
					
					<br>

					<div>
						<span></span>
					</div>

				</div>
				<!-- /.box-info -->

			</div>
			<!-- /.box-body -->

			<div class="modal-footer">
				<button id="tambah" class="tambah btn btn-info">tambah</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /.modal-content -->
    </div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal tambah rincian pekerjaan -->
<div class="modal fade modal-tambah" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		
        <div class="modal-content">

        	<div class="modal-body">

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Rincian Perbaikan Fasilitas</h3>
					</div>
					<div class="box-body" style="text-align:left">
						<div class="row">
							<h5 class="label-rincian">Tempat/Lokasi: </h5>
							<textarea id="lokasi" name="lokasi" rows="0" cols="10"></textarea>
						</div>
						<div class="row">
							<h5 class="label-rincian">Jenis Perbaikan Fasilitas: </h5>
							<textarea id="jenis-perbaikan" name="jenis-perbaikan" rows="0" cols="80"></textarea>
						</div>
						<div class="row">
							<h5 class="label-rincian">Jumlah: </h5>
							<textarea id="jumlah" name="jumlah" rows="0" cols="80"></textarea>
						</div>
						<div class="row">
							<h5 class="label-rincian">Keterangan: </h5>
							<textarea id="keterangan" name="keterangan" rows="0" cols="80"></textarea>
						</div>
					</div>
					<!--
	        		<form id="formTambah" method="post" name="form" class="form-horizontal" >
						<div class="col-sm-4" style="">Tempat/Lokasi: </div> 
						<div><textarea id="lokasi" name="lokasi" rows="1" cols="80"></textarea></div>
						
						
						<div class="form-group">						
							<label for="lokasi" class="col-sm-2 control-label" style="text-align:right">Tempat/Lokasi: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="lokasi" name="lokasi" class="lokasi form-control" value=""/>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="jenis-perbaikan" class="col-sm-2 control-label" style="text-align:right">Jenis Perbaikan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="jenis-perbaikan" name="jenis-perbaikan" class="jenis-perbaikan form-control" value=""/>
								</div>
							</div>		
						</div>
						<div class="form-group">
							<label for="jumlah" class="col-sm-2 control-label" style="text-align:right">Jumlah: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="jumlah" name="jenis-perbaikan" class="jumlah form-control" value=""/>
								</div>
							</div>			
						</div>
						<div class="form-group">
							<label for="keterangan" class="col-sm-2 control-label" style="text-align:right">Keterangan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="keterangan" name="keterangan" class="jumlah form-control" value=""/>
								</div>
							</div>
	    				</div>
						-->
	    			</form>
					
				</div>
				<!-- /.box-info -->
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="simpan-rincian-perbaikan">simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /.modal-body -->
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-tambah-jenis-pekerjaan -->

<!-- modal ajukan -->
<div class="modal fade modal-ajukan" id="modal-ajukanx" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		
        <div class="modal-content">

        	<div class="modal-body">

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Pemohon</h3>
					</div>

					<input type="hidden" id="id_ajukan" name="id_ajukan" class="id_ajukan"/>

					<?php print_r( dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email) ); ?>
				</div>
				
				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title">Data Rincian Perbaikan</h3>
					</div>
					<!-- /.box-header -->

					<div id="data-rincian-view" style="overflow:auto"></div>
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="ajukan-permohonan">ajukan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>

	</div>
</div>

<!-- modal edit -->
<div class="modal fade modal-edit" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

			<div class="modal-body">

				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Pemohon</h3>
					</div>
					<!-- /.box-header -->
				
					<!-- form start -->
				
					<input type="hidden" id="id_edit" name="id_edit" class="id_edit"/>

					<?php print_r( dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email) ); ?>
				</div>
				<!-- /.box-info -->

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title">Data Rincian Perbaikan</h3>
					</div>
					<!-- /.box-header -->

					<div id="data-rincian-edit" style="overflow:auto">

						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Tempat/Lokasi</th>
									<th>Jenis Pekerjaan</th>
									<th>Jumlah</th>
									<th>Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>

					</div>
					
					<br>

					<div>
						<span></span>
					</div>
					<div class="box-footer" style="text-align:center">
						<button id="tambah-edit" class="tambah-edit btn btn-sm btn-primary">tambah data rincian</button>
					</div>

				</div>
				<!-- /.box-info -->

			</div>
			<!-- /.box-body -->

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /.modal-content -->
    </div>
	<!-- /.modal-dialog -->
</div>

<!-- modal hapus list perbaikan -->
<div class="modal fade modal-delete" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

			<div class="modal-body">

				<input type="hidden" id="id_delete" name="id_delete" class="id_delete"/>

				<!-- Horizontal Form -->
				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Hapus Data Rincian Perbaikan</h3>
					</div>
					<div class="box-content" style="overflow:auto">
						<div id="konfirm-data-rincian"></div>
					</div>
					<div class="box-footer" style="text-align:right">
						<span id="pesan-delete-list"></span>
						<button id="delete-list" class="delete-list btn btn-info">delete</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
					</div>
				</div>
				<!-- /.box-info -->
			</div>
			<!-- /.modal-body -->
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal-hapus -->

<!-- modal tambah edit rincian pekerjaan -->
<div class="modal fade modal-tambah-edit" id="modal-tambah-edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		
        <div class="modal-content">

        	<div class="modal-body">

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Tambah Data Rincian</h3>
					</div>

	        		<form id="formTambahEdit" method="post" name="form" class="form-horizontal" >
						<div class="form-group">						
							<label for="lokasi" class="col-sm-2 control-label" style="text-align:right">Tempat/Lokasi: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="tambah-edit-lokasi" name="tambah_edit_lokasi" class="tambah_edit_lokasi form-control" value=""/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="jenis-perbaikan" class="col-sm-2 control-label" style="text-align:right">Jenis Perbaikan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="tambah-edit-jenis-perbaikan" name="tambah_edit_jenis-perbaikan" class="tambah_edit_jenis-perbaikan form-control" value=""/>
								</div>
							</div>		
						</div>
						<div class="form-group">
							<label for="jumlah" class="col-sm-2 control-label" style="text-align:right">Jumlah: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="tambah-edit-jumlah" name="tambah_edit_jumlah" class="tambah_edit_jumlah form-control" value=""/>
								</div>
							</div>			
						</div>
						<div class="form-group">
							<label for="keterangan" class="col-sm-2 control-label" style="text-align:right">Keterangan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="tambah-edit-keterangan" name="tambah_edit_keterangan" class="tambah_edit_keterangan form-control" value=""/>
								</div>
							</div>
	    				</div>
	    			</form>
					
				</div>
				<!-- /.box-info -->
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="simpan-tambah-edit-rincian-perbaikan">simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /.modal-body -->
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-edit-tambah-jenis-pekerjaan -->

<!-- modal edit rincian pekerjaan -->
<div class="modal fade modal-edit-rincian" id="modal-edit-rincian" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		
        <div class="modal-content">

        	<div class="modal-body">

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Edit Data Rincian</h3>
					</div>

					<input type="hidden" id="id_edit_detail" name="id_edit_detail" class="id_edit"/>
					<div id="testing"></div>
	        		<form id="formEditRincian" method="post" name="form" class="form-horizontal" >
						<div class="form-group">						
							<label for="lokasi" class="col-sm-2 control-label" style="text-align:right">Tempat/Lokasi: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="edit-lokasi" name="edit-lokasi" class="edit_lokasi form-control" value=""/>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="jenis-perbaikan" class="col-sm-2 control-label" style="text-align:right">Jenis Perbaikan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="edit-jenis-perbaikan" name="edit-jenis-perbaikan" class="edit-jenis-perbaikan form-control" value=""/>
								</div>
							</div>		
						</div>
						<div class="form-group">
							<label for="jumlah" class="col-sm-2 control-label" style="text-align:right">Jumlah: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="edit-jumlah" name="edit-jumlah" class="edit-jumlah form-control" value=""/>
								</div>
							</div>			
						</div>
						<div class="form-group">
							<label for="keterangan" class="col-sm-2 control-label" style="text-align:right">Keterangan: </label>
							<div class="col-sm-3">
								<div class="input-group date">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input id="edit-keterangan" name="edit-keterangan" class="edit-keterangan form-control" value=""/>
								</div>
							</div>
	    				</div>
	    			</form>
					
				</div>
				<!-- /.box-info -->
			</div>

			<div class="modal-footer">
				<div id="pesan-edit-detail"></div>
				<button type="button" class="btn btn-primary" id="simpan-edit-rincian">simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>

		</div>
		<!-- /.modal-body -->
	</div>
	<!-- /.modal-content -->
</div>
<!-- /.modal-edit-rincian-pekerjaan -->

<!-- modal view -->
<div class="modal fade modal-view" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
		
        <div class="modal-content">

        	<div class="modal-body">

				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title" style="color:#0099CC">Data Pemohon</h3>
					</div>

					<input type="hidden" id="id_view" name="id_view" class="id_view"/>

					<?php print_r( dataPemohon($tanggal, $unit_kerja, $nama, $nip, $telp, $email) ); ?>
				</div>
				
				<div class="box box-info">
					<div class="box-header with-border" style="text-align:center">
						<h3 class="box-title">Data Rincian Perbaikan</h3>
					</div>
					<!-- /.box-header -->

					<div id="data-rincian-view-2" style="overflow:auto"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>

	</div>
</div>

<?=$permohonan_script?>

<style>
table.frm-list thead {
	color: #fff;
	background-image: linear-gradient(to right, #614385 , #516395);
}
table.frm-list tbody tr td {
	border:1px solid lightgray;
}
h3{
 color:#0099CC;
}
/* fix problem multiple modal scrollbar */
.modal { overflow: auto !important; }
</style>