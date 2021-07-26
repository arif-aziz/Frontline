@extends('layout.master')

@section('container')

<?php
	$idx = 1;
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
	@if ( $aktifitasUser['sistemSetting'] == 'available' )
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				<a href="@{{ URL::to('pengaturan/create') }}" type="button" style="margin:10px 25px;" class="btn btn-default btn-lg pull-right"><i class="fa fa-plus"></i></a>
				<h4 style="margin:10px 25px;"><i class="fa fa-cogs"></i><strong>&nbsp; PENGATURAN TIPE USER &amp; HAK AKSES USER</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar &amp; detail user, memanipulasi &amp; menambah data user, serta me-reset password bagi yang berwenang.</p>
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
								<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Tipe User &amp; Hak Aksesnya</strong></h4>
							</div>
							<div class="content">
								<div class="table-responsive">
								  <table class="no-border hover" id="datatable">
								    <thead class="no-border">
								      <tr>
								        <th class="text-center"><strong>No.</strong></th>
								        <th class="text-center"><strong>Instansi</strong></th>
								        <th class="text-center"><strong>Jabatan</strong></th>
								        <th class="text-center"><strong>Satuan Kerja</strong></th>
								        <th class="text-center" style="width:22%"><strong>Aksi</strong></th>
								      </tr>
								    </thead>
								    <tbody class="no-border-x no-border-y" id="table-daftar-user">
								    	@foreach ( $tipeUser as $valTipeUser )
								    	<tr>
								          	<td class="text-center">@{{ $idx++ }}</td>
								          	<td class="text-center">@{{ $valTipeUser->instansi }}</td>
								          	<td class="text-center">@{{ $valTipeUser->jabatan }}</td>
								          	<td class="text-center">@{{ $valTipeUser->satuan_kerja }}</td>
								          	<td class="text-center">
								          		<a href="@{{ URL::to('pengaturan/view', $valTipeUser->id_tipe_user) }}" class="label label-success md-trigger" 
								                   data-toggle="tooltip" data-original-title="Lihat Detail"><i class="fa fa-eye"></i></a>
								                <a href="@{{ URL::to('pengaturan/update', $valTipeUser->id_tipe_user) }}" class="label label-default md-trigger" 
								                   data-toggle="tooltip" data-original-title="Ubah"><i class="fa fa-pencil"></i></a>
								                <a href="@{{ URL::to('pengaturan/delete', $valTipeUser->id_tipe_user) }}" class="label label-danger md-trigger" 
								                   data-toggle="tooltip" data-original-title="Hapus"><i class="fa fa-times"></i></a>
								          	</td>
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
	    			@yield('container_pengaturan')
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection