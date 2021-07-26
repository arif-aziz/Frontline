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
    	@if(count($personelOp) == 0)
        <h3 class="text-center">Tidak Ada Personel</h3>
	    <p class="text-center ms-menu-color">Klik <a href="@{{ URL::to('personel/create') }}">TAMBAH PERSONEL</a> untuk menambahkan data personel ke dalam unit ini</p>
        @else
        	@if (count($absenOperasi) >= 1)
	        <h3 class="text-center">Sudah Absen</h3>
	        <p class="text-center ms-menu-color">
	        	Sudah dilakukan absensi operasi pada tanggal 
	        	@if (Session::has('sessTglAbsenOp'))
	        		@{{ Session::get('sessTglAbsenOp') }}
	        	@else
	        		@{{ date('Y-m-d') }}
	        	@endif
	        </p>
	        @else
        	<div class="header">
	            <h4 style="margin:-15px 0px 10px 0px;"><strong>Input Absensi @{{ $matchOperasi->nama_op }}</strong></h4>
	        </div>
        	<div class="header">
				<h6>Tanggal : @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</h6>
				<h6>Jam Kerja : @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</h6>
			</div>
          	<div class="content">
             	<form action="@{{ URL::to('absenoperasi/create') }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;">
					<div class="form-group">
						<label class="col-sm-4 control-label" style="text-align:left;">Tanggal Absensi</label>
						<div class="col-sm-5">
		                  <div class="input-group date datetime col-sm-12" data-min-view="2" data-date-format="yyyy-mm-dd">
		                  	@if (Session::has('sessTglAbsenOp'))
		                    <input name="txt-tanggal-absen-op" value="@{{ Session::get('sessTglAbsenOp') }}" class="form-control" size="16" type="text" value="" />
		                    @else
		                    <input name="txt-tanggal-absen-op" value="@{{ date('Y-m-d') }}" class="form-control" size="16" type="text" value="" />
		                    @endif
		                    <span class="input-group-addon btn btn-default"><span class="glyphicon glyphicon-th"></span></span>
		                  </div>									
		                </div>
					</div>
					@foreach ($personelOp as $valPersonelOp)
					<div class="form-group">
						<span class="col-sm-1 control-label">@{{ $idx++ }}.</span>
						<label class="col-sm-11 control-label" style="text-align:left; color:#0096C2;">@{{ $valPersonelOp->nama_lengkap }}</label>
						<span style="margin-left:50px;">
							Jabatan: @{{ $valPersonelOp->jabatan }}
							
							@if ( $valPersonelOp->satuan_kerja != 'tanpa-satuan' )
								@{{ $valPersonelOp->satuan_kerja }}
							@endif
							
							@if ( $valPersonelOp->id_kecamatan == 0 )
								POLRES JOMBANG
							@else
								@foreach ($area as $valArea)
									@if ($valArea->id_kecamatan == $valPersonelOp->id_kecamatan)
										Polsek @{{ $valArea->nama }}
							        @endif
							    @endforeach
							@endif
						</span>
					</div>
					<div class="form-group">
						<label class="col-sm-1 control-label"></label>
						<input name="txt-id-operasi" value="@{{ $valPersonelOp->id_operasi }}" class="form-control hidden" type="text" />
						<input name="txt-id-detail-op[]" value="@{{ $valPersonelOp->id_detail_operasi }}" class="form-control hidden" type="text" />
						<span class="col-sm-4 control-label" style="text-align:left;">Posisi: @{{ $valPersonelOp->posisi }}</span>
						<div class="col-sm-3">
						    <select name="slc-status-op[]" class="form-control">
						    	@if ($valPersonelOp->posisi == 'inti')
						    	<option value="kerja" selected>Dinas</option>
						    	<option value="bebas-kerja">Bebas Dinas</option>
							   	<option value="izin">Izin</option>
							   	@elseif ($valPersonelOp->posisi == 'cadangan')
						    	<option value="kerja">Dinas</option>
						    	<option value="bebas-kerja" selected>Lepas Dinas</option>
							   	<option value="izin">Izin</option>
							   	@endif
							</select>
						</div>
						<div class="col-sm-4">
							<textarea name="txt-keterangan-op[]" placeholder="Keterangan" class="form-control" style="height:34px;"></textarea>
						</div>
					</div>
					@endforeach
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
        @endif
    @endif

@endsection