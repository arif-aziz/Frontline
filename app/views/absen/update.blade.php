@extends('absen.index')

@section('container_absen')
	
<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
    	@if ( $aktifitasUser['inputAbsen'] == 'available' )
        <div class="header">
            <h4 style="margin:-15px 0px 10px 0px;"><strong>Edit Absen Personel</strong></h4>
        </div>
	  	<div class="content" style="padding:15px 0px;">
	     	<form action="@{{ URL::to('absen/update', $matchAbsen->id_absen) }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
				<div class="form-group">
					<label class="col-sm-3 control-label" style="text-align:left;">Tanggal Absen</label>
					<div class="col-sm-5">
						<input name="txt-tanggal-absen" readonly="readonly" value="@{{ $matchAbsen->tanggal_absen }}" required class="form-control" size="16" type="text"/>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">@{{ $matchAbsen->nama_lengkap }}</label>
					<input name="txt-nama-personel" value="@{{ $matchAbsen->nama_lengkap }}" class="form-control hidden" type="text" />
					<input name="txt-id-personel" value="@{{ $matchAbsen->id_personel }}" class="form-control hidden" type="text" />
					<div class="col-sm-3">
					    <select name="slc-status" class="form-control">
					    	@if ( $matchAbsen->status_absen == 'hadir')
					    	<option value="hadir" selected>Hadir</option>
					    	<option value="sakit">Sakit</option>
					    	<option value="cuti">Cuti</option>
					    	<option value="sekolah">Sekolah</option>
					    	<option value="izin">Izin lain</option>
					    	<option value="alpha">Alpha</option>
					    	@elseif ( $matchAbsen->status_absen == 'sakit')
						   	<option value="hadir">Hadir</option>
						   	<option value="sakit" selected>Sakit</option>
					    	<option value="cuti">Cuti</option>
					    	<option value="sekolah">Sekolah</option>
					    	<option value="izin">Izin lain</option>
					    	<option value="alpha">Alpha</option>
						   	@elseif ( $matchAbsen->status_absen == 'cuti')
						   	<option value="hadir">Hadir</option>
					    	<option value="sakit">Sakit</option>
						   	<option value="cuti" selected>Cuti</option>
					    	<option value="sekolah">Sekolah</option>
					    	<option value="izin">Izin lain</option>
					    	<option value="alpha">Alpha</option>
						   	@elseif ( $matchAbsen->status_absen == 'sekolah')
						   	<option value="hadir">Hadir</option>
					    	<option value="sakit">Sakit</option>
					    	<option value="cuti">Cuti</option>
						   	<option value="sekolah" selected>Sekolah</option>
					    	<option value="izin">Izin lain</option>
					    	<option value="alpha">Alpha</option>
						   	@elseif ( $matchAbsen->status_absen == 'izin')
						   	<option value="hadir">Hadir</option>
					    	<option value="sakit">Sakit</option>
					    	<option value="cuti">Cuti</option>
					    	<option value="sekolah">Sekolah</option>
						   	<option value="izin" selected>Izin lain</option>
					    	<option value="alpha">Alpha</option>
						   	@elseif ( $matchAbsen->status_absen == 'alpha')
						   	<option value="hadir">Hadir</option>
					    	<option value="sakit">Sakit</option>
					    	<option value="cuti">Cuti</option>
					    	<option value="sekolah">Sekolah</option>
					    	<option value="izin">Izin lain</option>
						   	<option value="alpha" selected>Alpha</option>
						   	@endif
						</select>
					</div>
					<div class="col-sm-4">
						<textarea name="txt-keterangan" placeholder="Keterangan" class="form-control" style="height:34px;">@{{ $matchAbsen->keterangan_absen }}</textarea>
					</div>
				</div>
				<div class="form-group">
				  	<div class="col-sm-12">
					    <label class="color-warning">Perhatian:</label>
					    <p>Untuk keamanan data, masukkan password sesuai dengan akun login Anda saat ini.</p>
				  	</div>
				</div>
				<div class="form-group">
				  	<div class="col-sm-12">
				    	<input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
				  	</div>
				</div>
				<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<button type="submit" class="col-sm-7 btn btn-primary btn-flat">Simpan Perubahan</button>
		          		<a href="@{{ URL::to('absen') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
					</div>
				</div>
	  		</form>
	  	</div>
		@endif
	
@endsection