@extends('user.index')

@section('container_user')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputUser'] == 'available' )
	<div class="header">
		<h4 style="margin:-15px 0px 10px 0px;"><strong>Ubah Data User</strong></h4>
	</div>
	<div class="content">
		<form action="@{{ URL::to('user/update', $matchUser->id_user) }}" method="POST" id="form-user" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
			<div class="form-group">
				<label class="col-sm-4 control-label">Foto</label>
				<div class="col-sm-6">
	              	<div class="fileinput fileinput-new" data-provides="fileinput">
	                    <div class="fileinput-new thumbnail" style="width:130px;height:130px;">
	              			@if($matchUser->foto_user == NULL || $matchUser->foto_user == 'fotodefault.jpg')
	                      	<img src="/images/fotodefault.jpg">
	                      	@else
	                      	<img src="/images/user/@{{ $matchUser->foto_user }}">
	                      	@endif
	                    </div>
	                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:130px;max-height:130px;"></div>
	                    <div>
	                      	<span class="btn btn-primary btn-file">
	                        <span class="fileinput-new">Pilih</span>
	                        <span class="fileinput-exists">Ubah</span>
	                        @if($matchUser->foto_user == NULL || $matchUser->foto_user == 'fotodefault.jpg')
	                        <input name="file-foto-user" type="file">
	                        @else
	                      	<input name="file-foto-user" value="@{{ $matchUser->foto_user }}" type="file">
	                      	@endif
	                      	</span>
	                    	<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
	                    </div>
	            	</div>
	            </div>
	        </div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Username</label>
				<div class="col-sm-6">
				  <input name="txt-username" value="@{{ $matchUser->username }}" id="txt-username" placeholder="Username" type="text" class="form-control" parsley-trigger="change" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Nama Lengkap</label>
				<div class="col-sm-6">
				  <input name="txt-nama-lengkap" value="@{{ $matchUser->nama_lengkap_user }}" id="txt-nama-lengkap" placeholder="Nama Lengkap" type="text" class="form-control" parsley-trigger="change" required />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">Tipe User</label>
				<div class="col-sm-6">
				  	<select name="slc-tipe-user" id="slc-tipe-user" class="select2" parsley-trigger="change" required>
				  		<option disabled>Tipe User</option>
				  		@foreach($tipeUser as $valTipeUser)
				  			@if($valTipeUser->id_tipe_user == $matchUser->id_tipe_user)
					        	<option value="@{{ $valTipeUser->id_tipe_user }}" selected>
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
					        @else
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
				  			@endif
				        @endforeach
				  	</select>
				</div>
			</div>
		  	<div class="form-group">
		  		<label class="col-sm-4 control-label">Wil. Kepolisian</label>
				<div class="col-sm-6">
					<select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required>
						<option disabled>Wilayah Kepolisian</option>
						@if($matchUser->id_kecamatan == 0) 
							<option value="0" selected>POLRES JOMBANG</option>
						@else
							<option value="0">POLRES JOMBANG</option>
						@endif

						@foreach($wilayah as $valWilayah)
							@if($matchUser->id_kecamatan == $valWilayah->id_kecamatan)
								<option value="@{{ $valWilayah->id_kecamatan }}" selected>Polsek @{{ $valWilayah->nama }}</option>
							@else
								<option value="@{{ $valWilayah->id_kecamatan }}">Polsek @{{ $valWilayah->nama }}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
			    <label class="col-sm-4 control-label">Status</label>
			    <div class="col-sm-8">
			    	@if($matchUser->status_user == 'aktif')
			    	<label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-status-user" class="icheck" value="aktif"> Aktif</label> 
			    	<label class="radio-inline"> <input type="radio" name="rad-status-user" class="icheck" value="non-aktif"> Non Aktif</label> 
			    	@else
			    	<label class="radio-inline" style="padding-left:1px;"> <input type="radio" name="rad-status-user" class="icheck" value="aktif"> Aktif</label> 
			    	<label class="radio-inline"> <input type="radio" checked="" name="rad-status-user" class="icheck" value="non-aktif"> Non Aktif</label> 
			    	@endif
			    </div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<label class="color-warning">Perhatian:</label>
					<p>Demi keamanan, masukkan password sesuai dengan akun login Anda saat ini.</p>
		      	</div>
		    </div>
		    <div class="form-group">
		    	<div class="col-sm-12">
	            	<input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
	            </div>
	        </div>
		  	<div class="form-group">
		        <div class="col-sm-3"></div>
		        <div class="col-sm-9">
		        	<button type="submit" class="col-sm-5 btn btn-primary btn-flat">Simpan Perubahan</button>
		          	<a href="@{{ URL::to('user') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
		        </div>
		  	</div>
		</form>
	</div>
    @endif

@endsection