@extends('absen.index')

@section('container_absen')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewAbsen'] == 'available' )
		<div class="header">
			<h4 style="margin:-15px 0px 10px 0px;"><strong>Riwayat Absen @{{ $matchPersonel->nama_lengkap }}</strong></h4>
		</div>
		<div class="content">
		    <div class="table-responsive">
		      <table class="no-border hover" id="datatable2">
		        <thead class="no-border">
		          <tr>
		            <th class="text-center" style="width:20%"><strong>Tanggal</strong></th>
		            <th class="text-center" style="width:20%"><strong>Absensi</strong></th>
		            <th><strong>Keterangan</strong></th>
		          </tr>
		        </thead>
		        <tbody class="no-border-x no-border-y" id="table-daftar-user">
		        	@foreach ($riwayatAbsen as $valRiwayatAbsen)
		        	<tr>
		              	<td class="text-center">@{{ $valRiwayatAbsen->tanggal_absen }}</td>
		              	<td class="text-center">
		              		@if ( $valRiwayatAbsen->status_absen == 'hadir')
		              		<span class="label label-success">Hadir</span>
		              		@elseif ( $valRiwayatAbsen->status_absen == 'sakit')
		              		<span class="label label-warning">Sakit</span>
						   	@elseif ( $valRiwayatAbsen->status_absen == 'cuti')
						   	<span class="label label-warning">Cuti</span>
						   	@elseif ( $valRiwayatAbsen->status_absen == 'sekolah')
						   	<span class="label label-warning">Sekolah</span>
						   	@elseif ( $valRiwayatAbsen->status_absen == 'izin')
						   	<span class="label label-warning">Izin Lain</span>
						   	@elseif ( $valRiwayatAbsen->status_absen == 'alpha')
						   	<span class="label label-danger">Alpha</span>
						   	@endif
		              	</td>
		              	<td>
		              		@if ($valRiwayatAbsen->keterangan_absen == NULL)
		              		Tidak ada keterangan
			                @else
			                @{{ $valRiwayatAbsen->keterangan_absen }}
			                @endif
		              	</td>
		            </tr>
		            @endforeach
		        </tbody>
		      </table>              
		    </div>
		</div>
	@endif

@endsection