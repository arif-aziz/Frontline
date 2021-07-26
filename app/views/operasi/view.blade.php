@extends('operasi.index')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php 
$idx = 0; 
?>

	@if ( $aktifitasUser['viewOperasi'] == 'available' )
    <div class="block-flat ms-no-border ms-no-shadow">
      	<div class="content">
      		<div class="header">
				<h4 style="margin:-15px 0px 10px 0px;"><strong>@{{ $matchOperasi->nama_op }}</strong></h4>
			</div>
			<div class="col-sm-12" style="padding:10px 0px 0px 0px;">
				<h6>Tanggal : @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</h6>
				<h6>Jam Kerja : @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</h6>
				@if ( $matchOperasi->status_op == 'proses' )
				<span class="label label-warning">Dalam proses pelaksanaan</span>
				@else
				<span class="label label-success">Selesai</span>
				@endif
			</div>
			<div class="col-sm-12" style="margin-top:20px; padding:0px 0px 10px 0px;">
				@if($matchOperasi->keterangan_op == NULL)
				<p class="description">Tidak ada keterangan lain terkait dengan operasi ini.<p>
				@else
				<p class="description">@{{ $matchOperasi->keterangan_op }}<p>
				@endif
			</div>
	  	    <div class="tab-container">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#informasi" data-toggle="tab">Info</a></li>
					<li><a href="#foto" data-toggle="tab">Foto</a></li>
					<li><a href="#request" data-toggle="tab">Request</a></li>
					<li><a href="#personel" data-toggle="tab">Personel</a></li>
					<li><a href="#absen-operasi" data-toggle="tab">Absen Ops</a></li>
					<li><a href="#penggajian" data-toggle="tab">Gaji</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active cont" id="informasi">
						<div class="row">
							<div id="content-detail-personel">
					            <div class="col-sm-12">
					              <div class="personal">
					                <table class="no-border no-strip information">
						                <tbody class="no-border-x no-border-y">
						                  <tr>
						                    <td style="width:20%;" class="category"><strong>INFO OPERASI</strong></td>
						                    <td>
						                      <table class="no-border no-strip skills">
						                        <tbody class="no-border-x no-border-y">
						                          	<tr><td style="width:35%;"><b>Jenis Op.</b></td><td>@{{ $matchOperasi->jenis_op }}</td></tr>
						                          	<tr><td style="width:35%;"><b>Jumlah Hari</b></td><td>@{{ $jumlahHari }} hari</td></tr>
							                        <tr><td style="width:35%;"><b>Anggaran</b></td><td>@{{ number_format($matchOperasi->anggaran_pasti, 0, ',', '.') }}</td></tr>
							                        <tr><td style="width:35%;"><b>Index Anggaran</b></td><td>@{{ number_format($matchOperasi->index_anggaran_min, 0, ',', '.') }} s/d @{{ number_format($matchOperasi->index_anggaran_max, 0, ',', '.') }}</td></tr>
							                        <tr><td style="width:35%;"><b>Jumlah Personel</b></td><td>@{{ $matchOperasi->jumlah_personel }} orang</td></tr>
						                        </tbody>
						                      </table>
						                    </td>
						                  </tr>
						                  <tr>
						                    <td style="width:20%;" class="category"><strong>INFO DANA</strong></td>
						                    <td>
						                      <table class="no-border no-strip skills">
						                        <tbody class="no-border-x no-border-y">
						                          	<tr><td style="width:35%;"><b>Sisa Dana</b></td><td>@{{ number_format($sisaDana, 0, ',', '.') }}</td></tr>
						                          	<tr><td style="width:35%;"><b>Keterangan</b></td>
						                          		<td>
						                          			@if ($sisaDana >= 0)
						                          			Tidak ada keterangan
						                          			@else
						                          			Dana operasi kurang
						                          			@endif
						                          		</td>
						                          	</tr>
						                        </tbody>
						                      </table>
						                    </td>
						                  </tr>
						                </tbody>
						            </table>
					              </div>
					            </div>
				            </div>
			            </div>
					</div>
					<div class="tab-pane" id="foto">
						<div class="content">
							@foreach ($fotoOperasi as $valFotoOps)
						    <a class="image-zoom" href="/images/operasi/@{{ $valFotoOps->foto_op }}"><img src="/images/operasi/@{{ $valFotoOps->foto_op }}" class="img-thumbnail" style="height:100px;" /></a>
						    @endforeach
						</div>
					</div>
					<div class="tab-pane" id="request">
						<div class="content">
						    <div class="table-responsive">
						      <table class="no-border hover" id="datatable2">
						        <thead class="no-border">
						          <tr>
						            <th><strong>Satuan Kerja<strong></th>
						            <th class="text-center"><strong>Jumlah Personel</strong></th>
						            <th class="text-center"><strong>Status</strong></th>
						          </tr>
						        </thead>
						        <tbody class="no-border-x no-border-y" id="table-daftar-user">
						        	@foreach($request as $valRequest)
						            <tr>
						            	<td>@{{ $valRequest->satuan_kerja }}</td>
						              	<td class="text-center">@{{ $valRequest->jumlah_personel_perunit }}</td>
						              	<td class="text-center">@{{ $valRequest->status_request }}</td>
						            </tr>
						            @endforeach
						        </tbody>
						      </table>              
						    </div>
						</div>
					</div>
					<div class="tab-pane" id="personel">
						<div class="content">
						    <div class="table-responsive">
								<table class="no-border hover" id="datatable3">
									<thead class="no-border">
									  	<tr>
									    <th class="text-center" style="width:15%"><strong>NRP</strong></th>
									    <th><strong>Nama Personel</strong></th>
									    <th class="text-center"><strong>Satker</strong></th>
									    <th class="text-center" style="width:25%"><strong>Posisi</strong></th>
									  	</tr>
									</thead>
									<tbody class="no-border-x no-border-y">
										@foreach($detailOperasi as $valDetailOperasi)
							            <tr>
							              <td class="text-center">@{{ $valDetailOperasi->nrp }}</td>
							              <td>@{{ $valDetailOperasi->nama_lengkap }}</td>
							              <td class="text-center">@{{ $valDetailOperasi->satuan_kerja }}</td>
							              <td class="text-center">@{{ $valDetailOperasi->posisi }}</td>
							            </tr>
							            @endforeach
									</tbody>
								</table>              
						    </div>
						</div>
					</div>
					<div class="tab-pane" id="absen-operasi">
						<div class="content">
						    <div class="table-responsive">
						      <table class="no-border hover" id="datatable4">
						        <thead class="no-border">
						          	<tr>
						            <th class="text-center"><strong>Tanggal</strong></th>
						            <th class="text-center" style="width:15%"><strong>NRP</strong></th>
						            <th><strong>Nama</strong></th>
						            <th class="text-center"><strong>Absensi</strong></th>
						          	</tr>
						        </thead>
						        <tbody class="no-border-x no-border-y">
						        	@foreach($absenOperasi as $valAbsenOperasi)
						            <tr>
						              <td class="text-center">@{{ $valAbsenOperasi->tanggal_absen_op }}</td>
						              <td class="text-center">@{{ $valAbsenOperasi->nrp }}</td>
						              <td>@{{ $valAbsenOperasi->nama_lengkap }}</td>
						              <td class="text-center">@{{ $valAbsenOperasi->status_absen_op }}</td>
						            </tr>
						            @endforeach
						        </tbody>
						      </table>              
						    </div>
						</div>
					</div>
					<div class="tab-pane" id="penggajian">
						<div class="content">
						    <div class="table-responsive">
						      <table class="table table-bordered hover" id="datatable5">
						        <thead>
						          <tr>
						            <th class="text-center"><strong>NRP</strong></th>
						            <th><strong>Nama</strong></th>
						            <th class="text-center"><strong>Jumlah Gaji</strong></th>
						          </tr>
						        </thead>
						        <tbody id="table-daftar-user">
						        	@foreach ($gaji as $valGaji)
					        		<tr>
						              <td class="text-center">@{{ $valGaji->nrp }}</td>
						              <td>@{{ $valGaji->nama_lengkap }}</td>
						              <td class="text-center">@{{ number_format($valGaji->gaji, 0, ',', '.') }}</td>
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