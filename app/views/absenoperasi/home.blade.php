@extends('absenoperasi.index')

@section('container_absenoperasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
    
    @if ( $aktifitasUser['viewAbsenOperasi'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
    </div>
    
    @if ( $aktifitasUser['inputAbsenOperasi'] == 'available' )
    <div class="content">
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data absen operasi tiap personel</div>
        </div>
        <div class="row">
            <div class="col-sm-1"></div> <div class="col-sm-9">Melihat riwayat absen tiap personel</div>
        </div>
    </div>
    @endif
    @endif
	
@endsection