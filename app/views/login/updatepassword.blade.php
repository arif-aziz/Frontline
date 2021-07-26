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
        <h3 class="text-center">Ubah Password</h3>
      </div>
      <div>
        <form action="@{{ URL::to('password/update') }}" method="post" style="margin-bottom: 0px !important;" class="form-horizontal">
          <div class="content">
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input name="txt-password-baru" type="password" placeholder="Password Baru" id="password" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-rotate-left"></i></span>
                    <input name="txt-password-baru-ulang" type="password" placeholder="Ulangi Password Baru" id="password" class="form-control">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input name="txt-password-lama" type="password" placeholder="Password Lama" id="password" class="form-control">
                  </div>
                </div>
              </div>
              
          </div>
          <div class="foot">
            <button class="btn btn-primary" data-dismiss="modal" type="submit">Ubah Password</button>
            <a href="@{{ URL::to('dashboard') }}" class="btn btn-default" data-dismiss="modal">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div> 
  
</div>

@endsection