@extends('personel.index')

@section('container_personel')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>
  
    @if ( $aktifitasUser['inputPersonel'] == 'available' )
    <div class="header">
        <h4 style="margin:-15px 0px 10px 0px;"><strong>Hapus Personel Polisi</strong></h4>
    </div>
    <div class="content">
       <form action="@{{ URL::to('personel/update', $matchPersonel->id_personel) }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
          <div class="form-group">
              <label class="col-sm-3 control-label">Foto</label>
              <div class="col-sm-6">
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-new thumbnail" style="width:130px;height:130px;">
                        @if($matchPersonel->foto_personel == NULL || $matchPersonel->foto_personel == 'fotodefault.jpg')
                        <img src="/images/fotodefault.jpg">
                        @else
                        <img src="/images/personel/@{{ $matchPersonel->foto_personel }}">
                        @endif
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:130px;max-height:130px;"></div>
                    <div>
                        <span class="btn btn-primary btn-file">
                        <span class="fileinput-new">Pilih</span>
                        <span class="fileinput-exists">Ubah</span>
                        @if($matchPersonel->foto_personel == NULL || $matchPersonel->foto_personel == 'fotodefault.jpg')
                        <input name="file-foto-personel" type="file">
                        @else
                        <input name="file-foto-personel" value="@{{ $matchPersonel->foto_personel }}" type="file">
                        @endif
                        </span>
                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
                    </div>
                </div>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">NRP</label>
              <div class="col-sm-6">
                <input name="txt-nrp" value="@{{ $matchPersonel->nrp }}" placeholder="NRP" parsley-type="number" type="text" required class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Nama Lengkap</label>
              <div class="col-sm-6">
                <input name="txt-nama-lengkap" value="@{{ $matchPersonel->nama_lengkap }}" placeholder="Nama Lengkap" parsley-trigger="change" type="text" required class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tempat Lahir</label>
              <div class="col-sm-6">
                  <input name="txt-tempat-lahir" value="@{{ $matchPersonel->tempat_lahir }}" placeholder="Tempat Lahir" parsley-trigger="change" type="text" required class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Lahir</label>
              <div class="col-sm-6">
                <input name="txt-tanggal-lahir" value="@{{ $matchPersonel->tanggal_lahir }}" placeholder="Tanggal Lahir" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Alamat</label>
              <div class="col-sm-6">
                <textarea name="txt-alamat" placeholder="Alamat" class="form-control">@{{ $matchPersonel->alamat }}</textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Pangkat</label>
              <div class="col-sm-6">
                <input name="txt-pangkat" value="@{{ $matchPersonel->pangkat }}" placeholder="Pangkat" parsley-trigger="change" type="text" required class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Jabatan</label>
              <div class="col-sm-6">
                <input name="txt-jabatan" value="@{{ $matchPersonel->jabatan }}" placeholder="Jabatan" parsley-trigger="change" type="text" required class="form-control">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Tanggal Mulai Jabatan</label>
              <div class="col-sm-6">
                <input name="txt-tanggal-jabatan" value="@{{ $matchPersonel->tanggal_jabatan }}" placeholder="Tanggal Mulai Jabatan" parsley-trigger="change" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16" type="text" />
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Instansi</label>
              <div class="col-sm-6">
                @if( $matchPersonel->instansi == 'polres' )
                <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-instansi" class="icheck" value="Polres"> Polres</label> 
                <label class="radio-inline"> <input type="radio" name="rad-instansi" class="icheck" value="Polsek"> Polsek</label> 
                @else
                <label class="radio-inline" style="padding-left:1px;"> <input type="radio" name="rad-instansi" class="icheck" value="Polres"> Polres</label> 
                <label class="radio-inline"> <input type="radio" checked="" name="rad-instansi" class="icheck" value="Polsek"> Polsek</label> 
                @endif
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Wilayah</label>
              <div class="col-sm-6">
                <select name="slc-wilayah" id="slc-wilayah" class="select2" parsley-trigger="change" required>
                    <option disabled selected>Wilayah Kepolisian</option>
                    @if( $matchPersonel->id_kecamatan == 0 )
                    <option value="0" selected>POLRES JOMBANG</option>
                    @else
                    <option value="0">POLRES JOMBANG</option>
                    @endif

                    @foreach($wilayah as $valWilayah)
                      @if( $valWilayah->id_kecamatan == $matchPersonel->id_kecamatan )
                      <option value="@{{ $valWilayah->id_kecamatan }}" selected>Polsek @{{ $valWilayah->nama }}</option>
                      @else
                      <option value="@{{ $valWilayah->id_kecamatan }}">Polsek @{{ $valWilayah->nama }}</option>
                      @endif
                    @endforeach
                </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Satuan Kerja</label>
              <div class="col-sm-6">
                  <select name="slc-satuan-kerja" id="slc-satuan-kerja" class="select2" parsley-trigger="change" required>
                      @if( $matchPersonel->satuan_kerja == 'tanpa-satuan' )
                      <option value="tanpa-satuan" selected>Tanpa satuan</option>
                      @else
                      <option value="tanpa-satuan">Tanpa satuan</option>
                      @endif
                      @foreach ($satker as $valSatker)
                        @if( $valSatker->satuan_kerja == $matchPersonel->satuan_kerja )
                        <option value="@{{ $valSatker->satuan_kerja }}" selected>@{{ $valSatker->satuan_kerja }}</option>
                        @else
                        <option value="@{{ $valSatker->satuan_kerja }}">@{{ $valSatker->satuan_kerja }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Riwayat Pendidikan</label>
              <div class="col-sm-9">
                  <textarea name="txt-riwayat-pendidikan" id="txt-riwayat-pendidikan" placeholder="Riwayat Pendidikan" style="height:150px;" class="form-control">@{{ $matchPersonel->riwayat_pendidikan }}</textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Riwayat Kerja</label>
              <div class="col-sm-9">
                <textarea name="txt-riwayat-kerja" id="txt-riwayat-kerja" placeholder="Riwayat Kerja" style="height:150px;" class="form-control">@{{ $matchPersonel->riwayat_kerja }}</textarea>
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Status Personel</label>
              <div class="col-sm-3">
                <select name="slc-status-personel" id="slc-status-personel" class="form-control" parsley-trigger="change" required>
                  @if( $matchPersonel->status_personel == 'aktif' )
                  <option value="aktif" selected>Aktif</option>
                  <option value="non-aktif">Non Aktif</option>
                  <option value="mutasi">Mutasi</option>
                  @elseif( $matchPersonel->status_personel == 'non-aktif' )
                  <option value="aktif">Aktif</option>
                  <option value="non-aktif" selected>Non Aktif</option>
                  <option value="mutasi">Mutasi</option>
                  @elseif( $matchPersonel->status_personel == 'mutasi' )
                  <option value="aktif">Aktif</option>
                  <option value="non-aktif">Non Aktif</option>
                  <option value="mutasi" selected>Mutasi</option>
                  @endif
                </select>
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
                  <a href="@{{ URL::to('personel') }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
              </div>
          </div>
       </form>
    </div>
    @endif
  
@endsection