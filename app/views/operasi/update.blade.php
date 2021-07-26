@extends('operasi.preview')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

	<div class="cl-mcont" style="padding-bottom:0px">
		@if ( $aktifitasUser['inputOperasi'] == 'available')
	    <div class="row wizard-row">
			<div class="col-md-12 fuelux">
				<div class="block-wizard">
					<div id="wizard1" class="wizard wizard-ux">
						<ul class="steps">
							<li data-target="#step1" class="active">Operasi<span class="chevron"></span></li>
							<li data-target="#step2">Personel<span class="chevron"></span></li>
							<li data-target="#step3">Telegram<span class="chevron"></span></li>
							<li data-target="#step4">Konfirmasi<span class="chevron"></span></li>
						</ul>
						<div class="actions">
							<button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i>Kembali</button>
							<button type="button" class="btn btn-xs btn-next btn-default" data-last="Selesai">Lanjut<i class="icon-arrow-right"></i></button>
						</div>
					</div>
					<div class="step-content">
						<form action="@{{ URL::to('operasi/update/post', $matchOps->id_operasi ) }}" method="POST" class="form-horizontal group-border-dashed" role="form" parsley-validate novalidate enctype="multipart/form-data"> 
							<div class="step-pane active" id="step1">
								<div class="form-group">
							    	<div class="col-sm-12">
								        <h4 class="">Ubah Data Operasi</h4>
							      	</div>
							    </div>
							    <div class="form-group">
			                        <label class="col-sm-3 control-label">Foto OP</label>
			                        <div class="col-sm-8">
			                            <input type="file" name="file-foto-op" value="@{{ matchOps->foto_op }}" style="margin-top:5px;">
			                        </div>
			                    </div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Jenis OP</label>
								    <div class="col-sm-8">
								    	@if ( $matchOps->jenis_op == 'opkhusus' )
								      	<label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-jenis-op" class="icheck" value="opkhusus"> Operasi Khusus</label> 
								      	<label class="radio-inline"> <input type="radio" name="rad-jenis-op" class="icheck" value="oprutin"> Operasi Rutin</label> 
								      	@elseif ( $matchOps->jenis_op == 'oprutin' )
								      	<label class="radio-inline" style="padding-left:1px;"> <input type="radio" name="rad-jenis-op" class="icheck" value="opkhusus"> Operasi Khusus</label> 
								      	<label class="radio-inline"> <input type="radio" checked="" name="rad-jenis-op" class="icheck" value="oprutin"> Operasi Rutin</label> 
								      	@endif
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Nama OP</label>
								    <div class="col-sm-8">
								      <input name="txt-nama-op" value="@{{ matchOps->nama_op }}" placeholder="Nama Operasi" parsley-trigger="change" type="text" required class="form-control">
								    </div>
								</div>
							  	<div class="form-group">
								    <label class="col-sm-3 control-label">Tanggal</label>
								    <div class="col-sm-4">
								      <input name="txt-tanggal-mulai" value="@{{ matchOps->tanggal_mulai }}" placeholder="Tanggal Mulai" parsley-trigger="change" required type="datetime" class="form-control date datetime" size="16">
								    </div>
								    <div class="col-sm-4">
								      <input name="txt-tanggal-selesai" value="@{{ matchOps->tanggal_selesai }}" placeholder="Tanggal Selesai" parsley-trigger="change" required type="datetime" class="form-control date datetime" size="16">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Jam</label>
								    <div class="col-sm-4">
								      <input name="txt-jam-mulai" value="@{{ matchOps->jam_mulai }}" placeholder="Jam Mulai" parsley-trigger="change" required type="text" class="form-control" size="16">
								    </div>
								    <div class="col-sm-4">
								      <input name="txt-jam-selesai" value="@{{ matchOps->jam_selesai }}" placeholder="Jam Selesai" parsley-trigger="change" required type="text" class="form-control" size="16">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Anggaran Pasti</label>
								    <div class="col-sm-8">
								      <input name="txt-anggaran-pasti" value="@{{ matchOps->anggaran_pasti }}" placeholder="Anggaran Pasti (ex:85000)" parsley-type="number" type="text" required class="form-control"/>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Index Anggaran</label>
								    <div class="col-sm-4">
								      <input name="txt-index-anggaran-min" value="@{{ matchOps->index_anggaran_min }}" placeholder="Batas Min (ex:10000)" parsley-type="number" type="text" required class="form-control"/>
								    </div>
								    <div class="col-sm-4">
								      <input name="txt-index-anggaran-max" value="@{{ matchOps->index_anggaran_max }}" placeholder="Batas Max (ex:15000)" parsley-type="number" type="text" required class="form-control"/>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Jml. Personel</label>
								    <div class="col-sm-8">
								      <input name="txt-jumlah-personel" value="@{{ matchOps->jumlah_personel }}" id="txt-jumlah-personel" placeholder="Jumlah Personel" parsley-type="number" type="text" required class="form-control">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Keterangan</label>
								    <div class="col-sm-8">
								      <textarea name="txt-keterangan" placeholder="Keterangan Operasi" type="text" class="form-control">@{{ matchOps->keterangan_op }}</textarea>
								    </div>
								</div>
								<div class="form-group">
					                <label class="col-sm-3 control-label">Status</label>
					                <div class="col-sm-6">
					                	<select name="slc-status-operasi" id="slc-status-operasi" class="form-control" parsley-trigger="change" required>
					                		@if ( matchOps->status_op == 'proses' )
						                    <option value="proses" selected>Dalam Proses Pelaksanaan</option>
						                    <option value="selesai">Selesai</option>
						                    <option value="tunda">Tunda</option>
						                    <option value="batal">Batal</option>
						                    @elseif ( matchOps->status_op == 'selesai' )
						                    <option value="proses">Dalam Proses Pelaksanaan</option>
						                    <option value="selesai" selected>Selesai</option>
						                    <option value="tunda">Tunda</option>
						                    <option value="batal">Batal</option>
						                    @elseif ( matchOps->status_op == 'tunda' )
						                    <option value="proses">Dalam Proses Pelaksanaan</option>
						                    <option value="selesai">Selesai</option>
						                    <option value="tunda" selected>Tunda</option>
						                    <option value="batal">Batal</option>
						                    @elseif ( matchOps->status_op == 'batal' )
						                    <option value="proses">Dalam Proses Pelaksanaan</option>
						                    <option value="selesai">Selesai</option>
						                    <option value="tunda">Tunda</option>
						                    <option value="batal" selected>Batal</option>
						                    @endif
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
								        <h4 class="">Ubah Request Personel Operasi</h4>
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
							      	</div>
							    </div>
						        <div class="form-group">
								    <div class="col-sm-12" style="padding-right:0px">
								    <button id="btn-add-form-req-personel" class="btn btn-primary col-sm-12" style="height:36px;"><i class="fa fa-plus"></i> Tambah Form Input Jumlah Personel</button>
								    </div>
								</div>


								<div id="content-form-req-personel">
									<script id="form-req-personel" type="text/x-handlebars">
										@foreach ($request as $valRequest)
										<div id="row-form-req-personel-@{{ valRequest->id_request }}" class="form-group">
										    <div id="div-slc-req-penerima-@{{ valRequest->id_request }}" class="col-sm-5" style="padding-right:0px">
										    	<select name="slc-req-penerima[]" id="slc-req-penerima-@{{ valRequest->id_request }}" class="form-control" parsley-trigger="change" required style="height:36px" onchange="Operasi.showSelect( @{{ valRequest->id_request }} );">
										    		<option disabled selected>Pilih Unit</option>
										    		@foreach ( $userUnit as $valUserUnit )
										    			@if ( $valUserUnit->id_kecamatan == 0 )
										    				@if ( $valUserUnit->id_user == $valRequest->id_penerima )
										    				<option value="@{{ $valUserUnit->id_user }}" selected>POLRES @{{ $valUserUnit->nama }}</option>
										    				@else
										    				<option value="@{{ $valUserUnit->id_user }}">POLRES @{{ $valUserUnit->nama }}</option>
										    				@endif
										    			@else
															@if ( $valUserUnit->id_user == $valRequest->id_penerima )
										    				<option value="@{{ $valUserUnit->id_user }}" selected>Polsek @{{ $valUserUnit->nama }}</option>
										    				@else
										    				<option value="@{{ $valUserUnit->id_user }}">Polsek @{{ $valUserUnit->nama }}</option>
										    				@endif
														@endif
												    @endforeach
												</select>
											</div>
											<div id="div-slc-req-satker-@{{ valRequest->id_request }}" class="col-sm-3" style="padding-right:0px">
										    	<select name="slc-req-satker[]" id="slc-req-satker-@{{ valRequest->id_request }}" class="form-control" parsley-trigger="change" required style="height:36px">
										    		<option disabled selected>Pilih Satker</option>
										    		@if ( $valRequest->satuan_kerja == 'semua' )
										    		<option value="semua" selected>Semua Satker</option>
										    		@else
										    		<option value="semua">Semua Satker</option>
										    		@endif
										    		@foreach ($satker as $valSatker)
										    			@if ( $valRequest->satuan_kerja == $valSatker->satuan_kerja )
										    			<option value="@{{ $valSatker->satuan_kerja }}" selected>@{{ $valSatker->satuan_kerja }}</option>
										    			@else
										    			<option value="@{{ $valSatker->satuan_kerja }}">@{{ $valSatker->satuan_kerja }}</option>
										    			@endif
										    		@endforeach
												</select>
											</div>
										    <div class="col-sm-3" style="padding-right:0px">
										    	<input name="txt-req-jumlah-personel-unit[]" value="@{{ $valRequest->jumlah_personel_perunit }}" id="txt-req-jumlah-personel-unit" placeholder="Jumlah Personel" parsley-type="number" type="text" required class="form-control" style="height:36px">
										    </div>
										    <div class="col-sm-1" style="padding-left:6px">
										    	<a href="javascript:Operasi.hapusFormReqPersonel( @{{ valRequest->id_request }} )" class="btn btn-danger" style="height:36px; margin-left:0px;"><i class="fa fa-times" style="color:white;"></i></a>
										    </div>
										</div>
										@endforeach
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
								      <input name="txt-tgram-dari" value="@{{ $matchTgram->tgram_dari }}" placeholder="Jabatan Pengirim" parsley-trigger="change" type="text" required class="form-control">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Nama Pengirim</label>
								    <div class="col-sm-8">
								      <input name="txt-tgram-nama" value="@{{ $matchTgram->tgram_nama }}" placeholder="Nama Pengirim" parsley-trigger="change" type="text" required class="form-control">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">NRP</label>
								    <div class="col-sm-8">
								      <input name="txt-tgram-nrp" value="@{{ $matchTgram->tgram_nrp }}" placeholder="NRP Pengirim" parsley-type="number" type="text" required class="form-control">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Pangkat</label>
								    <div class="col-sm-8">
								      <input name="txt-tgram-pangkat" value="@{{ $matchTgram->tgram_pangkat }}" placeholder="Pangkat Pengirim" type="text" class="form-control">
								    </div>
								</div>
							  	<div class="form-group">
			                        <label class="col-sm-3 control-label">Kepada</label>
			                        <div class="col-sm-8">
			                          	<textarea name="txt-tgram-kepada" value="@{{ $matchTgram->tgram_kepada }}" id="txt-tgram-kepada" placeholder="Nama Penerima" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
			                        </div>
			                    </div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Tembusan</label>
			                        <div class="col-sm-8">
			                          	<textarea name="txt-tgram-tembusan" value="@{{ $matchTgram->tgram_tembusan }}" id="txt-tgram-tembusan" placeholder="Nama Tembusan" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
			                        </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Derajat</label>
								    <div class="col-sm-3">
								      <input name="txt-tgram-derajat" value="@{{ $matchTgram->tgram_derajat }}" placeholder="Derajat" parsley-trigger="change" type="text" required class="form-control">
								    </div>
								    <label class="col-sm-2 control-label">Klasifikasi</label>
								    <div class="col-sm-3">
								      <input name="txt-tgram-klasifikasi" value="@{{ $matchTgram->tgram_klasifikasi }}" placeholder="Klasifikasi" parsley-trigger="change" type="text" required class="form-control">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Nomor</label>
								    <div class="col-sm-8">
								      <input name="txt-tgram-nomor" value="@{{ $matchTgram->tgram_nomor }}" placeholder="Nomor Telegram" type="text" required class="form-control"/>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Tanggal</label>
								    <div class="col-sm-8">
								      <input name="txt-tgram-tanggal" value="@{{ $matchTgram->tgram_tanggal }}" placeholder="Tanggal Telegram" type="text" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Isi AAA</label>
								    <div class="col-sm-8">
								      	<textarea name="txt-tgram-isiA" value="@{{ $matchTgram->tgram_isia }}" id="txt-tgram-isiA" placeholder="Isi Kolom AAA" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Isi BBB</label>
								    <div class="col-sm-8">
								      	<textarea name="txt-tgram-isiB" value="@{{ $matchTgram->tgram_isib }}" id="txt-tgram-isiB" placeholder="Isi Kolom BBB" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Isi CCC</label>
								    <div class="col-sm-8">
								      	<textarea name="txt-tgram-isiC" value="@{{ $matchTgram->tgram_isic }}" id="txt-tgram-isiC" placeholder="Isi Kolom CCC" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Isi DDD</label>
								    <div class="col-sm-8">
								      	<textarea name="txt-tgram-isiD" value="@{{ $matchTgram->tgram_isid }}" id="txt-tgram-isiD" placeholder="Isi Kolom DDD" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
								    </div>
								</div>
								<div class="form-group">
								    <label class="col-sm-3 control-label">Isi EEE</label>
								    <div class="col-sm-8">
								      	<textarea name="txt-tgram-isiE" value="@{{ $matchTgram->tgram_isie }}" id="txt-tgram-isiE" placeholder="Isi Kolom EEE" parsley-trigger="change" required style="height:150px;" class="form-control"></textarea>
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
								        <h4 class="">Term of Agreement</h4>
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
	    @else
    	<h3 class="text-center ms-menu-self"><i class="fa fa-eye"></i> Lihat Detail Operasi</h3>
        <p class="text-center ms-menu-color">Klik NAMA OPERASI pada tabel untuk melihat detail data operasi</p>
        @endif
    </div>

@endsection