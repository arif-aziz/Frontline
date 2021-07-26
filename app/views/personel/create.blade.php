@extends('personel.index')

@section('container_personel')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
        
    @if ( $aktifitasUser['inputPersonel'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Input Personel Polisi</strong></h4>
    </div>
    <div class="content">
       <form action="@{{ URL::to('personel/create') }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
          <div class="form-group">
              <label class="col-sm-3 control-label">Foto</label>
              <div class="col-sm-6">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width:130px;height:130px;">
                        <img src="/images/fotodefault.jpg">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:130px;max-height:130px;"></div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Pilih</span>
                        <span class="fileinput-exists">Ubah</span>
                        <input type="file" name="file-foto-personel" id="file-foto-personel">
                        </span>
                      <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
                    </div>
                </div>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">NRP</label>
              <div class="col-sm-7">
                <input name="txt-nrp" id="txt-nrp" placeholder="NRP" parsley-type="number" type="text" required class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Nama Lengkap</label>
              <div class="col-sm-7">
                <input name="txt-nama-lengkap" id="txt-nama-lengkap" placeholder="Nama Lengkap" parsley-trigger="change" type="text" required class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tempat Lahir</label>
              <div class="col-sm-7">
                <input name="txt-tempat-lahir" id="txt-tempat-lahir" placeholder="Tempat Lahir" parsley-trigger="change" type="text" required class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Lahir</label>
              <div class="col-sm-5">
                <input name="txt-tanggal-lahir" id="txt-tanggal-lahir" placeholder="Tanggal Lahir" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-7">
                <textarea name="txt-alamat" id="txt-alamat" placeholder="Alamat" class="form-control"></textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Pangkat</label>
              <div class="col-sm-7">
                <input name="txt-pangkat" id="txt-pangkat" placeholder="Pangkat" parsley-trigger="change" type="text" required class="form-control" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Jabatan</label>
              <div class="col-sm-7">
                <input name="txt-jabatan" id="txt-jabatan" placeholder="Jabatan" parsley-trigger="change" type="text" required class="form-control" />
                <p class="color-primary" style="padding-top:5px; font-size:12px;">* Khusus penulisan jabatan KA / WAKA (Polres / Polsek) tanpa spasi &amp; tanpa daerah</p>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Mulai Menjabat</label>
              <div class="col-sm-5">
                <input name="txt-tanggal-jabatan" id="txt-tanggal-jabatan" placeholder="Tanggal Mulai Menjabat" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Instansi</label>
              <div class="col-sm-7">
                <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-instansi" class="icheck" value="Polres" /> Polres</label> 
                <label class="radio-inline"> <input type="radio" name="rad-instansi" class="icheck" value="Polsek" /> Polsek</label> 
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Wilayah</label>
              <div class="col-sm-7">
                <select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required>
                    <option disabled selected>Wilayah Kepolisian</option>
                    <option value="0">POLRES JOMBANG</option>
                    @foreach($wilayah as $valWilayah)
                    	<option value="@{{ $valWilayah->id_kecamatan }}">Polsek @{{ $valWilayah->nama }}</option>
                    @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Satuan Kerja</label>
              <div class="col-sm-7">
                	<select name="slc-satuan-kerja" id="slc-satuan-kerja" class="select2" parsley-trigger="change" required>
                      <option disabled selected>Satuan Kerja</option>
                      <option value="tanpa-satuan">Tanpa satuan</option>
                      @foreach ($satker as $valSatker)
                        <option value="@{{ $valSatker->satuan_kerja }}">@{{ $valSatker->satuan_kerja }}</option>
                      @endforeach
                  </select>
                  <p class="color-primary" style="padding-top:5px; font-size:12px;">* Jika jabatan personel bersifat general pilih TANPA SATUAN (misal: Kapolres)</p>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Riwayat Pendidikan</label>
              <div class="col-sm-9">
                	<textarea name="txt-riwayat-pendidikan" id="txt-riwayat-pendidikan" placeholder="Riwayat Pendidikan" style="height:150px;" class="form-control"></textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Riwayat Kerja</label>
              <div class="col-sm-9">
              	<textarea name="txt-riwayat-kerja" id="txt-riwayat-kerja" placeholder="Riwayat Kerja" style="height:150px;" class="form-control"></textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Status Personel</label>
              <div class="col-sm-3">
                <select name="slc-status-personel" id="slc-status-personel" class="form-control" parsley-trigger="change" required>
              		<option value="aktif" selected>Aktif</option>
              		<option value="non-aktif">Non Aktif</option>
              		<option value="mutasi">Mutasi</option>
              	</select>
              </div>
          </div>
          <div class="form-group">
              <div class="col-sm-3"></div>
              <div class="col-sm-6">
                	<button type="submit" class="col-sm-5 btn btn-primary">Simpan</button>
                  <a href="@{{ URL::to('personel') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
              </div>
          </div>
    	 </form>
    </div>
    @endif
	
@endsection