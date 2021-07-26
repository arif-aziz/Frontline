@extends('layout.master_login')

@section('container_login')

<div id="cl-wrapper" class="login-container">

  <div class="middle-login">
    @if (Session::has('flash_error'))
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-times-circle sign"></i><strong>Gagal!</strong> @{{ Session::get('flash_error') }}
      </div>
    @endif

    <div class="block-flat">
      <div class="header">              
        <h3 class="text-center"><img class="logo-img" src="/images/logo.png" alt="logo"/>Frontline</h3>
      </div>
      <div>
        <form action="@{{ URL::to('login/post') }}" method="post" style="margin-bottom: 0px !important;" class="form-horizontal">
          <div class="content">
            <small>Sebelum login pastikan Anda telah memiliki akun yang terdaftar dalam sistem. Jika belum memiliki akun, hubungi Administrator.</small>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input name="txt-username" type="text" placeholder="Username / Email" id="username" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input name="txt-password" type="password" placeholder="Password" id="password" class="form-control">
                  </div>
                </div>
              </div>
              
          </div>
          <div class="foot">
            <button class="btn btn-primary" data-dismiss="modal" type="submit">Login</button>
          </div>
        </form>
      </div>
    </div>
  </div> 
  
</div>

@endsection