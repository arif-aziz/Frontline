@extends('personel.index')

@section('container_personel')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php $idx = 1; ?>
	
	@if ( $aktifitasUser['viewPersonel'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Detail Personel Polisi</strong></h4>
    </div>
	<div class="content">
		<div class="profile-info" style="margin-bottom:20px;">
			<div class="row">
				<div class="col-sm-3">
	              	@if($matchPersonel->foto_personel == NULL || $matchPersonel->foto_personel == 'fotodefault.jpg')
	              	<div class="avatar">
	                	<img src="/images/fotodefault.jpg" class="profile-avatar" />
	              	</div>
	              	@else
	              	<div class="avatar">
	                	<img src="/images/personel/@{{ $matchPersonel->foto_personel }}" class="profile-avatar" />
	              	</div>
	              	@endif
	            </div>
				<div class="col-sm-9">
					<div class="personal">
						<div class="col-sm-12">
							<h5 class="name" >@{{ $matchPersonel->nrp }}</h5>
							<h3 class="name" style="margin-top:0px;">@{{ $matchPersonel->nama_lengkap }}</h3>
						</div>
						<div class="col-sm-12">
                          	<label>Status</label> : 
                          	@if ( $matchPersonel->status_personel == 'aktif' )
							<span class="label label-success">@{{ $matchPersonel->status_personel }}</span><br/>
							@elseif ( $matchPersonel->status_personel == 'non-aktif' )
							<span class="label label-danger">@{{ $matchPersonel->status_personel }}</span><br/>
							@elseif ( $matchPersonel->status_personel == 'mutasi' )
							<span class="label label-warning">@{{ $matchPersonel->status_personel }}</span><br/>
							@endif
							<label>Pangkat</label><span> : @{{ $matchPersonel->pangkat }}</span><br/>
							<label>Jabatan</label><span> : @{{ $matchPersonel->jabatan }}</span><br/>
                          	<label>Mulai Jabatan</label><span> : @{{ $matchPersonel->tanggal_jabatan }}</span><br/>
                          	<label>Instansi</label><span> : @{{ $matchPersonel->instansi }}</span><br/>
                          	<label>Satuan Kerja</label><span> : @{{ $matchPersonel->satuan_kerja }}</span>
                      	</div>
					</div>
				</div>
			</div>
		</div>
	    <div class="profile-info">
	  	    <div class="tab-container">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#data-personel" data-toggle="tab">Profil Personel</a></li>
					<li><a href="#riwayat-operasi" data-toggle="tab">Riwayat Operasi</a></li>
					<li><a href="#riwayat-absen" data-toggle="tab">Riwayat Absen</a></li>
				</ul>
				<div class="tab-content" style="padding:0px 10px; margin-bottom:0px;">
					<div class="tab-pane active cont" id="data-personel" style="padding:0px 10px 10px 10px;">
						<div class="row">
							<div id="content-detail-personel">
					            <div class="col-sm-12">
					              	<div class="personal">
					              		<div class="row" style="margin-top:0px;">
					              			<div class="col-sm-12">
				                          		<label>BIODATA</label>
				                          	</div>
					              			<div class="col-sm-12">
				                          		<label>Tempat, Tanggal Lahir</label><span> : @{{ $matchPersonel->tempat_lahir }}, @{{ $matchPersonel->tanggal_lahir }}</span><br/>
				                          		<label>Alamat</label><span> : @{{ $matchPersonel->alamat }}</span>
				                          	</div>
				                      	</div>
				                      	<div class="row">
					              			<div class="col-sm-12">
				                          		<label>RIWAYAT PENDIDIKAN</label>
				                          	</div>
					              			<div class="col-sm-12">
					              				@if ($matchPersonel->riwayat_pendidikan != NULL)
				                          		<p>@{{ $matchPersonel->riwayat_pendidikan }}</p>
				                          		@else
				                          		<p>Tidak ada</p>
				                          		@endif
				                          	</div>
				                      	</div>
				                      	<div class="row">
					              			<div class="col-sm-12">
				                          		<label>RIWAYAT KERJA</label>
				                          	</div>
					              			<div class="col-sm-12">
					              				@if ($matchPersonel->riwayat_kerja != NULL)
				                          		<p>@{{ $matchPersonel->riwayat_kerja }}</p>
				                          		@else
				                          		<p>Tidak ada</p>
				                          		@endif
				                          	</div>
				                      	</div>
					              	</div>
					            </div>
				            </div>
			            </div>
					</div>
					<div class="tab-pane" id="riwayat-operasi">
						<div class="content" style="padding-top:0px;">
						    <div class="table-responsive">
								<table class="no-border hover" id="datatable2">
									<thead class="no-border">
									  <tr>
									    <th class="text-center" style="width:15%"><strong>No.</strong></th>
									    <th><strong>Nama Operasi</strong></th>
									    <th class="text-center" style="width:25%"><strong>Status</strong></th>
									  </tr>
									</thead>
									<tbody class="no-border-x no-border-y">
										@foreach($operasi as $valOperasi)
									    <tr>
									      <td class="text-center">@{{ $idx++ }}</td>
									      <td>
									        <a href="#" class="btn-show-menu" >
									        	@{{ $valOperasi->nama_op }}
									        </a>
									      </td>
									      <td class="text-center">@{{ $valOperasi->status_op }}</td>
									    </tr>
									    @endforeach
									</tbody>
								</table>              
						    </div>
						</div>
					</div>
					<div class="tab-pane" id="riwayat-absen">
						<div class="content" style="padding-top:0px;">
							<div class="table-responsive">
						      	<table class="no-border hover" id="datatable3">
							        <thead class="no-border">
							          <tr>
							            <th class="text-center"><strong>Tanggal Absen</strong></th>
							            <th class="text-center"><strong>Absensi</strong></th>
							          </tr>
							        </thead>
							        <tbody class="no-border-x no-border-y">
							        	@foreach ($absen as $valAbsen)
							        	<tr>
							              	<td class="text-center">@{{ $valAbsen->tanggal_absen }}</td>
							              	<td class="text-center">@{{ $valAbsen->status_absen }}</td>
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
    @endif
	
@endsection