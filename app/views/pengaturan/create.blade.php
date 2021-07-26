@extends('pengaturan.index')

@section('container_pengaturan')

<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

    @if ( $aktifitasUser['sistemSetting'] == 'available' )
    <div class="wizard-row">
      <div class="col-md-12 fuelux" style="padding:0px;">
        <div class="block-wizard">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li data-target="#step1" class="active">Tipe User<span class="chevron"></span></li>
              <li data-target="#step2">Aktifitas User<span class="chevron"></span></li>
              <li data-target="#step3">Term of Agreement<span class="chevron"></span></li>
            </ul>
            <div class="actions">
              <button type="button" class="btn btn-xs btn-prev btn-default"> <i class="icon-arrow-left"></i>Kembali</button>
              <button type="button" class="btn btn-xs btn-next btn-default" data-last="Selesai">Lanjut<i class="icon-arrow-right"></i></button>
            </div>
          </div>
          <div class="step-content">
            <form action="@{{ URL::to('pengaturan/create') }}" method="POST" id="form-user" class="form-horizontal group-border-dashed" style="border-radius: 0px;" role="form" parsley-validate novalidate enctype="multipart/form-data">
              <div class="step-pane active" id="step1">
                  <div class="form-group">
                      <div class="col-sm-12">
                        <h4 class="">Input Tipe User</h4>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label">Instansi</label>
                      <div class="col-sm-6">
                        <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-instansi" class="icheck" value="polres"> Polres</label> 
                        <label class="radio-inline"> <input type="radio" name="rad-instansi" class="icheck" value="polsek"> Polsek</label> 
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label">Jabatan</label>
                      <div class="col-sm-6">
                        <label class="radio-inline" style="padding-left:1px;"> <input type="radio" checked="" name="rad-jabatan" class="icheck" value="admin"> Admin</label> 
                        <label class="radio-inline"> <input type="radio" name="rad-jabatan" class="icheck" value="kabag"> Kabag</label> 
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-4 control-label">Nama Satker / Posisi</label>
                      <div class="col-sm-6">
                        <input name="txt-nama-satker" placeholder="ex: kapolres, ops, intel" type="text" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="col-sm-12">
                        <a href="@{{ URL::to('pengaturan') }}" class="btn btn-flat btn-default" style="padding:6px 11px;">Batal</a>
                        <button data-wizard="#wizard1" id="btn-input-operasi" class="btn btn-primary wizard-next">Proses Berikutnya <i class="fa fa-caret-right"></i></button>
                      </div>
                  </div>
              </div>
              <div class="step-pane" id="step2">
                  <div class="form-group">
                      <div class="col-sm-12">
                          <h4 class="">Input Aktifitas User</h4>
                      </div>
                  </div>
                  @foreach ( $aktifitas as $valAktifitas )
                    @if ( $valAktifitas->aktifitas != 'sistem-backup')
                      <div class="form-group">
                        <label class="col-sm-4 control-label">@{{ $valAktifitas->kelompok }}</label>
                        <div class="col-sm-8">
                          <label class="checkbox-inline"> <input type="checkbox" name="chk-aktifitas[]" value="@{{ $valAktifitas->id_aktifitas_user }}" class="icheck">  @{{ $valAktifitas->keterangan_aktifitas }}</label>
                        </div>
                      </div>
                    @endif
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
                      <p>Penentuan hak akses yang Anda lakukan akan berpengaruh terhadap user dengan tipe yang sama.</p>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <button data-wizard="#wizard1" class="btn btn-default wizard-previous"><i class="fa fa-caret-left"></i> Proses Sebelumnya</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data</button>
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