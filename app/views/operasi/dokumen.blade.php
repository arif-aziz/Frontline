@extends('operasi.index')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewOperasi'] == 'available')
	<div class="block-flat ms-no-border ms-no-shadow">
		<div class="content">
		<div class="header">
			<h4 style="margin:-15px 0px 10px 0px;"><strong>Dokumen @{{ $matchOps->nama_op }}</strong></h4>
		</div>
		<div class="header">
			<h6>Tanggal : @{{ $matchOps->tanggal_mulai }} s/d @{{ $matchOps->tanggal_selesai }}</h6>
			<h6>Jam Kerja : @{{ $matchOps->jam_mulai }} s/d @{{ $matchOps->jam_selesai }}</h6>
		</div>
		<div class="content">
			<div class="row">
		        <label class="col-sm-3" style="margin-top:6px;">Telegram</label>
		        <div class="col-sm-9">
			        <a href="@{{ URL::to('cetak/telegram', $matchOps->id_operasi) }}" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
			        <a href="@{{ URL::to('operasi/telegram/view', $matchOps->id_operasi) }}" class="btn btn-default"><i class="fa fa-eye"></i> Lihat</a>
			        @if ( $aktifitasUser['inputOperasi'] == 'available' )
			        <a href="@{{ URL::to('operasi/telegram/update', $matchOps->id_operasi) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
			        @endif
		    	</div>
	    	</div>
	    	<div class="row">
		        <label class="col-sm-3" style="margin-top:6px;">Surat Perintah</label>
		        <div class="col-sm-9">
			        @if (count($sprin) == 0)
		        		@if ( $aktifitasUser['inputOperasi'] == 'available' )
			        	<a href="@{{ URL::to('operasi/sprin/create', $matchOps->id_operasi) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Buat Surat Perintah</a>
		    			@endif
			        @else
				        <a href="@{{ URL::to('cetak/sprin', $matchOps->id_operasi) }}" class="btn btn-default"><i class="fa fa-print"></i> Cetak</a>
				        <a href="@{{ URL::to('operasi/sprin/view', $matchOps->id_operasi) }}" class="btn btn-default"><i class="fa fa-eye"></i> Lihat</a>
				        @if ( $aktifitasUser['inputOperasi'] == 'available' )
				        <a href="@{{ URL::to('operasi/sprin/update', $matchOps->id_operasi) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
				        @endif
		    		@endif
		    	</div>
	    	</div>
	    </div>
	    </div>
	</div>
	@endif

@endsection