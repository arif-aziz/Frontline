@extends('operasi.index')

@section('container_operasi')
	
<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

    @if ( $aktifitasUser['viewOperasi'] == 'available' )
    <div class="block-flat ms-no-border ms-no-shadow">
        <div class="content">

        <div class="header">
            <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
        </div>
        
        <div class="content">
            @if ( $aktifitasUser['inputOperasi'] == 'available' )
            <div class="row">
                <div class="col-sm-1"><i class="fa fa-plus"></i></div> <div class="col-sm-9">Menambahkan data operasi baru</div>
            </div>
            <div class="row">
                <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data operasi</div>
            </div>
            <div class="row">
                <div class="col-sm-1"><i class="fa fa-times"></i></div> <div class="col-sm-9">Menghapus data operasi</div>
            </div>
            <div class="row">
                <div class="col-sm-1"><i class="fa fa-check"></i></div> <div class="col-sm-9">Mengubah status operasi</div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-1"><i class="fa fa-file"></i></div> <div class="col-sm-9">Melihat atau mengunduh dokumen Telegram &amp; Surat Perintah</div>
            </div>
        </div>

        <div class="content">
            <div class="well">
            Jika operasi selesai dan tidak diganti statusnya lebih dari 1 hari, maka sistem akan mengganti statusnya secara otomatis menjadi <strong>selesai</strong>.
            </div>
        </div>
    	</div>
    </div>
    @endif

@endsection