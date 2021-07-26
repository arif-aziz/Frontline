@extends('operasi.index')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputOperasi'] == 'available')
	<div class="block-flat ms-no-border ms-no-shadow">
		<div class="content">
		<div class="header">
			<h4 style="margin:-15px 0px 10px 0px;"><strong>Hapus Operasi</strong></h4>
		</div>
		<div class="content">
			<form action="@{{ URL::to('operasi/delete', $matchOps->id_operasi) }}" method="POST" id="form-personel" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
				<div class="form-group">
					<div class="col-sm-12">
						<label class="color-warning">Perhatian:</label>
						<p>Data Operasi akan dihapus secara permanen dan secara otomatis akan menghapus data yang berelasi dengan data operasi, antara lain: <strong>request</strong>, <strong>absen operasi</strong>, serta <strong>personel dalam operasi</strong>. Anda tidak dapat membatalkan perintah hapus setelah dijalankan.</p>
						<p>Untuk menghapus operasi berikut: <br/>
							<span class="color-danger">Nama: @{{ $matchOps->nama_op }}</span><br/>
							<span class="color-danger">Tanggal:  @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</span><br/> 
							<span class="color-danger">Jam Kerja:  @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</span><br/> 
							Masukkan password sesuai dengan akun login Anda saat ini.
						</p>
			      	</div>
			    </div>
			    <div class="form-group">
			    	<div class="col-sm-12">
		            	<input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
		            </div>
		        </div>
			  	<div class="form-group">
			  		<label class="col-sm-3 control-label"></label>
			        <div class="col-sm-8">
			        	<button type="submit" class="col-sm-4 btn btn-danger btn-flat">Hapus Operasi</button>
			          	<a href="@{{ URL::to('operasi') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
			        </div>
			        <label class="col-sm-2 control-label"></label>
			  	</div>
			</form>
		</div>
	    </div>
	</div>
	@endif

@endsection