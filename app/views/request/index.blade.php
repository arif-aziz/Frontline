@extends('layout.master')

@section('container')

<?php $idx = 1; ?>

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputRequest'] == 'available' )
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				<h4 style="margin:10px 25px;"><i class="fa fa-user"></i><strong>&nbsp; REQUEST PERSONEL OPERASI</strong></h4>
				<p style="font-size:11px; line-height:15px; margin:10px 25px;">Melihat daftar request personel untuk operasi khusus &amp; operasi rutin serta menerima/menolak request tersebut.</p>
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
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Request Personel Operasi</strong></h4>
								</div>
							  	<div class="content">
								    <div class="table-responsive">
								      	<table class="no-border hover" id="datatable">
									        <thead class="no-border">
									          <tr>
									            <th class="text-center"><strong>No.</strong></th>
									            <th class="text-center" style="width:20%"><strong>Tanggal Req.</strong></th>
									            <th style="width:22%"><strong>Nama Ops.</strong></th>
									            <th><strong>Unit Pol.</strong></th>
									            <th class="text-center" style="width:18%"><strong>Status Req.</strong></th>
									            <th class="text-center" style="width:15%"><strong>Aksi</strong></th>
									          </tr>
									        </thead>
									        <tbody class="no-border-x no-border-y" id="table-daftar-user">
									        	@foreach($request as $valRequest)
									        	<tr>
									              	<td class="text-center">@{{ $idx++ }}</td>
									              	<td>@{{ $valRequest->tanggal_request }}</td>
									              	<td>@{{ $valRequest->nama_op }}</td>
									              	<td>
									              			@if ( $valRequest->satuan_kerja == 'semua' )
																Semua Satker
															@else
																@{{ ucfirst($valRequest->satuan_kerja) }}
															@endif
															@if ( $valRequest->id_kecamatan == 0 )
																POLRES @{{$valRequest->nama}}
															@else
																Polsek @{{$valRequest->nama}} 
															@endif
									              	</td>
									              	<td class="text-center">
										              	@if ( $valRequest->status_request == 'proses')
									              		<span class="label label-warning">@{{ $valRequest->status_request }}</span>
									              		@elseif ( $valRequest->status_request == 'diterima')
									              		<span class="label label-success">@{{ $valRequest->status_request }}</span>
									              		@endif
									              	</td>
									              	<td class="text-center">
										                @if ($valRequest->status_request == 'proses')
									              		<a href="@{{ URL::to('request/view').'/'.$valRequest->id_request }}" class="label label-primary md-trigger" 
										                   data-toggle="tooltip" data-original-title="Lihat Request"><i class="fa fa-eye"></i></a>
										                @else
										                <a href="@{{ URL::to('request/update').'/'.$valRequest->id_request }}" class="label label-default md-trigger" 
										                   data-toggle="tooltip" data-original-title="Ubah Request"><i class="fa fa-pencil"></i></a>
										                @endif
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
	    			<div class="block-flat ms-no-border ms-no-shadow">
	    				<div class="content">
	        				@yield('container_request')
	        			</div>
	        		</div>
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection