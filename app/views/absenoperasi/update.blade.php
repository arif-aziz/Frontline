@extends('absenoperasi.index')

@section('container_absenoperasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php 
$idx = 1;
?>
	
	@if ( $aktifitasUser['inputAbsenOperasi'] == 'available' )
	<div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Ubah Absensi @{{ $matchOperasi->nama_op }}</strong></h4>
    </div>
	<div class="header">
		<h6>Tanggal : @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</h6>
		<h6>Jam Kerja : @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</h6>
	</div>
  	<div class="content">
     	<form action="@{{ URL::to('absenoperasi/update') }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;">
			<div class="form-group">
				<label class="col-sm-4 control-label" style="text-align:left;">Tanggal Absensi</label>
				<div class="col-sm-4">
                	<input name="txt-tanggal-absen-op" value="@{{ $matchAbsenOp->tanggal_absen_op }}" disabled="disabled" class="form-control" size="16" type="text" value="" />
                </div>
			</div>
			<div class="form-group">
				<label class="col-sm-11 control-label" style="text-align:left; color:#0096C2;">@{{ $matchAbsenOp->nama_lengkap }}</label>
				<span style="margin-left:15px;">
					Jabatan: @{{ $matchAbsenOp->jabatan }}
							
					@if ( $matchAbsenOp->satuan_kerja != 'tanpa-satuan' )
						@{{ $matchAbsenOp->satuan_kerja }}
					@endif
					
					@if ( $matchAbsenOp->id_kecamatan == 0 )
						POLRES JOMBANG
					@else
						@foreach ($area as $valArea)
							@if ($valArea->id_kecamatan == $matchAbsenOp->id_kecamatan)
								Polsek @{{ $valArea->nama }}
					        @endif
					    @endforeach
					@endif
				</span>
			</div>
			<div class="form-group">
				<input name="txt-id-operasi" value="@{{ $matchAbsenOp->id_operasi }}" class="form-control hidden" type="text" />
				<input name="txt-id-detail-op" value="@{{ $matchAbsenOp->id_detail_operasi }}" class="form-control hidden" type="text" />
				<input name="txt-id-absen-op" value="@{{ $matchAbsenOp->id_absen_operasi }}" class="form-control hidden" type="text" />
				<span class="col-sm-3 control-label" style="text-align:left;">Posisi: @{{ $matchAbsenOp->posisi }}</span>
				<div class="col-sm-3">
				    <select name="slc-status-op" class="form-control">
				    	@if ( $matchAbsenOp->status_absen_op == 'kerja' )
				    	<option value="kerja" selected>Dinas</option>
				    	<option value="bebas-kerja">Lepas Dinas</option>
					   	<option value="izin">Izin</option>
					   	@elseif ( $matchAbsenOp->status_absen_op == 'bebas-kerja' )
					   	<option value="kerja">Dinas</option>
				    	<option value="bebas-kerja" selected>Lepas Dinas</option>
					   	<option value="izin">Izin</option>
					   	@elseif ( $matchAbsenOp->status_absen_op == 'izin' )
					   	<option value="kerja">Dinas</option>
				    	<option value="bebas-kerja">Lepas Dinas</option>
					   	<option value="izin" selected>Izin</option>
					   	@endif
					</select>
				</div>
				<div class="col-sm-6">
					<textarea name="txt-keterangan-op" placeholder="Keterangan" class="form-control" style="height:34px;">@{{ $matchAbsenOp->keterangan_absen_op }}</textarea>
				</div>
			</div>
			<div class="form-group">
			  	<div class="col-sm-12">
				    <label class="color-warning">Perhatian:</label>
				    <p>Untuk keamanan data, masukkan password sesuai dengan akun login Anda saat ini.</p>
			  	</div>
			</div>
			<div class="form-group">
			  	<label class="col-sm-3 control-label">Password</label>
			  	<div class="col-sm-9">
			    	<input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
			  	</div>
			</div>
			<div class="form-group">
				<div class="col-sm-3"></div>
				<div class="col-sm-9">
					<button type="submit" class="col-sm-4 btn btn-primary">Simpan</button>
				  	<a href="@{{ URL::to('absenoperasi') }}" class="col-sm-3 btn btn-default btn-flat">Batal</a>
				</div>
			</div>
  		</form>
  	</div>
    @endif

@endsection