@extends('layout.master')

@section('container')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewUser'] == 'available' )
	<div class="container-fluid" id="pcont">
		<div class="page-head">
			<div class="row">
				@if ( $aktifitasUser['inputUser'] == 'available' )
				<a href="@{{ URL::to('user/create') }}" type="button" style="margin:10px 25px;" class="btn btn-default btn-lg pull-right"><i class="fa fa-plus"></i></a>
				@endif
				<h4 style="margin:10px 25px;"><i class="fa fa-user"></i><strong>&nbsp; USER</strong></h4>
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
									<h4 style="margin:-15px 0px 10px 0px;"><strong>Daftar User</strong></h4>
								</div>
								<div class="content">
									<div class="table-responsive">
									  	<table class="no-border hover" id="datatable">
										    <thead class="no-border">
										      	<tr>
											        <th class=""><strong>Username</strong></th>
											        <th class=""><strong>Tipe User</strong></th>
											        <th class="text-center"><strong>Status</strong></th>
											        @if ( $aktifitasUser['inputUser'] == 'available' )
											        <th class="text-center" style="width:25%"><strong>Aksi</strong></th>
											        @endif
										      	</tr>
										    </thead>
										    <tbody class="no-border-x no-border-y" id="table-daftar-user">
										    	@foreach($user as $valUser)
										    	<tr>
										          	<td>
										          		<a href="@{{ URL::to('user/view', $valUser->id_user) }}" class="btn-show-menu md-trigger"
										          		   data-toggle="tooltip" data-original-title="@{{ $valUser->nama_lengkap_user }}">@{{ $valUser->username }}</a>
										          	</td>
										          	<td>
										          		@if( $valUser->satuan_kerja != 'superadmin' && 
										        			 $valUser->satuan_kerja != 'kapolres' && 
										        			 $valUser->satuan_kerja != 'wakapolres' && 
										        			 $valUser->satuan_kerja != 'kapolsek' && 
										        			 $valUser->satuan_kerja != 'wakapolsek' ||
										        			 ($valUser->satuan_kerja == 'superadmin' && $valUser->instansi == 'polsek'))
										        			 @{{ $valUser->jabatan }}
										            	@endif
										                @if(($valUser->satuan_kerja == 'superadmin' && $valUser->instansi == 'polres') ||
										                	($valUser->satuan_kerja != 'superadmin' && $valUser->instansi != 'polsek') ||
										                	 $valUser->satuan_kerja == 'kapolsek' || $valUser->satuan_kerja == 'wakapolsek')
										        			 @{{ $valUser->satuan_kerja }}
										            	@endif
										                @if( $valUser->satuan_kerja == 'superadmin' &&
										                	 $valUser->instansi == 'polsek')
										        			 @{{ $valUser->instansi }}
										            	@endif
										          	</td>
										          	<td class="text-center">
										          		@if( $valUser->status_user == 'aktif')
										          		<span class="label label-success">@{{ $valUser->status_user }}</span>
										          		@else
										          		<span class="label label-danger">@{{ $valUser->status_user }}</span>
										          		@endif
										          	</td>
										          	@if ( $aktifitasUser['inputUser'] == 'available' )
										          	<td class="text-center">
										          		<a href="@{{ URL::to('user/resetpassword', $valUser->id_user) }}" class="label label-warning md-trigger" 
										                   data-toggle="tooltip" data-original-title="Reset Password"><i class="fa fa-undo"></i></a>
										                <a href="@{{ URL::to('user/update', $valUser->id_user) }}" class="label label-default md-trigger" 
										                   data-toggle="tooltip" data-original-title="Ubah"><i class="fa fa-pencil"></i></a>
										                <a href="@{{ URL::to('user/delete', $valUser->id_user) }}" class="label label-danger md-trigger" 
										                   data-toggle="tooltip" data-original-title="Hapus"><i class="fa fa-times"></i></a>
										          	</td>
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
	        				@yield('container_user')
	        			</div>
	        		</div>
	        	</div>
	        </div>
    	</div>
	</div>
	@endif

@endsection