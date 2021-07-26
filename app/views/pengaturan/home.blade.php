@extends('pengaturan.index')

@section('container_pengaturan')
	
<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

    @if ( $aktifitasUser['sistemSetting'] == 'available' )
    <div class="block-flat ms-no-border ms-no-shadow">
        <div class="content">
            <div class="header">
                <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
            </div>

            <div class="content">
                <div class="row">
                    <div class="col-sm-1"><i class="fa fa-plus"></i></div> <div class="col-sm-9">Menambahkan tipe user &amp; hak akses baru</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah tipe user &amp; hak akses baru</div>
                </div>
                <div class="row">
                    <div class="col-sm-1"><i class="fa fa-times"></i></div> <div class="col-sm-9">Menghapus tipe user &amp; hak akses baru</div>
                </div>
            </div>
        </div>
    </div>
    @endif
	
@endsection