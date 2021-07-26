@extends('operasi.index')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php
$idx = 1;
?>
    
    @if ( $aktifitasUser['inputOperasi'] == 'available')
    <div class="block-flat ms-no-border ms-no-shadow" style="padding:0px;">
	    <div class="content" style="padding:0px;">
	    	@if (count($cekRequest) == 0)
	    	<div class="wizard-row">
				<div class="col-md-12 fuelux" style="padding:0px;">
					<div class="block-wizard">
						<div id="wizard1" class="wizard wizard-ux">
							<ul class="steps">
								<li data-target="#step1" class="active">Surat Perintah<span class="chevron"></span></li>
								<li data-target="#step2">Lampiran Surat<span class="chevron"></span></li>
								<li data-target="#step3">Term of Agreement<span class="chevron"></span></li>
							</ul>
							<div class="actions">
								<button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i>Kembali</button>
								<button type="button" class="btn btn-xs btn-next btn-default" data-last="Selesai">Lanjut<i class="icon-arrow-right"></i></button>
							</div>
						</div>
						<div class="step-content">
							<form action="@{{ URL::to('operasi/sprin/create', $matchOperasi->id_operasi) }}" method="POST" id="form-user" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
								<div class="step-pane active" id="step1">
									<div class="form-group">
								    	<div class="col-sm-12">
									        <h4 class="">Input Surat Perintah</h4>
								      	</div>
								    </div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Nama</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-pengirim" placeholder="Nama Pengirim" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">NRP</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-nrp" placeholder="NRP Pengirim" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Jabatan</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-jabatan" placeholder="Jabatan Pengirim" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Pangkat</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-pangkat" placeholder="Pangkat Pengirim" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Nomor Sprin</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-nomor" placeholder="Nomor Sprin" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Dikeluarkan di</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-dikeluarkan-di" placeholder="Lokasi Terbit Perintah" parsley-trigger="change" type="text" required class="form-control">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Tanggal</label>
									    <div class="col-sm-8">
									      <input name="txt-sprin-tanggal" placeholder="Tanggal Perintah" type="text" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
									    </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Pertimbangan</label>
				                        <div class="col-sm-8">
				                          	<textarea name="txt-sprin-pertimbangan" id="txt-sprin-pertimbangan" placeholder="Pertimbangan Perintah" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
				                        </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Dasar</label>
				                        <div class="col-sm-8">
				                          	<textarea name="txt-sprin-dasar" id="txt-sprin-dasar" placeholder="Dasar Perintah" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
				                        </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Kepada</label>
				                        <div class="col-sm-8">
				                          	<textarea name="txt-sprin-kepada" id="txt-sprin-kepada" placeholder="Tujuan Perintah" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
				                        </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Untuk</label>
				                        <div class="col-sm-8">
				                          	<textarea name="txt-sprin-untuk" id="txt-sprin-untuk" placeholder="Tugas Perintah" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
				                        </div>
									</div>
									<div class="form-group">
									    <label class="col-sm-3 control-label">Tembusan</label>
				                        <div class="col-sm-8">
				                          	<textarea name="txt-sprin-tembusan" id="txt-sprin-tembusan" placeholder="Nama Tembusan" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
				                        </div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-2 col-sm-10">
									        <a href="@{{ URL::to('operasi/dokumen', $matchOperasi->id_operasi) }}" class="btn btn-default btn-flat" style="padding:6px 11px;">Batal</a>
									        <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
								      	</div>
								    </div>
								</div>
								<div class="step-pane" id="step2">
									<div class="form-group">
								    	<div class="col-sm-12">
									        <h4 class="">Input Lampiran</h4>
								      	</div>
								    </div>
								    <div class="form-group">
								    	<div class="col-sm-12">
									        <p>Masukkan keterangan sesuai posisi &amp; tugas personel dalam operasi.</p>
								      	</div>
								    </div>
								    @foreach ($detailOperasi as $valDetailOperasi)
								    <div class="form-group">
								    	<div class="col-sm-12">
								    		@{{ $idx++ }}.
									        <label>@{{ $valDetailOperasi->nama_lengkap }}</label>
									        <span>(@{{ $valDetailOperasi->posisi }})</span>
									        <span> - @{{ $valDetailOperasi->jabatan }}</span>
								    	</div>
								    	<div class="col-sm-12">
									        <div class="col-sm-12">
									        	<input name="txt-id-detail-op[]" type="text" class="form-control hidden" value="@{{ $valDetailOperasi->id_detail_operasi }}">
										      	<input name="txt-keterangan-detail-op-@{{ $valDetailOperasi->id_detail_operasi }}" placeholder="Keterangan dalam operasi" type="text" class="form-control">
										    </div>
								      	</div>
								    </div>
								    @endforeach
									<div class="form-group">
								    	<div class="col-sm-12">
									        <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
									        <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
									    </div>
								    </div>
								</div>
							    <div class="step-pane" id="step3">
							    	<div class="form-group">
								    	<div class="col-sm-12">
									        <h4 class="">Term of Agreement</h4>
								      	</div>
								    </div>
							    	<div class="form-group">
								    	<div class="col-sm-12">
									        <p>Pastikan semua form telah diisi dengan benar.</p>
							      		</div>
									</div>
							      	<div class="form-group">
							      		<div class="col-sm-12">
							      			<button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
							      			<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Terbitkan Surat Perintah</button>
							      		</div>
							      	</div>
							    </div>
							</form>
						</div>
					</div>
				</div>
		    </div>
		    @else
			<h3 class="text-center ms-menu-self"><i class="fa fa-eye"></i> Surat Perintah Belum Dapat Dibuat</h3>
	    	<p class="text-center ms-menu-color">Pastikan semua Request Personel telah diterima oleh satuan yang telah ditentukan. Klik nama operasi untuk melihat DETAIL OPERASI.</p>
	    	<p class="text-center"><a href="@{{ URL::to('operasi/dokumen/'. $matchOperasi->id_operasi) }}">Kembali Dokumen @{{ $matchOperasi->nama_op }}</a></p>
		    @endif
    	</div>
	</div>
    @endif

@endsection