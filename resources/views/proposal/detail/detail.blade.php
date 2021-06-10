@extends('basetemplate.app')
@section('title','Data Proposal')
@section('container')

  

    <div class="col-md-12 ">
      <div class="card">
        <div class="card-header py-auto">
          <h4 class="float-left"> <span class="text-bold">Detail</span> <span class="text-muted text-md"> Proposal No. Ajuan : {{$data["no_ajuan"]}}</span></h4>
          <div class="card-tools">
            
              <a href="{{route('proposal')}}" class="btn btn-info"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</a>
  
          </div>
        </div>
        
        
        <div class="card-body">
          <div class="card card-primary card-outline card-outline-tabs" >
            <div class="card-header p-0 border-bottom-0">
              <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link {{ strpos(url()->current(),'detail') != false ? 'active' : '' }}" href="{{route('proposal.detail',$data['proposal_id'])}}" >Data</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link {{ strpos(url()->current(),'pengajuandana') != false ? 'active' : '' }}"  href="{{route('pengajuan_dana',$data['proposal_id'])}}" >Pengajuan Dana</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link {{ strpos(url()->current(),'rincianAjuan') != false ? 'active' : '' }}"  href="{{route('rincian_pengajuan',$data['proposal_id'])}}">Rincian Dana Program</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link {{ strpos(url()->current(),'history') != false ? 'active' : '' }}"  href="{{route("history",$data['proposal_id'])}}" >History Pengajuan</a>
                  </li>
                </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                @yield('content')
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
     
    </div>
  </div>  



     <!-- Modal -->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Data Proposal </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        
          <div class="modal-body">            
          
          </div>
        </div>
      </div>
    </div>

@endsection
    
@section('script')
@endsection