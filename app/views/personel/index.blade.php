@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();

    $getHakAkses = Request::create('akses', 'GET');
    $hakAkses    = Route::dispatch($getHakAkses)->getOriginalContent();
?>
	
	@if ( $aktifitasUser['viewPersonel'] == 'available' )
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				@if ( $aktifitasUser['viewPersonel'] == 'available' )
				<a href="@{{ URL::to('personel/download') }}" type="button" style="margin:10px 25px 10px 10px;" class="btn btn-default btn-lg pull-right"><i class="fa fa-download"></i></a>
				@endif
				@if ( $aktifitasUser['inputPersonel'] == 'available' )
				<a href="@{{ URL::to('personel/create') }}" type="button" style="margin:10px 0px;" class="btn btn-default btn-lg pull-right"><i class="fa fa-plus"></i></a>
				@endif
				<h4 style="margin:10px 25px;"><i class="fa fa-user"></i><strong>&nbsp; PERSONEL POLISI</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar &amp; detail personel polisi, serta memanipulasi &amp; menambah data personel.</p>
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
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Personel Polisi</strong></h4>
								</div>
								<div class="header">
								  	<div class="row" style="margin:10px 0px 0px 0px;">
								  		<p style="font-size:11px; line-height:15px;">Pilih FILTER dibawah ini untuk melihat personel polisi di tiap unit kepolisian.</p>
									    <form action="@{{ URL::to('personel/filter') }}" method="GET" class="form-horizontal" style="border-radius: 0px;">
											<div class="form-group">
										    	<div id="div-slc-wilayah-person" class="col-sm-7" style="padding-right:0px">
											    	<select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required onchange="SelectWilayah.showSelectPersonel()">
											    		@if (Session::has('sessWilayah') && Session::get('sessWilayah') == 0)
											    			@if ($user->id_kecamatan == 0)
											    			<option value="0" selected>POLRES JOMBANG</option>
											    			@endif
												    	@else
												    		@if ($user->id_kecamatan == 0)
												    		<option value="0">POLRES JOMBANG</option>
												    		@endif
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
												<div id="div-slc-satker-person" class="col-sm-3" style="padding-right:0px">
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
								            <th><strong>Jabatan</strong></th>
								            @if ( $aktifitasUser['inputPersonel'] == 'available' )
									            @if( $hakAkses['aksesPersonel'] == 'available' )
									            <th class="text-center" style="width:20%"><strong>Aksi</strong></th>
									            @endif
								            @endif
								          </tr>
								        </thead>
								        <tbody class="no-border-x no-border-y">
								        	@foreach($personel as $valPersonel)
								        	<tr>
								              	<td class="text-center"><a href="@{{ URL::to('personel/view').'/'.$valPersonel->id_kecamatan.'/'.$valPersonel->satuan_kerja.'/'.$valPersonel->id_personel }}" class="btn-show-menu">@{{ $valPersonel->nrp }}</a></td>
								              	<td>@{{ $valPersonel->nama_lengkap }}</td>
								              	<td>@{{ $valPersonel->jabatan }}</td>
								              	@if ( $aktifitasUser['inputPersonel'] == 'available' )
									              	@if( $hakAkses['aksesPersonel'] == 'available' )
									              	<td class="text-center">
										                <a href="@{{ URL::to('personel/update').'/'.$valPersonel->id_kecamatan.'/'.$valPersonel->satuan_kerja.'/'.$valPersonel->id_personel }}" class="label label-default md-trigger" 
										                   data-toggle="tooltip" data-original-title="Ubah"><i class="fa fa-pencil"></i></a>
										                <a href="@{{ URL::to('personel/delete').'/'.$valPersonel->id_kecamatan.'/'.$valPersonel->satuan_kerja.'/'.$valPersonel->id_personel }}" class="label label-danger md-trigger" 
										                   data-toggle="tooltip" data-original-title="Hapus"><i class="fa fa-times"></i></a>
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
	        				@yield('container_personel')
	        			</div>
	        		</div>
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection