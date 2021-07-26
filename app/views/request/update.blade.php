@extends('request.index')

@section('container_request')

<?php $idx = 1; ?>

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
	
    @if ( $aktifitasUser['inputRequest'] == 'available' )
		@if(count($request) == 0)
	    <h2 class="text-center" style="margin-top:40%">( Tidak Ada Request )</h2>
	    @else
	    <div class="header">
	        <h4 style="margin:-15px 0px 10px 0px;"><strong>Request @{{ $detailRequest->nama_op }}</strong></h4>
	    </div>
		<div class="header">
			<span>Waktu Pelaksanaan : @{{ $detailRequest->tanggal_mulai }} sampai @{{ $detailRequest->tanggal_selesai }}</span>
			<span>Jam Kerja : @{{ $detailRequest->jam_mulai }} sampai @{{ $detailRequest->jam_selesai }}</span>
		</div>
	  	<div class="content">
	     	<form action="@{{ URL::to('detailoperasi/update') }}" method="POST" class="form-horizontal group-border-dashed" role="form" parsley-validate novalidate enctype="multipart/form-data" style="border-radius: 0px;">
				<div class="form-group pull-left">
					<div class="col-sm-12 control-label">
						@if ( $detailRequest->satuan_kerja == 'semua' )
							<strong>Semua Satker</strong>
						@else
							<strong>@{{ ucfirst($detailRequest->satuan_kerja) }}</strong>
						@endif
						@if ( $detailRequest->id_kecamatan == 0 )
							POLRES JOMBANG
						@else
							@foreach ($area as $valArea)
								@if ($valArea->id_kecamatan == $detailRequest->id_kecamatan)
									Polsek @{{ $valArea->nama }}
						        @endif
						    @endforeach
						@endif
						<span class="color-primary">@{{ $detailRequest->jumlah_personel_perunit }} orang</span>
						<input name="txt-id-operasi" value="@{{ $detailRequest->id_operasi }}" class="form-control hidden" type="text" />
						<input name="txt-id-request" value="@{{ $detailRequest->id_request }}" class="form-control hidden" type="text" />
						<input name="txt-satuan-kerja" value="@{{ $detailRequest->satuan_kerja }}" class="form-control hidden" type="text" />
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12">
	                  	<select name="slc-personel-inti-operasi[]" class="select2" multiple placeholder="Pilih personel inti untuk operasi">
	                  		@foreach ($personelOnOps as $valPersonelOnOps)
		                  		@if ($valPersonelOnOps->posisi == 'inti')
		                  		<option value="@{{ $valPersonelOnOps->id_personel }}" selected>@{{ $valPersonelOnOps->nrp }} : @{{ $valPersonelOnOps->nama_lengkap }} - @{{ $valPersonelOnOps->jabatan }}</option>
		                  		@endif
	                  		@endforeach
	                  		@foreach ($personel as $valPersonel)
		                  		@if ($detailRequest->satuan_kerja == 'semua')
			                  		@if ($valPersonel->id_kecamatan == $detailRequest->id_kecamatan)
			                    	<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
			                    	@endif
			                    @else
			                    	@if ($detailRequest->id_kecamatan == $valPersonel->id_kecamatan)
			                    		@if ($detailRequest->satuan_kerja == 'ops')
			                    			@if ($valPersonel->satuan_kerja == 'ops' || 
			                    				 $valPersonel->jabatan == 'Kapolres' ||
			                    				 $valPersonel->jabatan == 'Wakapolres')
				                    		<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
				                    		@endif
			                    		@else
			                    			@if ($valPersonel->satuan_kerja == $detailRequest->satuan_kerja)
			                    			<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
			                    			@endif
			                    		@endif
			                    	@endif
			                    @endif
	                    	@endforeach
	                  	</select>
	                </div>
	            </div>
	            <div class="form-group">
					<div class="col-sm-12">
	                  	<select name="slc-personel-cadangan-operasi[]" class="select2" multiple placeholder="Pilih personel cadangan untuk operasi (selain personel inti)">
	                  		@foreach ($personelOnOps as $valPersonelOnOps)
		                  		@if ($valPersonelOnOps->posisi == 'cadangan')
		                  		<option value="@{{ $valPersonelOnOps->id_personel }}" selected>@{{ $valPersonelOnOps->nrp }} : @{{ $valPersonelOnOps->nama_lengkap }} - @{{ $valPersonelOnOps->jabatan }}</option>
		                  		@endif
	                  		@endforeach
	                  		@foreach ($personel as $valPersonel)
		                  		@if ($detailRequest->satuan_kerja == 'semua')
			                  		@if ($valPersonel->id_kecamatan == $detailRequest->id_kecamatan)
			                    	<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
			                    	@endif
			                    @else
			                    	@if ($detailRequest->id_kecamatan == $valPersonel->id_kecamatan)
			                    		@if ($detailRequest->satuan_kerja == 'ops')
			                    			@if ($valPersonel->satuan_kerja == 'ops' || 
			                    				 $valPersonel->jabatan == 'Kapolres' ||
			                    				 $valPersonel->jabatan == 'Wakapolres')
				                    		<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
				                    		@endif
			                    		@else
			                    			@if ($valPersonel->satuan_kerja == $detailRequest->satuan_kerja)
			                    			<option value="@{{ $valPersonel->id_personel }}">@{{ $valPersonel->nrp }} : @{{ $valPersonel->nama_lengkap }} - @{{ $valPersonel->jabatan }}</option>
			                    			@endif
			                    		@endif
			                    	@endif
			                    @endif
	                    	@endforeach
	                  	</select>
	                </div>
	            </div>
				<div class="form-group">
					<div class="col-sm-12">
						<label class="color-warning">Keterangan:</label>
						<p>Jika personel yang Anda cari tidak ditemukan, ada 3 kemungkinan:</p>
						<ol>
							<li>Belum diabsen. Cek absensi hari ini.</li>
							<li>Masih bertugas dalam operasi lain. Cek detail absen personel.</li>
							<li>Data personel belum terdaftar. Cek daftar personel.</li>
						</ol>
			      	</div>
			    </div>
			    <div class="form-group">
	                <div class="col-sm-12">
	                  <label class="color-warning">Perhatian:</label>
	                  <p>Untuk keamanan data, masukkan password sesuai dengan akun login Anda saat ini.</p>
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="col-sm-2 control-label"></label>
	                <div class="col-sm-8">
	                  <input name="txt-password" type="password" placeholder="Password" id="password" class="form-control" parsley-trigger="change" required>
	                </div>
	                <label class="col-sm-2 control-label"></label>
	            </div>
				<div class="form-group">
					<div class="col-sm-2"></div>
					<div class="col-sm-10">
						<button type="submit" class="col-sm-8 btn btn-primary btn-flat">Kirim Rekomendasi Personel</button>
					  	<a href="@{{ URL::to('request') }}" class="col-sm-2 btn btn-default btn-flat">Batal</a>
					</div>
				</div>
	  		</form>
	  	</div>
		@endif
	@endif
	
@endsection