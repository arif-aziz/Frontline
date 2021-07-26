@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
    
    $getHakAkses = Request::create('akses', 'GET');
    $hakAkses    = Route::dispatch($getHakAkses)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewAbsen'] == 'available' )
		<div class="container-fluid" id="pcont">
			<div class="page-head">
				<div class="row">
					<h4 style="margin:10px 25px;"><strong>ABSEN HARIAN</strong></h4>
					<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar &amp; detail user, memanipulasi &amp; menambah data user, serta me-reset password bagi yang berwenang.</p>
				</div>
			</div>
			<div class="cl-mcont ms-container" style="background:#fff;">
		    	<div class="row ms-row">
					<div class="col-sm-6 ms-col ms-col-border">
			    		<div class="block-flat ms-no-border ms-no-shadow" style="min-height:468px;">
							<div class="content">
								@if (Session::has('flash_error'))
						      	<div class="alert alert-danger" style="margin-bottom:30px; margin-top:-36px; margin-left:-24px; margin-right:-24px">
						        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        	<i class="fa fa-times-circle sign"></i><strong>Kesalahan!</strong> @{{ Session::get('flash_error') }}
						      	</div>
						      	@elseif (Session::has('flash_success'))
						      	<div class="alert alert-success" style="margin-bottom:30px; margin-top:-36px; margin-left:-24px; margin-right:-24px">
						        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						        	<i class="fa fa-check sign"></i><strong>Sukses!</strong> @{{ Session::get('flash_success') }}
						      	</div>
						      	@endif

						      	<div>
						      		<div class="header">
										<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Absen Harian</strong></h4>
									</div>
						      		<div class="header">
										<div class="row" style="margin:10px 0px 0px 0px;">
										  	<p style="font-size:11px; line-height:15px;">Pilih FILTER dibawah ini untuk melihat absensi personel di tiap unit kepolisian.</p>
											<form action="@{{ URL::to('absen/filter') }}" method="GET" class="form-horizontal" style="border-radius: 0px;">
												<div class="form-group">
											    	<div class="col-sm-3" style="padding-right:0px">
											    		@if (Session::has('sessTglAbsen'))
											    		<input name="txt-tanggal-absen" value="@{{ Session::get('sessTglAbsen') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
											    		@else
											    		<input name="txt-tanggal-absen" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
											    		@endif
													</div>
												    <div id="div-slc-wilayah-absen" class="col-sm-4" style="padding-right:0px" onchange="SelectWilayah.showSelectAbsen()">
												    	<select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required>
												    		@if (Session::has('sessWilayah') && Session::get('sessWilayah') == 0)
												    			<option value="0" selected>POLRES JOMBANG</option>
													    	@else
													    		<option value="0">POLRES JOMBANG</option>
													    	@endif

															@foreach ($wilayah as $valWilayah)
																@if (Session::has('sessWilayah') && Session::get('sessWilayah') == $valWilayah->id_kecamatan)
																	<option value="@{{ $valWilayah->id_kecamatan }}" selected>Polsek @{{ $valWilayah->nama }}</option>
															    @else
															    	<option value="@{{ $valWilayah->id_kecamatan }}">Polsek @{{ $valWilayah->nama }}</option>
														        @endif
														    @endforeach
														</select>
													</div>
													<div id="div-slc-satker-absen" class="col-sm-3" style="padding-right:0px">
												    	<select name="slc-satker" id="slc-satker" class="select2" parsley-trigger="change" required>
												    		@if (Session::has('sessSatker') && Session::get('sessSatker') == 'tanpa-satuan')
												    			<option value="tanpa-satuan" selected>Tanpa satuan</option>
												    		@else
												    			<option value="tanpa-satuan">Tanpa satuan</option>
												    		@endif
												    		@foreach ($satker as $valSatker)
													    		@if (Session::has('sessSatker') && Session::get('sessSatker') == $valSatker->satuan_kerja)
													    			<option value="@{{ $valSatker->satuan_kerja }}" selected>@{{ $valSatker->satuan_kerja }}</option>
													    		@else
													    			<option value="@{{ $valSatker->satuan_kerja }}">@{{ $valSatker->satuan_kerja }}</option>
													    		@endif
												    		@endforeach
														</select>
													</div>
													<div class="col-sm-2" style="padding-right:0px">
														<button type="submit" class="btn btn-primary"><i class="fa fa-check info"></i></button>
													</div>
												</div>
											</form>							
										</div>
									</div>
									<div class="content">
										<div class="table-responsive">
										  <table class="no-border hover" id="datatable">
									        <thead class="no-border">
										      <tr>
										        <th class="text-center" style="width:10%"><strong>NRP</strong></th>
										        <th><strong>Nama</strong></th>
										        <th class="text-center"><strong>Absensi</strong></th>
										        @if ( $aktifitasUser['inputAbsen'] == 'available' )
										        	@if( $hakAkses['aksesAbsen'] == 'available' )
										        	<th class="text-center" style="width:20%"><strong>Aksi</strong></th>
										        	@endif
										        @endif
										      </tr>
										    </thead>
										    <tbody class="no-border-x no-border-y">
										    	@foreach ($absen as $valAbsen)
										    	<tr>
										          	<td class="text-center"><a href="@{{ URL::to('absen/view').'/'.$valAbsen->id_kecamatan.'/'.$valAbsen->satuan_kerja.'/'.$valAbsen->tanggal_absen.'/'.$valAbsen->id_personel }}" class="btn-show-menu">@{{ $valAbsen->nrp }}</a></td>
										          	<td>@{{ $valAbsen->nama_lengkap }}</td>
										          	<td class="text-center">
										          		@if ( $valAbsen->status_absen == 'hadir')
										          		<span class="label label-success">Hadir</span>
										          		@elseif ( $valAbsen->status_absen == 'sakit')
										          		<span class="label label-warning">Sakit</span>
													   	@elseif ( $valAbsen->status_absen == 'cuti')
													   	<span class="label label-warning">Cuti</span>
													   	@elseif ( $valAbsen->status_absen == 'sekolah')
													   	<span class="label label-warning">Sekolah</span>
													   	@elseif ( $valAbsen->status_absen == 'izin')
													   	<span class="label label-warning">Izin Lain</span>
													   	@elseif ( $valAbsen->status_absen == 'alpha')
													   	<span class="label label-danger">Alpha</span>
													   	@endif
										          	</td>
										          	@if ( $aktifitasUser['inputAbsen'] == 'available' )
										          		@if( $hakAkses['aksesAbsen'] == 'available' )
											          	<td class="text-center">
											                <a href="@{{ URL::to('absen/update').'/'.$valAbsen->id_kecamatan.'/'.$valAbsen->satuan_kerja.'/'.$valAbsen->tanggal_absen.'/'.$valAbsen->id_absen }}" class="label label-default md-trigger" 
											                   data-toggle="tooltip" data-original-title="Ubah"><i class="fa fa-pencil"></i></a>
											          	</td>
											          	@endif
										          	@endif
										        </tr>
										        @endforeach
										    </tbody>
										  </table>              
										</div>
									</div>
								</div>        
							</div>
						</div>
					</div>
					<div class="col-sm-6 ms-col">
		    			<div class="block-flat ms-no-border ms-no-shadow">
		    				<div class="content">
		        				@yield('container_absen')
		        			</div>
		        		</div>
		        	</div>
		        </div>
			</div>
		</div>
	@endif

@endsection