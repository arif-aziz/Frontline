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
		        <h4 style="margin:-15px 0px 10px 0px;"><strong>Detail Personel Polisi</strong></h4>
		    </div>
		    <div class="content">
				<div class="profile-info" style="margin-bottom:20px;">
					<div class="row">
		              <div class="personal">
		                <table class="no-border no-strip information">
			                <tbody class="no-border-x no-border-y">
			                  <tr>
			                    <td style="width:20%;" class="category"><strong>TIPE USER</strong></td>
			                    <td>
			                      	<table class="no-border no-strip skills">
				                        <tbody class="no-border-x no-border-y">
				                          	<tr><td style="width:35%;"><b>Instansi</b></td><td>@{{ $matchTipeUser->instansi }}</td></tr>
				                          	<tr><td style="width:35%;"><b>Jabatan</b></td><td>@{{ $matchTipeUser->jabatan }}</td></tr>
				                          	<tr><td style="width:35%;"><b>Satuan Kerja</b></td><td>@{{ $matchTipeUser->satuan_kerja }}</td></tr>
				                        </tbody>
			                      	</table>
			                    </td>
			                  </tr>
			                  <tr>
			                    <td class="category"><strong>HAK AKSES</strong></td>
			                    <td> 
			                      	<table class="no-border no-strip skills">
				                        <tbody class="no-border-x no-border-y">
				                        	@foreach ( $matchHakAkses as $valMatchHakAkses )
				                          	<tr><td style="width:35%;"><b>@{{ $valMatchHakAkses->kelompok }}</b></td><td>@{{ $valMatchHakAkses->keterangan_aktifitas }}</td></tr>
				                          	@endforeach
				                        </tbody>
			                      	</table>
			                    </td>
			                  </tr>
			                </tbody>
			            </table>
		              </div>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	@endif
	
@endsection