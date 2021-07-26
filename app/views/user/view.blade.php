@extends('user.index')

@section('container_user')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['viewUser'] == 'available')
	<div class="header">
		<h4 style="margin:-15px 0px 10px 0px;"><strong>Detail User</strong></h4>
	</div>
    <div class="content" style="padding-bottom:0px">
    	<div class="profile-info">
      		<div class="row">
	          	<div class="col-sm-2">
	          		@if($matchUser->foto_user == NULL || $matchUser->foto_user == 'fotodefault.jpg')
	              	<div class="avatar">
	                	<img src="/images/fotodefault.jpg" class="profile-avatar" />
	              	</div>
	              	@else
	              	<div class="avatar">
	                	<img src="/images/user/@{{ $matchUser->foto_user }}" class="profile-avatar" />
	              	</div>
	              	@endif
	            </div>
	            <div class="col-sm-10">
	              	<div class="personal">
	                	<h3 class="name" style="padding-left:6px">@{{ $matchUser->username }}</h3>
		                <table class="no-border no-strip information">
			                <tbody class="no-border-x no-border-y">
			                  	<tr>
				                    <td style="width:20%;" class="category"><strong>PROFIL</strong></td>
				                    <td>
				                      	<table class="no-border no-strip skills">
				                        <tbody class="no-border-x no-border-y">
				                          	<tr><td style="width:35%;"><b>Nama Lengkap</b></td><td>@{{ $matchUser->nama_lengkap_user }}</td></tr>
				                          	<tr><td style="width:35%;"><b>Tipe User</b></td>
					                          	<td>@if( $matchUser->satuan_kerja != 'superadmin' && 
									        			 $matchUser->satuan_kerja != 'kapolres' && 
									        			 $matchUser->satuan_kerja != 'wakapolres' && 
									        			 $matchUser->satuan_kerja != 'kapolsek' && 
									        			 $matchUser->satuan_kerja != 'wakapolsek' )
									        			 @{{ $matchUser->jabatan }}
									            	@endif
									                @{{ $matchUser->satuan_kerja }}
									                @if( $matchUser->satuan_kerja != 'superadmin' && 
									        			 $matchUser->satuan_kerja != 'kapolres' && 
									        			 $matchUser->satuan_kerja != 'wakapolres' && 
									        			 $matchUser->satuan_kerja != 'kapolsek' && 
									        			 $matchUser->satuan_kerja != 'wakapolsek' )
									        			 @{{ $matchUser->instansi }}
									            	@endif
									            </td>
									        </tr>
				                          	<tr><td style="width:35%;"><b>Wil. Kepolisian</b></td>
				                          		@if( $matchUser->id_kecamatan == 0 )
				                          		<td>POLRES @{{ $matchUser->nama }}</td>
				                          		@else
				                          		<td>POLSEK @{{ $matchUser->nama }}</td>
				                          		@endif
				                          	</tr>
				                        </tbody>
				                      	</table>
				                    </td>
			                  	</tr>
			                  	<tr>
				                    <td class="category"><strong>STATUS</strong></td>
				                    <td> 
				                      	@if( $matchUser->status_user == 'aktif')
					              		<span class="label label-success">Aktif</span>
					              		@else
					              		<span class="label label-danger">Non Aktif</span>
					              		@endif
				                    </td>
			                  	</tr>
			                </tbody>
			            </table>
	              	</div>
	            </div>
      		</div>
    	</div>
    </div>
    @endif

@endsection