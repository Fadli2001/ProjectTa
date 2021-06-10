<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proposal Approving</title>

  <link rel="shortcut icon" type="image/jpg" href="{{asset('template')}}/dist/img/proposalogo2.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;1,300&display=swap" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/adminlte.min.css">
  {{-- aos --}}
  <link rel="stylesheet" href="{{asset('template')}}/dist/css/aos.css">

  {{-- checkbox custom  --}}
  <link rel="stylesheet" href="{{asset('template')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  {{-- sweetalert2 --}}
  <link rel="stylesheet" href="{{asset('template')}}/dist/sweetalert/sweetalert2.min.css">

  {{-- dropzonejs --}}
  <link rel="stylesheet" href="{{asset('template')}}/plugins/dropzone/min/dropzone.min.css">

    <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('template')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  

  <style>
    .dashboard_box{
       box-shadow: 0px 4px 15px rgb(0, 0, 0, 0.5);
       transition: 0.3s;
    }
    .dashboard_box:hover{
      transform: scale(1.03);
      box-shadow: 0px 4px 15px rgb(0, 0, 0, 0.1);
    }
    .box_shadow{
      box-shadow: 0px 4px 15px rgb(0, 0, 0, 0.2);
    }
    /* style="border-radius: 50%;object-fit: cover; border: 3px solid #3c8dbc ; padding: 3px" */
    .image_profile{
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #3c8dbc;
      padding: 3px;
    }

    *{
      font-family: 'Source Sans Pro', sans-serif;!important
    }

  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light" style="background-color:rgb(42, 96, 120) ">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars text-white"></i></a>
      </li>     
    </ul>
    <ul class="navbar-nav ml-auto">      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" >
          <i class="far fa-bell text-white"></i>
          @php
              $notif = \App\Models\Proposal::notif();
          @endphp
          @if (count($notif) >= 1)              
          <span class="badge badge-warning navbar-badge">
          {{count($notif)}}
          </span>                        
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">     
          @foreach ($notif as $item)
            <a href="{{route("proposal.read",$item->id)}}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> {{$item->no_ajuan}} 
              <span class="float-right text-muted text-sm">{{$item->status}}</span>
            </a>
          @endforeach        
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-cog text-white"></i>          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">            
        </div>
          <div class="dropdown-divider"></div>
          <a href="{{route("user.setting")}}" class="dropdown-item">
            <i class="fas fa-cogs mr-2"></i> Setting Profile           
          </a>
          <div class="dropdown-divider"></div>
          <button type="button" class="btn btn-danger dropdown-item" data-toggle="modal" data-target="#logout">          
            <i class="fas fa-sign-out-alt mr-2"></i>  
            {{ __('Logout') }} 
          </button>        
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt text-white"></i>
        </a>
      </li>
      </ul>
        </nav>
        <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog ">
            <div class="modal-content bg-info">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Logout </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Apakah Anda ingin keluar dari Aplikasi ?
              </div>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                @csrf                  
              <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-outline-light float-right" >Ya</button>
              </div>
                </form>
            </div>
          </div>
        </div>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:rgb(0, 28, 31)" >
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('template')}}/dist/img/proposalogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" >
      <span class="brand-text font-weight-light">Proposal Approving </span>
    </a>
 
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="brand-link">
        {{-- <div class="image"> --}}
          <a href="{{route("user.setting")}}">
            <img src="{{asset('image/'.Auth::user()->foto)}}" class="" style="border-radius: 50%;object-fit: cover;" width="37" height="37" alt="User Image">
          </a>
        {{-- </div> --}}
        <span class="brand-text" style="display: inline-block;">
          <a href="{{route("user.setting")}}" class="text-md ml-2">{{Auth::user()->name}}</a>
        </span>
        
      </div>

      <!-- SidebarSearch Form -->
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{route("dashboard")}}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>

                  <p>
                    Dashboard                    
                  </p>
                </a>
              </li>         
              <li class="nav-item">
                <a href="{{route('proposal')}}" class="nav-link">
                  <i class="nav-icon fas fa-paste"></i>

                  <p>
                    Proposal                    
                  </p>
                </a>
              </li>                 
            @php
            $roles = json_decode(Auth::user()->role)
            @endphp
           @if ((in_array('ADMIN',$roles)))

            <li class="nav-item">
              <a href="{{url('user')}}" class="nav-link">
                <i class="fa fa-users nav-icon"></i>
                <p>Manage Users</p>
              </a>
            </li>
              <li class="nav-item">
                <a href="{{route('kategori_program')}}" class="nav-link">
                  <i class="far fa-clone nav-icon"></i>
                  <p>Kategori Program</p>
                </a>
              </li>      
              <li class="nav-item">
                <a href="{{route('asnaf')}}" class="nav-link">
                  <i class="far fa-user nav-icon"></i>
                  <p>Asnaf Pemerima Manfaat</p>
                </a>
              </li>
             
          @endif                                     
         
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>
  <div class="content-wrapper">
    <div class="flash" data-flash="{{session('status')}}"></div>
    <div class="content-header">
      <div class="container-fluid">
        @yield('container')
      </div>
    </div>
  </div>
  <footer class="main-footer text-center">
    <strong>Copyright &copy;Proposal Approved YBM JBT.</strong> 2021 All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="{{asset('template')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('template')}}/dist/js/adminlte.min.js"></script>

{{-- aos.js --}}
<script src="{{asset('template')}}/dist/js/aos.js"></script>

{{-- dropzonejs --}}
<script src="{{asset('template')}}/plugins/dropzone/min/dropzone.min.js"></script>
 
{{-- chartjs --}}
<script src="{{asset('template')}}/plugins/chart.js/Chart.min.js"></script>

{{-- Donut Chart --}}
<script src="{{asset('template')}}/plugins/flot/plugins/jquery.flot.pie.js"></script>

<script src="{{asset('template')}}/dist/js/demo.js"></script>

{{-- data table  --}}
<script src="{{asset('template')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('template')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

{{-- sweetalert2 --}} 
<script src="{{asset('template')}}/dist/sweetalert/sweetalert2.min.js"></script>
<script>
$("#datauser").DataTable();
    var flash = $('.flash').data('flash');      
      if(flash != ""){
        Swal.fire({
          icon: 'succes',
          title: 'Succes',
          text: flash       
        });
      }    
    function deleted(e) {      
    Swal.fire({
      title: 'Anda yakin Ingin Menghapus Data?',
      text: "Data tidak dapat dikembalikan!",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor:'#149837',
      cancelButtonColor:'#981414'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = $(e).data('href')
      }
    }) 
  }
 
</script> 


@yield('script')
<script>
  AOS.init();
</script>

</body>
</html>
