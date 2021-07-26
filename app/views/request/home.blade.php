@extends('request.index')

@section('container_request')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
    @if ( $aktifitasUser['inputRequest'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Informasi</strong></h4>
    </div>
    
    <div class="content">
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-pencil"></i></div> <div class="col-sm-9">Mengubah data request</div>
        </div>
        <div class="row">
            <div class="col-sm-1"><i class="fa fa-eye"></i></div> <div class="col-sm-9">Melihat detail request</div>
        </div>
    </div>
    @endif
	
@endsection