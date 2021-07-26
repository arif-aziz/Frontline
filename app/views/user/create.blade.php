@extends('user.index')

@section('container_user')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputUser'] == 'available')
	<div class="header">
		<h4 style="margin:-15px 0px 10px 0px;"><strong>Input User</strong></h4>
	</div>
	<div class="content">
		<form action="@{{ URL::to('user/create') }}" method="POST" id="form-user" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-4 control-label">Foto</label>
				<div class="col-sm-6">
	              	<div class="fileinput fileinput-new" data-provides="fileinput">
	                    <div class="fileinput-new thumbnail" style="width:130px;height:130px;">
	                      	<img src="/images/fotodefault.jpg">
	                    </div>
	                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:130px;max-height:130px;"></div>
	                    <div>
	                      	<span class="btn btn-primary btn-file">
	                        <span class="fileinput-new">Pilih</span>
	                        <span class="fileinput-exists">Ubah</span>
	                        <input type="file" name="file-foto-user">
	                      	</span>
	                    	<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
	                    </div>
	            	</div>
	            </div>
	        </div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Username</label>
				<div class="col-sm-6">
				  <input name="txt-username" id="txt-username" placeholder="Username" type="text" class="form-control" parsley-trigger="change" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Nama Lengkap</label>
				<div class="col-sm-6">
				  <input name="txt-nama-lengkap" id="txt-nama-lengkap" placeholder="Nama Lengkap" type="text" class="form-control" parsley-trigger="change" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Tipe User</label>
				<div class="col-sm-6">
				  	<select name="slc-tipe-user" id="slc-tipe-user" class="select2" parsley-trigger="change" required>
				  		<option disabled selected>Tipe User</option>
				  		@foreach($tipeUser as $valTipeUser)
				        	<option value="@{{ $valTipeUser->id_tipe_user }}">
				        		@if( $valTipeUser->satuan_kerja != 'superadmin' && 
				        			 $valTipeUser->satuan_kerja != 'kapolres' && 
				        			 $valTipeUser->satuan_kerja != 'wakapolres' && 
				        			 $valTipeUser->satuan_kerja != 'kapolsek' && 
				        			 $valTipeUser->satuan_kerja != 'wakapolsek' ||
				        			 ($valTipeUser->satuan_kerja == 'superadmin' && $valTipeUser->instansi == 'polsek'))
				        			 @{{ $valTipeUser->jabatan }}
				            	@endif
				                @if(($valTipeUser->satuan_kerja == 'superadmin' && $valTipeUser->instansi == 'polres') ||
				                	($valTipeUser->satuan_kerja != 'superadmin' && $valTipeUser->instansi != 'polsek') ||
				                	 $valTipeUser->satuan_kerja == 'kapolsek' || $valTipeUser->satuan_kerja == 'wakapolsek')
				        			 @{{ $valTipeUser->satuan_kerja }}
				            	@endif
				                @if( $valTipeUser->satuan_kerja == 'superadmin' &&
				                	 $valTipeUser->instansi == 'polsek')
				        			 @{{ $valTipeUser->instansi }}
				            	@endif
				        	</option>
				        @endforeach
				  	</select>
				</div>
			</div>
		  	<div class="form-group">
		  		<label class="col-sm-4 control-label">Wil. Kepolisian</label>
				<div class="col-sm-6">
					<select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required>
						<option disabled selected>Wilayah Kepolisian</option>
						<option value="0">POLRES JOMBANG</option>
						@foreach($wilayah as $valWilayah)
				        	<option value="@{{ $valWilayah->id_kecamatan }}">Polsek @{{ $valWilayah->nama }}</option>
				        @endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Status</label>
			    <div class="col-sm-8">
			      <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-status-user" class="icheck" value="aktif"> Aktif</label> 
			      <label class="radio-inline"> <input type="radio" name="rad-status-user" class="icheck" value="non-aktif"> Non Aktif</label> 
			    </div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<label class="color-warning">Keterangan:</label>
					<p>Password akan di-generate secara otomatis sesuai dengan username-nya.</p>
		      	</div>
		    </div>
		  	<div class="form-group">
		        <div class="col-sm-3"></div>
		        <div class="col-sm-6">
		        	<button type="submit" class="col-sm-5 btn btn-primary btn-flat">Simpan</button>
		          	<a href="@{{ URL::to('user') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
		        </div>
		  	</div>
		</form>
	</div>
    @endif

@endsection