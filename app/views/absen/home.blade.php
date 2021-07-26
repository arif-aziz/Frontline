@extends('absen.index')

@section('container_absen')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
    
    @if ( $aktifitasUser['viewAbsen'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
    </div>
    
    @if ( $aktifitasUser['inputAbsen'] == 'available' )
    <div class="content">
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-plus"></i></div> <div class="col-sm-9">Melakukan absensi personel</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data absen tiap persone</div>
        </div>
    </div>
    @endif
    @endif  
	
@endsection