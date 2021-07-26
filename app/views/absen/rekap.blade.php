@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
	@if ( $aktifitasUser['viewAbsen'] == 'available' )
	<div class="container-fluid" id="pcont" style="background:#fff;">
		<div class="page-head">
			<div class="row">
				<h4 style="margin:10px 25px;"><strong>REKAP ABSEN</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar &amp; detail absen.</p>
			</div>
		</div>
		<div class="cl-mcont ms-container" style="background:#fff;">
	    	<div class="row ms-row">
				<div class="col-sm-4 ms-col ms-col-border">
		    		<div class="block-flat ms-no-border ms-no-shadow" style="padding:5px 10px;">
						<div class="content" style="padding:0px;">
						@if (Session::has('flash_error'))
				      	<div class="alert alert-danger" style="margin-bottom:0px;">
				        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				        	<i class="fa fa-times-circle sign"></i><strong>Kesalahan!</strong> @{{ Session::get('flash_error') }}
				      	</div>
				      	@elseif (Session::has('flash_success'))
				      	<div class="alert alert-success" style="margin-bottom:0px;">
				        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				        	<i class="fa fa-check sign"></i><strong>Sukses!</strong> @{{ Session::get('flash_success') }}
				      	</div>
				      	@endif

				      	<div>
							<div class="header" style="border:none;">
								<div class="row" style="margin-left:10px; margin-right:15px">
							  		<p style="font-size:11px; line-height:15px;">Pilih FILTER dibawah ini untuk melihat absensi personel di tiap unit kepolisian.</p>
									<form action="@{{ URL::to('absen/rekap/filter') }}" method="GET" class="form-horizontal" style="border-radius: 0px;">
										<div class="form-group">
											<label class="col-sm-4 control-label" style="text-align:left !important;">Tanggal Rekap</label>
									    	<div class="col-sm-3" style="padding-left:4px; padding-right:0px;">
									    		@if (Session::has('sessTglAwal'))
									    		<input name="txt-tanggal-awal-rekap" value="@{{ Session::get('sessTglAwal') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@else
									    		<input name="txt-tanggal-awal-rekap" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@endif
											</div>
											<div class="col-sm-1" style="margin:7px 5px 4px 0px;"> <span>s/d</span> </div>
											<div class="col-sm-3" style="padding-left:4px; padding-right:0px;">
									    		@if (Session::has('sessTglAkhir'))
									    		<input name="txt-tanggal-akhir-rekap" value="@{{ Session::get('sessTglAkhir') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@else
									    		<input name="txt-tanggal-akhir-rekap" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" style="height:36px"/>
									    		@endif
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" style="text-align:left !important;">Unit</label>
										    <div id="div-slc-wilayah-rekap-absen" class="col-sm-7" style="padding-left:4px; padding-right:0px;" onchange="SelectWilayah.showSelectRekapAbsen()">
										    	<select name="slc-wilayah" id="slc-rekap-wilayah" class="select2" parsley-trigger="change" required>
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
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" id="lbl-rekap-satker" style="text-align:left !important;">Satuan</label>
											<div id="div-slc-satker-rekap-absen" class="col-sm-7" style="padding-left:4px; padding-right:0px;">
										    	<select name="slc-satker" id="slc-rekap-satker" class="select2" parsley-trigger="change" required>
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
										</div>
										<div class="form-group">
											<label class="col-sm-4 control-label" style="text-align:left !important;">Opsi Filter</label>
											<div class="col-sm-8" style="padding-left:5px;">
												<div class="radio" style="padding-left:1px;"> <input type="radio" checked="" name="rad-filter-rekap" class="icheck" value="0"> &nbsp; Tampilkan Rekap</div> 
												<div class="radio" style="padding-left:1px;"> <input type="radio" name="rad-filter-rekap" class="icheck" value="1"> &nbsp; Download Rekap</div> 
												<div class="radio" style="padding-left:1px;"> <input type="radio" name="rad-filter-rekap" class="icheck" value="2"> &nbsp; Download Rekap Semua Unit</div> 
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<button style="width:100%" type="submit" class="btn btn-primary"><i class="fa fa-check info"></i> Submit Filter</button>
											</div>
										</div>
									</form>			
								</div>
							</div>
						</div>
						</div>
					</div>
				</div>
	    		<div class="col-sm-8 ms-col">
	    			<div class="block-flat ms-no-border ms-no-shadow">
	    				<div class="content">
		    				<div class="row" style="margin:0px">
								<p style="margin-top:-11px; margin-bottom:0px;"><strong>Keterangan:</strong></p>
								<div class="row" style="border-bottom:1px solid #dadada; padding-bottom:11px;">
									<div class="col-sm-2"><strong>H</strong> : Hadir</div>
									<div class="col-sm-2"><strong>St</strong> : Sakit</div>
									<div class="col-sm-2"><strong>C</strong> : Cuti</div>
									<div class="col-sm-2"><strong>Sh</strong> : Sekolah</div>
									<div class="col-sm-2"><strong>I</strong> : Izin</div>
									<div class="col-sm-2"><strong>A</strong> : Alpha</div>	
								</div>
								<div class="table-responsive" style="margin-top:10px">
									<table class="table table-bordered hover" id="datatable">
										<thead>
										  <tr>
										    <th class="text-center" style="width:15%">NRP</th>
										    <th class="text-center">Nama</th>
										    <th class="text-center" style="width:8%">H</th>
										    <th class="text-center" style="width:8%">St</th>
										    <th class="text-center" style="width:8%">C</th>
										    <th class="text-center" style="width:8%">Sh</th>
										    <th class="text-center" style="width:8%">I</th>
										    <th class="text-center" style="width:8%">A</th>
										  </tr>
										</thead>
										<tbody id="table-daftar-user">
											@foreach ($rekap as $valRekap)
											<tr>
										      	<td class="text-center">@{{ $valRekap->nrp }}</td>
										      	<td>@{{ $valRekap->nama_lengkap }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlHadir }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlSakit }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlCuti }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlSekolah }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlIzin }}</td>
										      	<td class="text-center">@{{ $valRekap->jmlAlpha }}</td>
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
    	</div>
	</div>
	@endif

@endsection