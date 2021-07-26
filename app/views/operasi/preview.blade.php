@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
	@if ( $aktifitasUser['viewOperasi'] == 'available')
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				@if ( $aktifitasUser['inputOperasi'] == 'available' )
				<a href="@{{ URL::to('operasi/create') }}" type="button" style="margin:10px 25px;" class="btn btn-default btn-lg pull-right"><i class="fa fa-plus"></i></a>
				@endif
				<h4 style="margin:10px 25px;"><i class="fa fa-briefcase"></i><strong>&nbsp; OPERASI</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar &amp; detail operasi khusus &amp; operasi rutin serta memanipulasi &amp; menambah data operasi.</p>
			</div>
		</div>
		<div class="cl-mcont ms-container" style="background:#fff;">
	    	<div class="row ms-row">
				<div class="col-sm-6 ms-col ms-col-border">
		    		<div class="block-flat ms-no-border ms-no-shadow">
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
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Kesiapan Personel Polisi</strong></h4>
								</div>
							  	<div class="header">
								  	<div class="row" style="margin:10px">
								  		<p style="font-size:11px; line-height:15px;">Pilih FILTER dibawah ini untuk melihat kesiapan personel di tiap unit kepolisian.</p>
									    <form id="form-cek-absen" action="#" method="GET" class="form-horizontal" style="border-radius: 0px;">
											<div class="form-group" style="margin-bottom: 0px;">
										    	<div class="col-sm-3" style="padding-right:0px">
										    		@if (Session::has('sessTglAbsen'))
										    		<input id="txt-tanggal-absen" name="txt-tanggal-absen" value="@{{ Session::get('sessTglAbsen') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
										    		@else
										    		<input id="txt-tanggal-absen" name="txt-tanggal-absen" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
										    		@endif
												</div>
											    <div id="div-slc-wilayah-ops" class="col-sm-4" style="padding-right:0px">
											    	<select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required onchange="SelectWilayah.showSelectOps()">
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
												<div id="div-slc-satker-ops" class="col-sm-3" style="padding-right:0px">
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
													<button id="btn-cek-absen" type="submit" class="btn btn-primary"><i class="fa fa-check info"></i></button>
												</div>
											</div>
										</form>
									</div>
							  	</div>
							  	<div class="content">
								    <div class="table-responsive">
								      	<table class="no-border hover">
									        <thead class="no-border">
									          	<tr>
										            <th class="text-center" style="width:15%"><strong>NRP</strong></th>
										            <th><strong>Nama</strong></th>
										            <th class="text-center" style="width:20%"><strong>Absensi</strong></th>
										            <th class="text-center" style="width:25%"><strong>Status Op</strong></th>
									          	</tr>
									        </thead>
									        <tbody id="content-list-personel" class="no-border-x no-border-y">
									        	<script id="list-personel" type="text/x-handlebars">
									        	{{#each tmpAbsensi}}
									        	<tr>
													<td class="text-center">
														<a href="/personel/view/{{ id_kecamatan }}/{{ satuan_kerja }}/{{ id_personel }}" class="btn-show-menu" >
														{{ nrp }}
														</a>
													</td>
													<td>{{ nama_lengkap }}</td>
													<td class="text-center">
														{{#ifCond status_absen '==' 'hadir'}}
										          		<span class="label label-success">Hadir</span>
										          		{{else}} {{#ifCond status_absen '==' 'sakit'}}
														<span class="label label-warning">Sakit</span>
														{{else}} {{#ifCond status_absen '==' 'cuti'}}
														<span class="label label-warning">Cuti</span>
														{{else}} {{#ifCond status_absen '==' 'sekolah'}}
														<span class="label label-warning">Sekolah</span>
														{{else}} {{#ifCond status_absen '==' 'izin'}}
														<span class="label label-warning">Izin Lain</span>
														{{else}} {{#ifCond status_absen '==' 'alpha'}}
														<span class="label label-danger">Alpha</span>
														{{/ifCond}}{{/ifCond}}{{/ifCond}}{{/ifCond}}{{/ifCond}}{{/ifCond}}
													</td>
													<td class="text-center">
														{{#ifCond is_operasi '==' 0}}
														<span class="label label-success">Bebas Operasi</span>
														{{else}}
														<span class="label label-danger">Sedang Operasi</span>
														{{/ifCond}}
													</td>
									            </tr>
									            {{/each}}
									            </script>
									        </tbody>
								      	</table>              
								    </div>
							  	</div>
							</div>
						</div>
					</div>
				</div>
	    		<div class="col-sm-6 ms-col">
	    			@yield('container_operasi')
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection