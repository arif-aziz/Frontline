@extends('user.index')

@section('container_user')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

    @if ( $aktifitasUser['viewUser'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
    </div>

    @if ( $aktifitasUser['inputUser'] == 'available' )
    <div class="content">
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-plus"></i></div> <div class="col-sm-9">Menambahkan data user baru</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data user</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-undo"></i></div> <div class="col-sm-9">Me-reset password sesuai username</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-times"></i></div> <div class="col-sm-9">Menghapus data user</div>
        </div>
    </div>
    @endif

    <div class="content">
        <div class="well">
        Untuk keperluan mengubah data, password, dan hak akses, mohon menghubungi superadmin atau pihak yang berwenang.
        </div>
    </div>
    @endif
	
@endsection