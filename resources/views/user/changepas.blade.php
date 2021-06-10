@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')
<div class="row">
  <div class="col-md-12 text-muted">
      <h5>Setting/UbahPassword</h5>
  </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
        <a  href="{{route('user.setting')}}">
            <button type="button" class="btn float-right bg-lightblue color-palette d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
          </a>
    </div>
</div>
<div class="row mt-2">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
<div class="card card-lightblue box_shadow">
    <div class="card-header">
      <h3 class="card-title">Update Password Profile</h3>
    </div>

    <form action="{{route("user.password.update")}}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="old_password">Password </label>
          <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Masukan Password Lama">
        </div>
        @error('old_password')
        <div class="alert alert-danger text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
          <label for="exampleInputPassword1">Password </label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Masukan Password Baru">
        </div>
        @error('password')
        <div class="alert alert-danger text-sm mt-2">
            {{ $message }}
        </div>
        @enderror
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password </label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password ">
        </div>        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn bg-lightblue color-palette">Submit</button>
      </div>
    </form>
  </div>
</div>
</div>

@endsection