@extends('absenoperasi.index')

@section('container_absenoperasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
	@if ( $aktifitasUser['viewAbsenOperasi'] == 'available' )
	<div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Riwayat Absen @{{ $matchPersonel->nama_lengkap }}</strong></h4>
    </div>
	<div class="header">
		<span>Operasi : @{{ $matchOperasi->nama_op }}</span><br/>
		<span>Tanggal Pelaksanaan : @{{ $matchOperasi->tanggal_mulai }} sampai @{{ $matchOperasi->tanggal_selesai }}</span>
		<span>Jam Kerja : @{{ $matchOperasi->jam_mulai }} sampai @{{ $matchOperasi->jam_selesai }}</span>
	</div>
	<div class="content">
	    <div class="table-responsive">
	      <table class="table table-bordered hover" id="datatable2">
	        <thead>
	          <tr>
	          	<th class="text-center">Nama</th>
	          	<th class="text-center">Tanggal Absen</th>
	            <th class="text-center">Absensi</th>
	            <th class="text-center">Gaji</th>
	          </tr>
	        </thead>
	        <tbody id="table-daftar-user">
	        	@foreach($matchAbsenOpByPersonel as $valMatchAbsenOpByPersonel)
	        	<tr>
	        		<td>@{{ $valMatchAbsenOpByPersonel->nama_lengkap }}</td>
	              	<td>@{{ $valMatchAbsenOpByPersonel->tanggal_absen_op }}</td>
	              	<td class="text-center">
	              		@if ($valMatchAbsenOpByPersonel->status_absen_op == 'kerja')
	              		<span class="label label-success">Dinas</span>
	              		@elseif ($valMatchAbsenOpByPersonel->status_absen_op == 'bebas-kerja')
	              		<span class="label label-success">Lepas Dinas</span>
	              		@elseif ($valMatchAbsenOpByPersonel->status_absen_op == 'izin')
	              		<span class="label label-danger">Izin</span>
	              		@endif
	              	</td>
	              	<td>@{{ $valMatchAbsenOpByPersonel->gaji }}</td>
	            </tr>
	            @endforeach
	        </tbody>
	      </table>              
	    </div>
	</div>
	@endif

@endsection