@extends('personel.index')

@section('container_personel')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
    
    @if ( $aktifitasUser['viewPersonel'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
    </div>
    
    <div class="content">
        @if ( $aktifitasUser['inputPersonel'] == 'available' )
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-plus"></i></div> <div class="col-sm-9">Menambahkan data personel baru</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data personel</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-times"></i></div> <div class="col-sm-9">Menghapus data personel</div>
        </div>
        @endif	
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-download"></i></div> <div class="col-sm-9">Mengunduh daftar personel dalam format Excel 2007</div>
        </div>
    </div>
    @endif
    
@endsection