<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<div id="cl-wrapper" class="fixed-menu">
    <div class="cl-sidebar" data-position="right" data-step="1" data-intro="<strong>Fixed Sidebar</strong> <br/> It adjust to your needs." >
      <div class="cl-toggle"><i class="fa fa-bars"></i></div>
      <div class="cl-navblock">
        <div class="menu-space">
          <div class="content">
            <ul class="cl-vnavigation">
              <li style="border-top: 1px solid #2f323a;font-size:11px;padding: 13px 21px 10px 21px;color: #507b9b!important;"><span>Navigasi</span></li>
              <li><a href="@{{ URL::to('dashboard') }}"><i class="fa fa-dashboard"></i><span style="">Beranda</span></a></li>

              <li style="border-top: 1px solid #2f323a;font-size:11px;padding: 13px 21px 10px 21px;color: #507b9b!important;"><span>Data</span></li>
              @if ( $aktifitasUser['viewUser'] == 'available' )
              <li><a href="@{{ URL::to('user') }}"><i class="fa fa-user"></i><span>User</span></a></li>
              @endif
              
              @if ( $aktifitasUser['viewPersonel'] == 'available' )
              <li><a href="@{{ URL::to('personel') }}"><i class="fa fa-users"></i><span>Personel</span></a></li>
              @endif

              @if ( $aktifitasUser['viewOperasi'] == 'available' )
              <li><a href="@{{ URL::to('operasi') }}"><i class="fa fa-briefcase"></i><span>Operasi</span></a></li>
              @endif

              <li style="border-top: 1px solid #2f323a;font-size:11px;padding: 13px 21px 10px 21px;color: #507b9b!important;"><span>Personalitas</span></li>
              @if ( $aktifitasUser['sistemSetting'] == 'available' && $aktifitasUser['sistemBackup'] == 'available' )
              <li><a href="@{{ URL::to('pengaturan') }}"><i class="fa fa-cogs"></i><span>Pengaturan</span></a></li>
              @endif
              
              <li><a href="@{{ URL::to('password/update') }}"><i class="fa fa-undo"></i><span>Ubah Password</span></a></li>
              <li><a href="@{{ URL::to('logout') }}"><i class="fa fa-lock"></i><span>Logout</span></a></li>

            </ul>
          </div>
        </div>
        <div class="collapse-button">
          <div class="text-center" style="font-size:11px; padding: 10px; color: #fff !important;"><span>@{{ date('l, d F Y') }}</span></div>
        </div>
      </div>
    </div>