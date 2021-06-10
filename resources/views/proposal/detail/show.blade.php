@extends('proposal.detail.detail')
@section('content')

  <div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
      <div class="card mt-3">
        <div class="card-header">
          <h4 class="text-primary"><i class="fas fa-list-alt"></i> List Data Proposal</h4>
          
        </div>
      <table class="table table-striped table-resposive-sm">
    <div class="send" data-flash="{{session('error')}}"></div>
        <tr>
          <th>Kategori Ajuan</th>
          <td>{{$data["kategori_ajuan"]}}</td>
        </tr>
        <tr>
          <th>Kriteria Penerima</th>
          <td>{{$data["kriteria_penerima"]}}</td>
        </tr>
        <tr>
          <th>Kategori Program</th>
          <td>{{$data["program"]}}</td>
        </tr>
        <tr>
          <th>Keterangan Program</th>
          <td>{{$data["ket_program"]}}</td>
        </tr>
        <tr>
          <th>Nama Pengaju</th>
          <td>{{$data["nama_pengaju"]}}</td>
        </tr>
        <tr>
          <th>Alamat</th>
          <td>{{$data["alamat"]}}</td>
        </tr>
        <tr>
          <th>No. Kontak</th>
          <td>{{$data["no_kontak"]}}</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>{{$data["email"]}}</td>
        </tr>
        <tr>
          <th>Asnaf</th>
          <td>{{$data["asnaf"]}}</td>
        </tr>
        <tr>
          <th>Jenis Program</th>
          <td>{{$data["jenis_program"]}}</td>
        </tr>
        <tr>
          <th>Bentuk Penyaluran</th>
          <td>{{$data["bentuk_penyaluran"]}}</td>
        </tr>
        <tr>
          <th>Sosmed</th>
          <td>{{$data["sosmed"]}}</td>
        </tr>
        <tr>
          <th>Berkas </th>
          <td>
            <span><a target="blank" href="{{ asset('file_pendukung/'.$data['file_pendukung']) }}">Lihat Berkas </a></span>                
          </td>
        </tr>
        <tr>
          <th>Status </th>
          <td>@if($data->status == 'SAVED')
            <span class="badge badge-primary">{{$data->status}}</span>
        @elseif($data->status == 'CONFIRMING1')
            <span class="badge badge-warning">{{$data->status}}</span>
        @elseif($data->status == 'CONFIRMING2')
            <span class="badge badge-info">{{$data->status}}</span>
        @elseif($data->status == 'APPROVED')
            <span class="badge badge-success">{{$data->status}}</span>
        @elseif($data->status == 'REJECTED')
            <span class="badge badge-danger">{{$data->status}}</span>
        @endif</td>
        </tr>
        <?php
        $createddate = $data['created_at']->isoFormat(' dddd, D MMMM Y');
        $updateddate = $data['updated_at']->isoFormat(' dddd, D MMMM Y');                    
        $createdtime = $data['created_at']->isoFormat(' h:mm a');
        $updatedtime = $data['updated_at']->isoFormat(' h:mm a');                    
        ?>     
        <tr>
          <th>Dibuat pada </th>
          <td>{{$createddate}},{{$createdtime}}</td>
        </tr>
        <tr>
          <th>Terakhir diubah </th>
          <td>{{$updateddate}},{{$updatedtime}}</td>
        </tr>
      </table>
    </div>
  </div>
    @php
        $roles = json_decode(Auth::user()->role)
    @endphp
    
    @if ($data->status == "APPROVED")
    <div class="col-md-6 mt-3">                
          <div class="callout callout-success">   
            <p class="text-muted"> <i class="icon fas fa-check text-success"></i>  Proposal Telah Tervalidasi, silahkan klik Button di bawah untuk melihat Hasil Rincian Pengajuan</p>
            <a href="{{route('proposal.report',$data['proposal_id'])}}" target="_blank" class="btn btn-sm bg-gradient-danger text-white" style="text-decoration: none">Generate PDF <i class="fa fa-file-pdf"></i></a>
          </div>
        </div>
        @endif
    
    @if ((in_array('AMIL',$roles) && $data['status'] == 'SAVED') || (in_array('PENGURUS',$roles) && $data['status'] == 'CONFIRMING1') || (in_array('KETUA',$roles) && $data['status'] == 'CONFIRMING2') || (in_array('AMIL',$roles) && $data['status'] == 'REJECTED'))
    <div class="col-lg-6 col-md-12 col-sm-12 mt-3">
      @if ($data['status'] == 'REJECTED')                      
      <div class="row my-1">
        <div class="col-md-12">
          <div class="callout callout-warning">
            <h5 style="display: inline-block;color:rgb(255, 145, 0);"><i class="fas fa-exclamation-triangle"></i></h5>
            <p style="display: inline-block;color: rgb(68, 68, 71)">Silahkan perbaiki terlebih dahulu <b>berkas</b> atau <b>persyaratan</b> yang <b>tidak valid</b> <b>!</b> </p>
          </div>          
        </div>
      </div>
      @endif
      
      
        <div class="card">
          <div class="card-header">            
                <h4 class="text-primary"><i class="fas fa-reply-all"></i> Form Usulan</h4>              
            </div>      
        <div class="card-body" style="display: block;">
          <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{ route('proposal.changeStatus',$data['proposal_id']) }}">
            @csrf
          <div class="row">          
            <div class="col-md-12 col-lg-12 order-1 order-md-2">
              <small class="text-muted">* Sebelum mengirimkan Pengajuan, pastikan telah mengisi semua data Pengajuan Dana dan Rincian Dana Program </small>
              <div class="form-group">                
                <label>Catatan Tambahan : </label>      
                <div class="input-group">
                  <div class="input-group-prepend">
                    {{-- <span class="input-group-text"><i class="far fa-address-card"></i></span> --}}
                  </div>
                  <textarea class="form-control" value="{{ old('ket') }}" name="ket" id="exampleFormControlTextarea1" rows="3"></textarea>  
                </div>              
              </div>
              @error('name')
              <div class="alert alert-danger mt-2">
                  {{ $message }}
              </div>
              @enderror        
              <br>
              @if ($data['status'] == 'CONFIRMING1' || $data['status'] == 'CONFIRMING2' )
                <div class="form-group">
                  <label>Status</label>
                  <select name="status" class="form-control">
                    <option value="DISETUJUI">Disetujui</option>
                    @if ((in_array('KETUA',$roles)))                        
                        <option value="DITOLAK">Ditolak</option>
                    @else    
                        <option value="DITOLAK">Dipertimbangkan</option>
                    @endif
                  </select>
                </div>
              @endif
              <div class="text-muted">
                <p class="text-sm">Kategori Pengajuan
                  <b class="d-block">{{$data["kategori_ajuan"]}}</b>
                </p>
                <p class="text-sm">Penanggung Jawab
                  <b class="d-block">{{$data["nama_pengaju"]}}</b>
                </p>
              </div>

              <h5 class="mt-5 text-muted">File Pengajuan</h5>
              <ul class="list-unstyled">
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> {{$data["sosmed"]}}</a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i><span ><a class="text-muted" target="blank" href="{{ asset('file_pendukung/'.$data['file_pendukung']) }}"> File Persyaratan Pengajuan</a></span>                
                </a>
                </li>
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i> {{$data["email"]}}</a>
                </li>                
                <li>
                  <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i> {{$data["no_kontak"]}}</a>
                </li>
              </ul>
            </div>
          </div>
          </div>
         
          <div class=" card-footer text-center ">                   
            @if ($data['status'] == 'REJECTED')
            <button type="submit" class="btn btn-sm bg-gradient-primary">
              Kirim ulang pengajuan  <i class="fas fa-paper-plane ml-1"></i>
            </a>                  
            @else
            <button type="submit" class="btn btn-sm bg-gradient-primary">
              Kirim Sekarang  <i class="fas fa-paper-plane ml-1"></i> 
            </a>
            @endif              
          </div>
          <form>
        </div>
      </div>  
    @endif
    @php
    $roles = json_decode(Auth::user()->role)
    @endphp
  </div>


  

  
  
@endsection
    

@section('script')
  <script>
  $("#datauser").DataTable();
  var flash = $('.send').data('flash');  
  if(flash != ""){
    Swal.fire({
      icon: 'error',
      title: 'Tidak Dapat Mengirim ',
      text: flash      
    });
  }
</script>  
    
@endsection
