@extends('operasi.preview')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	@if ( $aktifitasUser['inputOperasi'] == 'available')
    <div class="wizard-row">
		<div class="col-md-12 fuelux" style="padding:0px;">
			<div class="block-wizard">
				<div id="wizard1" class="wizard wizard-ux">
					<ul class="steps">
						<li data-target="#step1" class="active">Operasi<span class="chevron"></span></li>
						<li data-target="#step2">Personel<span class="chevron"></span></li>
						<li data-target="#step3">Telegram<span class="chevron"></span></li>
						<li data-target="#step4">Foto<span class="chevron"></span></li>
						<li data-target="#step5">Konfirmasi<span class="chevron"></span></li>
					</ul>
					<div class="actions">
						<button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i>Kembali</button>
						<button type="button" class="btn btn-xs btn-next btn-default" data-last="Selesai">Lanjut<i class="icon-arrow-right"></i></button>
					</div>
				</div>
				<div class="step-content">
					<form action="@{{ URL::to('operasi/create/post') }}" method="POST" class="form-horizontal group-border-dashed" role="form" parsley-validate novalidate enctype="multipart/form-data"> 
						<div class="step-pane active" id="step1">
							<div class="form-group">
						    	<div class="col-sm-12">
							        <h4 class="">Input Data Operasi</h4>
						      	</div>
						    </div>
						    <div class="form-group">
							    <label class="col-sm-3 control-label">Jenis OP</label>
							    <div class="col-sm-8">
							      <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-jenis-op" class="icheck" value="opkhusus"> Operasi Khusus</label> 
							      <label class="radio-inline"> <input type="radio" name="rad-jenis-op" class="icheck" value="oprutin"> Operasi Rutin</label> 
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Nama OP</label>
							    <div class="col-sm-8">
							      <input name="txt-nama-op" placeholder="Nama Operasi" parsley-trigger="change" type="text" required class="form-control">
							    </div>
							</div>
						  	<div class="form-group">
							    <label class="col-sm-3 control-label">Tanggal</label>
							    <div class="col-sm-4">
							      <input name="txt-tanggal-mulai" placeholder="Tanggal Mulai" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
							    </div>
							    <div class="col-sm-4">
							      <input name="txt-tanggal-selesai" placeholder="Tanggal Selesai" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Jam</label>
							    <div class="col-sm-4">
							      <input name="txt-jam-mulai" placeholder="Jam Mulai (08:00)" parsley-trigger="change" required type="text" class="form-control" size="16">
							    </div>
							    <div class="col-sm-4">
							      <input name="txt-jam-selesai" placeholder="Jam Selesai (17:00)" parsley-trigger="change" required type="text" class="form-control" size="16">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Anggaran Pasti</label>
							    <div class="col-sm-8">
							      <input name="txt-anggaran-pasti" placeholder="Anggaran Pasti (ex:85000)" parsley-type="number" type="text" required class="form-control"/>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Index Anggaran</label>
							    <div class="col-sm-4">
							      <input name="txt-index-anggaran-min" placeholder="Batas Min (ex:10000)" parsley-type="number" type="text" required class="form-control"/>
							    </div>
							    <div class="col-sm-4">
							      <input name="txt-index-anggaran-max" placeholder="Batas Max (ex:15000)" parsley-type="number" type="text" required class="form-control"/>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Jml. Personel</label>
							    <div class="col-sm-8">
							      <input name="txt-jumlah-personel" id="txt-jumlah-personel" placeholder="Jumlah Personel" parsley-type="number" type="text" required class="form-control">
							      <p class="color-primary" style="padding-top:5px; font-size:12px;">* Jumlah keseluruhan personel, termasuk KA / WAKA (Polres / Polsek) bila disertakan</p>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Keterangan</label>
							    <div class="col-sm-8">
							      <textarea name="txt-keterangan" placeholder="Keterangan Operasi" type="text" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
				                <label class="col-sm-3 control-label">Status</label>
				                <div class="col-sm-6">
				                	<select name="slc-status-operasi" id="slc-status-operasi" class="form-control" parsley-trigger="change" required>
					                    <option value="proses" selected>Dalam Proses Pelaksanaan</option>
					                    <option value="selesai">Selesai</option>
					                    <option value="tunda">Tunda</option>
					                    <option value="batal">Batal</option>
				                	</select>
				                </div>
				            </div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
							        <button type="reset" class="btn btn-default">Batal</button>
							        <button data-wizard="#wizard1" id="btn-input-operasi" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
						      	</div>
						    </div>
						</div>
						<div class="step-pane" id="step2">
							<div class="form-group">
						    	<div class="col-sm-12">
							        <h4 class="">Input Request Personel Operasi</h4>
						      	</div>
						    </div>
							<div class="form-group">
						    	<div class="col-sm-12">
							        <p>Total Personel Yang Dibutuhkan : <label id="view-jumlah-personel" class="control-label"></label> Orang</p>
						      	</div>
						    </div>
						    <div class="form-group">
						    	<div class="col-sm-12">
							        <label class="control-label">Input Personel By Request</label>
							        <p>Input personel operasi dilakukan oleh masing-masing Unit Fungsi setelah sebelumnya ditentukan jumlahnya oleh admin Ops.</p>
							        <p class="color-success">KA / WAKA POLRES berada dalam satuan ops. Jika ingin menyertakan, kirim request ke bagian ops.</p>
						      	</div>
						    </div>
					        <div class="form-group">
							    <div class="col-sm-12" style="padding-right:0px">
							    <button id="btn-add-form-req-personel" class="btn btn-primary col-sm-12" style="height:36px;"><i class="fa fa-plus"></i> Tambah Form Input Jumlah Personel</button>
							    </div>
							</div>

							<div id="content-form-req-personel">
								<script id="form-req-personel" type="text/x-handlebars">
									<div id="row-form-req-personel-{{ nomor }}" class="form-group">
									    <div id="div-slc-req-penerima-{{ nomor }}" class="col-sm-5" style="padding-right:0px">
									    	<select name="slc-req-penerima[]" id="slc-req-penerima-{{ nomor }}" class="form-control" parsley-trigger="change" required style="height:36px" onchange="Operasi.showSelect( {{ nomor }} );">
									    		<option disabled selected>Pilih Unit</option>
									    		@foreach ($userUnit as $valUserUnit)
									    			@if ($valUserUnit->id_kecamatan == 0)
									    			<option value="@{{ $valUserUnit->id_user }}">POLRES @{{ $valUserUnit->nama }}</option>
									    			@else
													<option value="@{{ $valUserUnit->id_user }}">Polsek @{{ $valUserUnit->nama }}</option>
													@endif
											    @endforeach
											</select>
										</div>
										<div id="div-slc-req-satker-{{ nomor }}" class="col-sm-3" style="padding-right:0px">
									    	<select name="slc-req-satker[]" id="slc-req-satker-{{ nomor }}" class="form-control" parsley-trigger="change" required style="height:36px">
									    		<option disabled selected>Pilih Satker</option>
									    		<option value="semua">Semua Satker</option>
									    		@foreach ($satker as $valSatker)
									    			<option value="@{{ $valSatker->satuan_kerja }}">@{{ $valSatker->satuan_kerja }}</option>
									    		@endforeach
											</select>
										</div>
									    <div class="col-sm-3" style="padding-right:0px">
									    	<input name="txt-req-jumlah-personel-unit[]" id="txt-req-jumlah-personel-unit" placeholder="Jumlah Personel" parsley-type="number" type="text" required class="form-control" style="height:36px">
									    </div>
									    <div class="col-sm-1" style="padding-left:6px">
									    	<a href="javascript:Operasi.hapusFormReqPersonel( {{ nomor }} )" class="btn btn-danger" style="height:36px; margin-left:0px;"><i class="fa fa-times" style="color:white;"></i></a>
									    </div>
									</div>
								</script>
							</div>
							

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
							        <h4 class="">Input Data Telegram</h4>
						      	</div>
						    </div>
						    <div class="form-group">
							    <label class="col-sm-3 control-label">Dari</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-dari" placeholder="Jabatan Pengirim" parsley-trigger="change" type="text" required class="form-control">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Nama Pengirim</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-nama" placeholder="Nama Pengirim" parsley-trigger="change" type="text" required class="form-control">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">NRP</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-nrp" placeholder="NRP Pengirim" parsley-type="number" type="text" required class="form-control">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Pangkat</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-pangkat" placeholder="Pangkat Pengirim" type="text" class="form-control">
							    </div>
							</div>
						  	<div class="form-group">
		                        <label class="col-sm-3 control-label">Kepada</label>
		                        <div class="col-sm-8">
		                          	<textarea name="txt-tgram-kepada" id="txt-tgram-kepada" placeholder="Nama Penerima" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
		                        </div>
		                    </div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Tembusan</label>
		                        <div class="col-sm-8">
		                          	<textarea name="txt-tgram-tembusan" id="txt-tgram-tembusan" placeholder="Nama Tembusan" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
		                        </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Derajat</label>
							    <div class="col-sm-3">
							      <input name="txt-tgram-derajat" placeholder="Derajat" parsley-trigger="change" type="text" required class="form-control">
							    </div>
							    <label class="col-sm-2 control-label">Klasifikasi</label>
							    <div class="col-sm-3">
							      <input name="txt-tgram-klasifikasi" placeholder="Klasifikasi" parsley-trigger="change" type="text" required class="form-control">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Nomor Telegram</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-nomor" placeholder="Nomor Telegram" type="text" required class="form-control"/>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Tanggal</label>
							    <div class="col-sm-8">
							      <input name="txt-tgram-tanggal" placeholder="Tanggal Telegram" type="text" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Isi AAA</label>
							    <div class="col-sm-8">
							      	<textarea name="txt-tgram-isiA" id="txt-tgram-isiA" placeholder="Isi Kolom AAA" style="height:150px;" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Isi BBB</label>
							    <div class="col-sm-8">
							      	<textarea name="txt-tgram-isiB" id="txt-tgram-isiB" placeholder="Isi Kolom BBB" style="height:150px;" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Isi CCC</label>
							    <div class="col-sm-8">
							      	<textarea name="txt-tgram-isiC" id="txt-tgram-isiC" placeholder="Isi Kolom CCC" style="height:150px;" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Isi DDD</label>
							    <div class="col-sm-8">
							      	<textarea name="txt-tgram-isiD" id="txt-tgram-isiD" placeholder="Isi Kolom DDD" style="height:150px;" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
							    <label class="col-sm-3 control-label">Isi EEE</label>
							    <div class="col-sm-8">
							      	<textarea name="txt-tgram-isiE" id="txt-tgram-isiE" placeholder="Isi Kolom EEE" style="height:150px;" class="form-control"></textarea>
							    </div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
							        <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
							        <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
						      	</div>
						    </div>
					    </div>
					    <div class="step-pane" id="step4">
							<div class="form-group">
						    	<div class="col-sm-12">
							        <h4 class="">Input Foto Operasi</h4>
						      	</div>
						    </div>
						    <div class="form-group">
						    	<div class="col-sm-12">
							        <p>Pastikan format gambar yang Anda upload adalah JPEG atau PNG.</p>
						      	</div>
						    </div>
							<div class="form-group">
							    <div class="col-sm-12" style="padding-right:0px">
							    <button id="btn-add-form-foto-operasi" class="btn btn-primary col-sm-12" style="height:36px;"><i class="fa fa-plus"></i> Tambah Foto Operasi</button>
							    </div>
							</div>

							<div id="content-form-foto-ops">
								<script id="form-foto-ops" type="text/x-handlebars">
									<div id="row-form-foto-ops-{{ nomor }}" class="form-group">
									    <div class="col-sm-11" style="padding-right:0px">
									    	<input name="file-foto-op[]" id="file-foto-op-{{ nomor }}" type="file" class="form-control">
									    </div>
									    <div class="col-sm-1" style="padding-left:6px">
									    	<a href="javascript:Operasi.hapusFormFotoOps( {{ nomor }} )" class="btn btn-danger" style="margin-left:0px;"><i class="fa fa-times" style="color:white;"></i></a>
									    </div>
									</div>
								</script>
							</div>
							

							<div class="form-group">
						    	<div class="col-sm-12">
							        <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
							        <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
							    </div>
						    </div>
						</div>
					    <div class="step-pane" id="step5">
					    	<div class="form-group">
						    	<div class="col-sm-12">
							        <h4 class="">Term of Agreement</h4>
						      	</div>
						    </div>
					    	<div class="form-group">
						    	<div class="col-sm-12">
							        <p>Pastikan semua form telah diisi dengan benar. Request yang dikirim tidak dapat dibatalkan.</p>
					      		</div>
							</div>
					      	<div class="form-group">
					      		<div class="col-sm-12">
					      			<button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
					      			<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data &amp; Kirim Request</button>
					      		</div>
					      	</div>
					    </div>
					</form>
				</div>
			</div>
		</div>
    </div>
    @endif

@endsection