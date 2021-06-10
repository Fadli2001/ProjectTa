@extends('proposal.detail.detail')
@section('content')
    @php
        $roles = json_decode(Auth::user()->role)
    @endphp
{{-- @if ((in_array('AMIL',$roles) && $data['status'] == 'SAVED') || (in_array('PENGURUS',$roles) && $data['status'] == 'CONFIRMING1') || (in_array('KETUA',$roles) && $data['status'] == 'CONFIRMING2')) --}}
<div class="col-md-5">
  <p class="text-muted">
  @if ( $data->status == 'CONFIRMING1' || $data->status == 'CONFIRMING2')                                                           
  <i class="fas fa-clock text-warning"></i> Proposal Sedang dalam Konfirmasi              
  @elseif($data->status == 'SAVED')
  <i class="fas fa-clock bg-gray"></i> Belum ada Pengiriman Proposal            
  @elseif($data->status == 'APPROVED')
  <i class="fas fa-clipboard-check  text-success"></i> Pengajuan Proposal telah disetujui  
  @elseif($data->status == 'REJECTED')
  <i class="fas fa-calendar-times  text-danger"></i> Pengajuan Proposal Ditolak                    
  @endif
  </p>
</div>      
<section class="content mt-2">
    <div class="container-fluid">
        <div class="row my-3">
      <div class="row">
        <div class="col-md-12">
          @foreach ($show as $item)
          <?php
          $createddate = $item->created_at->isoFormat(' dddd, D MMMM Y');
          $createdtime = $item->created_at->isoFormat(' h:mm a ');                    
          ?>               
          <div class="timeline">            
            <div class="time-label">
              <span class="bg-green">{{$createddate}}</span>
            </div>            
            <div>
              <i class="fas fa-envelope bg-blue"></i>
              <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i>{{$createdtime}}</span>
                <h3 class="timeline-header"><a href="#">{{$item->name}} </a>{{$item->title}}</h3>                
                <div class="timeline-body">
                  {{$item->keterangan}}
                </div>                
              </div>
            </div>            
            @endforeach           
          </div>
          <div>
          </div>
        </div>        
      </div>
    </div>    
  </section>
  
  
@endsection
    
