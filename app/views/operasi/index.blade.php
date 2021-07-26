@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();

    $getHakAkses = Request::create('akses', 'GET');
    $hakAkses    = Route::dispatch($getHakAkses)->getOriginalContent();
?>

<?php $idx = 1; ?>
	
	@if ( $aktifitasUser['viewOperasi'] == 'available' )
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
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar Operasi Khusus &amp; Rutin</strong></h4>
								</div>
							  	<div class="content">
								    <div class="table-responsive">
								      	<table class="no-border hover" id="datatable">
									        <thead class="no-border">
									          	<tr>
										            <th class="text-center" style="width:10%"><strong>No.</strong></th>
										            <th><strong>Nama Operasi</strong></th>
										            <th class="text-center" style="width:15%"><strong>Jenis</strong></th>
										            <th class="text-center" style="width:15%"><strong>Status</strong></th>
										            @if ( $aktifitasUser['inputOperasi'] == 'available' )
											            @if( $hakAkses['aksesOperasi'] == 'available' )
											            <th class="text-center" style="width:24%"><strong>Aksi</strong></th>
											            @endif
										            @endif
									          	</tr>
									        </thead>
									        <tbody class="no-border-x no-border-y">
									        	@foreach($operasi as $valOperasi)
									            <tr>
									              	<td class="text-center">@{{ $idx++ }}</td>
									              	<td>
										                <a href="@{{ URL::to('operasi/view', $valOperasi->id_operasi) }}" class="btn-show-menu" >
										                	@{{ $valOperasi->nama_op }}
										                </a>
									              	</td>
									              	<td class="text-center">
									              		@if ($valOperasi->jenis_op == 'opkhusus')
									              		Khusus
									              		@elseif ($valOperasi->jenis_op == 'oprutin')
									              		Rutin
									              		@endif
									              	</td>
									              	<td class="text-center">
									              		@if ($valOperasi->status_op == 'proses')
									              		<label class="label label-warning">@{{ $valOperasi->status_op }}</label>
									              		@elseif ($valOperasi->status_op == 'selesai')
									              		<label class="label label-success">@{{ $valOperasi->status_op }}</label>
									              		@endif
									              	</td>
									              	@if ( $aktifitasUser['inputOperasi'] == 'available' )
										              	@if( $hakAkses['aksesOperasi'] == 'available' )
										              	<td class="text-center">
											                <a href="@{{ URL::to('operasi/dokumen', $valOperasi->id_operasi) }}" class="label label-success md-trigger" 
											                   data-toggle="tooltip" data-original-title="Dokumen"><i class="fa fa-file"></i></a>
											                <a href="@{{ URL::to('operasi/status', $valOperasi->id_operasi) }}" class="label label-default md-trigger" 
											                   data-toggle="tooltip" data-original-title="Ubah Status"><i class="fa fa-check"></i></a>
											                <a href="@{{ URL::to('operasi/delete', $valOperasi->id_operasi) }}" class="label label-danger md-trigger" 
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
    				@yield('container_operasi')
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection