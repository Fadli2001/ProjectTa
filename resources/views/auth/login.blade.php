<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proposal Approving</title>
  <link rel="shortcut icon" type="image/jpg" href="{{asset('template')}}/dist/img/proposalogo2.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,400;1,500&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
  <style>
    .tittlee{
      font-family: 'Fjalla one', sans-serif;

    }

    .tittle{
       font-family: 'Montserrat', sans-serif;        
    }

  </style>
</head>
<body class="hold-transition login-page">
  
  <div class="row ">
    <div class="col-md-12 col-sm-12 justify-content-center align-items-center">      
      <img src="{{asset('template')}}/dist/img/proposalogo2.png" alt="AdminLTE Logo" height="142vh">
    </div>
  </div>
  <h2 class="text-center tittlee mt-1" style="color: rgb(0, 157, 184)"><b> <span style="color: rgb(42, 96, 120)"> PROPOSAL</span> APPROVING</b></h2>
<div class="login-box mt-3">
  <div class="card card-outline card-info" style="color:#2a6078; " >
    <div class="text-center mt-3">
      <img src="{{asset('template')}}/dist/img/logo_ybm.png" alt="AdminLTE Logo" height="60vh"> <br>
    </div>
    <div class="card-header text-center tittle">
      <span class="tittle" style="margin-top: 5px" >Pengajuan Proposal YBM PLN Unit Induk Jawa Bagian Tengah</span>
    </div>
    
    <div class="card-body">      
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror          
        </div>
        <div class="input-group mb-3">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror         
        </div>
        <div class="row">
          <div class="col-12">
            <div class="icheck-primary float-left">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    

            </div>                
            <button type="submit" class="btn bg-gradient-info float-right">
                {{ __('Login') }}
            </button>
          
        </div>          
        </div>
        <p class="mb-1">
            {{-- @if (Route::has('password.request'))
            <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Lupa Password?') }}
            </a>
            @endif --}}
          </p>
      </form>
    </div>    
  </div>  


</div>

<!-- jQuery -->
<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>
</body>
</html>
