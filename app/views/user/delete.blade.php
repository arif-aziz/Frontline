@extends('user.index')

@section('container_user')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputUser'] == 'available')  	
	<div class="header">
		<h4 style="margin:-15px 0px 10px 0px;"><strong>Hapus User</strong></h4>
	</div>
	<div class="content">
		<form action="@{{ URL::to('user/delete', $matchUser->id_user) }}" method="POST" id="form-user" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-sm-12">
					<label class="color-warning">Perhatian:</label>
					<p>Untuk menghapus user <label class="color-primary">@{{ $matchUser->username }}</label>, masukkan password sesuai dengan akun login Anda saat ini.</p>
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
		        	<button type="submit" class="col-sm-4 btn btn-danger btn-flat">Hapus User</button>
		          	<a href="@{{ URL::to('user') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
		        </div>
		        <label class="col-sm-2 control-label"></label>
		  	</div>
		</form>
	</div>
    @endif

@endsection