<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
</head>
    <body class="d-flex align-items-center justify-content-center" style="height: 100vh;">
            <div class="error-page ">
                <h2 class="headline text-warning"> 404</h2>        
                <div class="error-content">
                    <h2><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Page not found.</h2>
                    <h5>Anda tidak memiliki cukup hak akses</h5>
                    <a href="{{route("home")}}">Kembali ke halaman Dashboard</a>                
                </div>            
            </div>            
    </body>
</html>
