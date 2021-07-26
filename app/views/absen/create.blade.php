@extends('absen.index')

@section('container_absen')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php $idx = 1; ?>
	
	@if ( $aktifitasUser['inputAbsen'] == 'available' )
		<div class="header">
            <h4 style="margin:-15px 0px 10px 0px;"><strong>Input Absen Personel</strong></h4>
        </div>
    	@if (count($personel) == 0)
    	<div class="content">
	        <div class="well">
		        <p>Tidak ada personel polisi</p>
		        <p class="ms-menu-color"><a href="@{{ URL::to('personel/create') }}">Tambahkan Personel</a> baru pada unit ini</p>
	        </div>
        </div>
        @else
	        @if (count($absen) >= 1)
	        <div class="content">
	        	<div class="well">
			        <p>Sudah Absen</p>
			        <p class="ms-menu-color">
			        	Sudah dilakukan absensi personel pada tanggal 
			        	@if (Session::has('sessTglAbsen'))
			        		@{{ Session::get('sessTglAbsen') }}
			        	@else
			        		@{{ date('Y-m-d') }}
			        	@endif
			        </p>
		        </div>
        	</div>
	        @else
          	<div class="content" style="padding:15px 0px;">
             	<form action="@{{ URL::to('absen/create') }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;">
					<div class="form-group">
						<label class="col-sm-3 control-label" style="text-align:left !important;">Tanggal Absen</label>
						<div class="col-sm-5">
							@if (Session::has('sessTglAbsen'))
				    		<input name="txt-tanggal-absen" value="@{{ Session::get('sessTglAbsen') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text"/>
				    		@else
				    		<input name="txt-tanggal-absen" value="@{{ date('Y-m-d') }}" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text"/>
				    		@endif
						</div>
						<label class="col-sm-4 control-label">Jumlah Personel: @{{ count($personel) }}</label>
					</div>
					@foreach($personel as $valPersonel)
					<div class="form-group">
						<label class="col-sm-1 control-label">@{{ $idx++ }}.</label>
						<label class="col-sm-4 control-label">@{{ $valPersonel->nama_lengkap }}</label>
						<input name="txt-id-personel[]" value="@{{ $valPersonel->id_personel }}" class="form-control hidden" type="text" />
						<div class="col-sm-3">
						    <select name="slc-status[]" class="form-control">
						    	<option value="hadir">Hadir</option>
							   	<option value="sakit">Sakit</option>
							   	<option value="cuti">Cuti</option>
							   	<option value="sekolah">Sekolah</option>
							   	<option value="izin">Izin lain</option>
							   	<option value="alpha">Alpha</option>
							</select>
						</div>
						<div class="col-sm-4">
							<textarea name="txt-keterangan[]" placeholder="Keterangan" class="form-control" style="height:34px;"></textarea>
						</div>
					</div>
					@endforeach
					<div class="form-group">
						<div class="col-sm-3"></div>
						<div class="col-sm-6">
							<button type="submit" class="col-sm-5 btn btn-primary">Simpan</button>
						  	<a href="@{{ URL::to('absen') }}" class="col-sm-5 btn btn-default">Batal</a>
						</div>
					</div>
          		</form>
          	</div>
	        @endif
        @endif
    @endif
	
@endsection