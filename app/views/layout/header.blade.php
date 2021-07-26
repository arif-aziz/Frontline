<?php
    $getAktifitasUser = Request::create('aktifitas', 'GET');
    $aktifitasUser    = Route::dispatch($getAktifitasUser)->getOriginalContent();
?>

<?php
    $getJmlRequest = Request::create('jumlahrequest', 'GET');
    $jmlRequest    = Route::dispatch($getJmlRequest)->getOriginalContent();
?>

<!-- Fixed navbar -->
<div id="head-nav" class="navbar navbar-default navbar-fixed-top" style="padding-left:0px">
  <div class="container-fluid" style="padding-left:0px">
    <div class="navbar-header" style="background:#272930;padding-left:25px">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="fa fa-gear"></span>
      </button>
      <a class="navbar-brand" href="#" style="line-height:normal;">
        <span>Frontline</span>
      </a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav" style="padding-left:10px;">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pelaksanaan Operasi <b class="caret"></b></a>
            <ul class="dropdown-menu col-menu-2">
                <li class="col-sm-6 no-padding">
                    <ul>
                    @if ( $aktifitasUser['viewAbsen'] == 'available' )
                    <li><a href="@{{ URL::to('absen') }}">Absen Harian</a></li>
                    @endif

                    @if ( $aktifitasUser['inputOperasi'] == 'available' )
                    <li><a href="@{{ URL::to('operasi/create') }}">Operasi Baru</a></li>
                    @endif

                    @if ( $aktifitasUser['inputRequest'] == 'available' )
                    <li>
                      <a href="@{{ URL::to('request') }}">Request Personel 
                        @if( count($jmlRequest) != 0)
                        &nbsp; <label class="label label-danger">@{{ count($jmlRequest) }}</label>
                        @endif
                      </a>
                    </li>
                    @endif

                    @if ( $aktifitasUser['viewAbsenOperasi'] == 'available' )
                    <li><a href="@{{ URL::to('absenoperasi') }}">Absen Khusus Operasi</a></li>
                    @endif
                    </ul>
                </li>
                <li class="col-sm-6 no-padding text-center" style="padding:10px 10px 0px 10px !important;">
                    <span class="fa fa-briefcase" style="color:#C7C7C7; font-size:50px;"></span> 
                    <label style="font-size: 11px; color:#C7C7C7;">Tahap Pelaksanaan Operasi Khusus &amp; Harian</label>
                </li>
            </ul>
        </li>

        <li><a href="@{{ URL::to('kalender') }}">Kalender Kamtibmas</a></li>

        @if ( $aktifitasUser['viewAbsen'] == 'available' )
        <li><a href="@{{ URL::to('absen/rekap') }}">Rekap Absen</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav navbar-right user-nav">
        <li class="profile_menu">
          @if ( Auth::user()->foto_user == NULL || Auth::user()->foto_user == fotodefault.jpg )
          <a class="dropdown-toggle"><img alt="Avatar" src="/images/fotodefault.jpg" width="29px" height="30px" /><span> @{{ Auth::user()->username }} </span></a>
          @else
          <a class="dropdown-toggle"><img alt="Avatar" src="/images/user/@{{ Auth::user()->foto_user }}" width="29px" height="30px" /><span> @{{ Auth::user()->username }} </span></a>
          @endif
        </li>
      </ul>

    </div>
  </div>
</div>