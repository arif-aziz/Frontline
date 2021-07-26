@extends('personel.index')

@section('container_personel')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputPersonel'] == 'available' )
	<div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Hapus Personel Polisi</strong></h4>
    </div>
	<div class="content">
		<form action="@{{ URL::to('personel/delete', $matchPersonel->id_personel) }}" method="POST" id="form-personel" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-sm-12">
					<label class="color-warning">Perhatian:</label>
					<p>Untuk menghapus personel <label class="color-primary">@{{ $matchPersonel->nama_lengkap }}</label>, masukkan password sesuai dengan akun login Anda saat ini.</p>
		      	</div>
		    </div>
		    <div class="form-group">
		    	<div class="col-sm-12">
                	<input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
                </div>
            </div>
		  	<div class="form-group">
		  		<label class="col-sm-3 control-label"></label>
		        <div class="col-sm-9">
		        	<button type="submit" class="col-sm-4 btn btn-danger btn-flat">Hapus Personel</button>
		          	<a href="@{{ URL::to('personel') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
		        </div>
		        <label class="col-sm-2 control-label"></label>
		  	</div>
		</form>
	</div>
    @endif

@endsection