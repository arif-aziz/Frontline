@extends('layout.master')

@section('container')

<?php
$tempSiap = 0;
?>

<?php
    $getAksesUser = Request::create('akses', 'GET');
    $aksesUser    = Route::dispatch($getAksesUser)->getOriginalContent();
?>

    <div class="container-fluid" id="pcont" style="background:#F5F5F5">
      <div class="cl-mcont" style="background:#F5F5F5">
        <div class="stats_bar">
          <div class="butpro butstyle flat">
            <div class="sub"><h2>DATA USER</h2><span>@{{ $jmlUser }}</span></div>
          </div>  
          <div class="butpro butstyle flat">
            <div class="sub"><h2>DATA PERSONEL</h2><span>@{{ $jmlPersonel }}</span></div>
          </div>
          <div class="butpro butstyle flat">
            <div class="sub"><h2>DATA OPERASI</h2><span>@{{ $jmlOperasi }}</span></div>
          </div>
        </div>
        <div class="row dash-cols">
          <div class="col-sm-6 col-md-6">
            <div class="block-flat pie-widget">
              <div class="content no-padding">
                <h4 class="no-margin">Daftar Kekuatan Personel : @{{ date('d F Y') }}</h4>
                <div class="row">
                  <div class="col-sm-12">
                    <table class="no-borders no-strip padding-sm">
                      <tbody class="no-border-x no-border-y">
                        @if (count($personelSiap) > 0)
                        @foreach ($personelSiap as $valPersonelSiap)
                        <tr>
                          <td style="width:15px;"><div class="legend" data-color="#649BF4"></div></td>
                          <td>@{{ $valPersonelSiap->instansi }} @{{ $valPersonelSiap->nama }}</td>
                          <td class="text-right"><b>@{{ $valPersonelSiap->jumlahPersonelSiap }} orang</b></td>
                        </tr>
                        <?php $tempSiap += $valPersonelSiap->jumlahPersonelSiap; ?>
                        @endforeach
                        @else
                        Belum ada absensi di semua unit
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row stats">
                  <div class="col-sm-6"><div class="spk4 pull-right"></div><p>Personel Aktif</p><h5>@{{ count($personelAktif) }}</h5></div>
                  <div class="col-sm-6"><div class="spk5 pull-right"></div><p>Personel Siap</p><h5>@{{ $tempSiap }}</h5></div>
                </div>
              </div>
            </div>          
          </div>
          
          <div class="col-sm-6 col-md-6">
            <div class="block-flat pie-widget">
              <div class="content no-padding">
                <h4 class="no-margin">Pengingat Masa Operasi : @{{ date('d F Y') }}</h4>
                <div class="row">
                  <div class="col-sm-12">
                    <table class="no-borders no-strip padding-sm">
                      <tbody class="no-border-x no-border-y">
                        @if (count($reminderOps) > 0)
                        @foreach ($reminderOps as $valReminderOps)
                        <tr>
                          <td style="width:15px;"><div class="legend" data-color="#649BF4"></div></td>
                          <td><a href="@{{ URL::to('operasi/status', $valReminderOps->id_operasi) }}">@{{ $valReminderOps->nama_op }}</a></td>
                          <td class="text-right"><b>selesai hari ini</b></td>
                        </tr>
                        @endforeach
                        @else
                        Tidak ada operasi yang jatuh tempo
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="row stats">
                  <div class="col-sm-3">
                    <span>Keterangan</span>
                  </div>
                  <div class="col-sm-9">
                    <span style="font-size:11px;">Jika lebih dari 1 hari status operasi tidak diubah, maka otomatis sistem akan mengubah statusnya menjadi <span class="color-danger">selesai</span>.</span>
                  </div>
                </div>
              </div>
            </div>          
          </div>
        </div>
        <div class="row dash-cols">
          <div class="col-sm-12 col-md-12">
            <div class="block-flat pie-widget">
              <div class="content no-padding">
                <div class="row">
                  <div class="col-sm-8">
                    <h4 style="margin-top:0px;">SELAYANG PANDANG</h4>
                    <p>
                      Frontline <strong>versi 1.1</strong> adalah aplikasi berbasis web yang berfungsi untuk manajemen kegiatan operasional unit kerja terpadu di lingkungan Polres Jombang.
                      Dengan adanya aplikasi ini maka pimpinan dapat mengetahui informasi terkini terkait dengan rencana kegiatan operasional lapangan. Selain itu
                      rencana aktifitas operasional dapat dimonitoring secara keseluruhan termasuk anggota pelaksana, waktu pelaksanaan, serta besarnya dana anggaran untuk kegiatan.
                    </p>
                  </div>
                  <div class="col-sm-4">
                    <h4 style="margin-top:0px;">TIM DEVELOPER</h4>
                    <p>
                      <ol>
                        <li>Project Manager : Jaka Aldila, S.ST</li>
                        <li>Network : Dharu Mahendra, S.ST</li>
                        <li>Programmer : Arif Rahman Aziz</li>
                      </ol>
                    </p>
                  </div>
                </div>
              </div>
            </div>          
          </div>
        </div>
      </div>
    </div> 

@endsection