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
			<h4 style="margin:-15px 0px 10px 0px;"><strong>Ubah Status</strong></h4>
		</div>
		<div class="content">
		<form action="@{{ URL::to('operasi/status', $matchOps->id_operasi) }}" method="POST" id="form-personel" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-sm-12">
					<label class="color-warning">Keterangan:</label>
					<p>Jika kegiatan operasi berikut telah berakhir: <br/>
						<span class="color-success">Nama: @{{ $matchOps->nama_op }}</span><br/>
						<span class="color-success">Tanggal:  @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</span><br/> 
						<span class="color-success">Jam Kerja:  @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</span><br/> 
						Ubah statusnya menjadi <span class="color-success"><strong>selesai</strong></span>. Kemudian masukkan password sesuai dengan akun login Anda saat ini.
					</p>
		      	</div>
		    </div>
		    <div class="form-group">
			    <div class="col-sm-12 text-center">
			    	@if ($matchOps->status_op == 'proses')
			    	<label class="radio-inline" style="padding-left:1px; padding-top:0px;"> <input type="radio" checked="" name="rad-status-op" class="icheck" value="selesai"> Selesai</label> 
			      	<label class="radio-inline" style="padding-top:0px;"> <input type="radio" name="rad-status-op" class="icheck" value="proses"> Proses (Masih Dalam Pelaksanaan)</label>
			      	@elseif ($matchOps->status_op == 'selesai')
			      	<label class="radio-inline" style="padding-left:1px; padding-top:0px;"> <input type="radio" name="rad-status-op" class="icheck" value="selesai"> Selesai</label> 
			      	<label class="radio-inline" style="padding-top:0px;"> <input type="radio" checked="" name="rad-status-op" class="icheck" value="proses"> Proses (Masih Dalam Pelaksanaan)</label>
			      	@endif
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
		        	<button type="submit" class="col-sm-4 btn btn-success btn-flat">Ubah Status</button>
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