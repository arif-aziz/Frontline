@extends('operasi.index')

@section('container_operasi')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php 
$idx = 1;
?>

  @if ( $aktifitasUser['inputOperasi'] == 'available' )
  <div class="block-flat ms-no-border ms-no-shadow">
      <div class="content">
        <div class="header">
          <h4 style="margin:-15px 0px 10px 0px;"><strong>Ubah Telegram @{{ $matchOperasi->nama_op }}</strong></h4>
        </div>
        <div class="header">
          <h6>Tanggal : @{{ $matchOperasi->tanggal_mulai }} s/d @{{ $matchOperasi->tanggal_selesai }}</h6>
          <h6>Jam Kerja : @{{ $matchOperasi->jam_mulai }} s/d @{{ $matchOperasi->jam_selesai }}</h6>
        </div>
        <div class="content">
           <form action="@{{ URL::to('operasi/telegram/update', $matchOperasi->id_operasi) }}" method="POST" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
              <div class="form-group">
                  <label class="col-sm-3 control-label">Dari</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-dari" value="@{{ $telegram->tgram_dari }}" placeholder="Jabatan Pengirim" parsley-trigger="change" type="text" required class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Nama Pengirim</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-nama" value="@{{ $telegram->tgram_nama }}" placeholder="Nama Pengirim" parsley-trigger="change" type="text" required class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">NRP</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-nrp" value="@{{ $telegram->tgram_nrp }}" placeholder="NRP Pengirim" parsley-type="number" type="text" required class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Pangkat</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-pangkat" value="@{{ $telegram->tgram_pangkat }}" placeholder="Pangkat Pengirim" type="text" class="form-control">
                  </div>
              </div>
                <div class="form-group">
                            <label class="col-sm-3 control-label">Kepada</label>
                            <div class="col-sm-8">
                                <textarea name="txt-tgram-kepada" id="txt-tgram-kepada" placeholder="Nama Penerima" parsley-trigger="change" required style="height:150px;" class="form-control"> @{{ $telegram->tgram_kepada }}</textarea>
                            </div>
                        </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Tembusan</label>
                            <div class="col-sm-8">
                                <textarea name="txt-tgram-tembusan" id="txt-tgram-tembusan" placeholder="Nama Tembusan" parsley-trigger="change" required style="height:150px;" class="form-control"> @{{ $telegram->tgram_tembusan }}</textarea>
                            </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Derajat</label>
                  <div class="col-sm-3">
                    <input name="txt-tgram-derajat" value="@{{ $telegram->tgram_derajat }}" placeholder="Derajat" parsley-trigger="change" type="text" required class="form-control">
                  </div>
                  <label class="col-sm-2 control-label">Klasifikasi</label>
                  <div class="col-sm-3">
                    <input name="txt-tgram-klasifikasi" value="@{{ $telegram->tgram_klasifikasi }}" placeholder="Klasifikasi" parsley-trigger="change" type="text" required class="form-control">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Nomor Telegram</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-nomor" value="@{{ $telegram->tgram_nomor }}" placeholder="Nomor Telegram" type="text" required class="form-control"/>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Tanggal</label>
                  <div class="col-sm-8">
                    <input name="txt-tgram-tanggal" value="@{{ $telegram->tgram_tanggal }}" placeholder="Tanggal Telegram" type="text" required class="form-control date datetime" data-min-view="2" data-date-format="yyyy-mm-dd" size="16">
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Isi AAA</label>
                  <div class="col-sm-8">
                      <textarea name="txt-tgram-isiA" id="txt-tgram-isiA" placeholder="Isi Kolom AAA" style="height:150px;" class="form-control"> @{{ $telegram->tgram_isia }}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Isi BBB</label>
                  <div class="col-sm-8">
                      <textarea name="txt-tgram-isiB" id="txt-tgram-isiB" placeholder="Isi Kolom BBB" style="height:150px;" class="form-control">@{{ $telegram->tgram_isib }}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Isi CCC</label>
                  <div class="col-sm-8">
                      <textarea name="txt-tgram-isiC" id="txt-tgram-isiC" placeholder="Isi Kolom CCC" style="height:150px;" class="form-control">@{{ $telegram->tgram_isic }}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Isi DDD</label>
                  <div class="col-sm-8">
                      <textarea name="txt-tgram-isiD" id="txt-tgram-isiD" placeholder="Isi Kolom DDD" style="height:150px;" class="form-control">@{{ $telegram->tgram_isid }}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label">Isi EEE</label>
                  <div class="col-sm-8">
                      <textarea name="txt-tgram-isiE" id="txt-tgram-isiE" placeholder="Isi Kolom EEE" style="height:150px;" class="form-control">@{{ $telegram->tgram_isie }}</textarea>
                  </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
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
                  <div class="col-sm-6">
                      <button type="submit" class="col-sm-7 btn btn-primary btn-flat">Simpan Perubahan</button>
                      <a href="@{{ URL::to('operasi/dokumen', $matchOperasi->id_operasi) }}" class="col-sm-4 btn btn-default btn-flat">Batal</a>
                  </div>
              </div>
           </form>
        </div>
      </div>
  </div>
  @endif
  
@endsection