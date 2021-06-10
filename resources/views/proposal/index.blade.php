@extends('basetemplate.app')
@section('title','Data Proposal')
@section('container')

           @php
            $roles = json_decode(Auth::user()->role)
          @endphp
<div class="row">  
    <div class="col-md-12 ">
      <div class="card box_shadow">
        <div class="card-header">
          <h3 class="float-left ">Daftar Proposal</h3>
          @if ((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))              
          
          <div class="float-right">
            <a href="{{route('proposal.create')}}">
              <button type="button" class="btn bg-lightblue color-palette"><i class="fas fa-plus-square"></i> Tambah</button>
            </a>
          </div>              
          @endif
        </div>      
        <div class="card-body">          
          <div class="row mb-2">
            <div class="col-lg-8 col-md-12 col-sm-12">              
              <table width=100% class="table-responsive">
                <tr>
                  <td class="pt-3 pr-3">
                    <p>Tampilkan Berdasarkan Status</p>  
                  </td>
                  <td>:</td>
                  <td class="pl-3">                  
                      <select name="status" class="form-control">                  
                          <option hidden value="">-- Pilih status --</option>
                          <option value="APPROVED" {{isset($_GET['status']) ? $_GET['status'] == 'APPROVED' ? 'selected=selected' : '' : ''}} >Disetujui</option>
                          <option value="REJECTED" {{isset($_GET['status']) ? $_GET['status'] == 'REJECTED' ? 'selected=selected' : '' : ''}}>Ditolak</option>
                          <option value="PROSES" {{isset($_GET['status']) ? $_GET['status'] == 'PROSES' ? 'selected=selected' : '' : ''}}> Verifikasi</option>
                      </select>              
                  </td>
                  <td class="pl-3">
                    <a href="{{route('proposal')}}"><button class="btn btn-sm bg-teal color-palette"><i class="fa fa-sync-alt"></i> Refresh</button></a>
                  </td>
                </tr>
              </table>            
            </div>
          </div>
          <div class="table-responsive">
          
          <table id="datauser" class="table table-striped table-bordered table-responsive-md table-responsive-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>No. Ajuan</th>                
                <th>Kategori Ajuan</th>
                <th>Kategori Program</th>              
                <th>Nama Pengaju</th>
                <th>Status</th>                                                                                                    
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @php
                $no=0;
                @endphp
                @foreach ($data as $item)                
                <tr>
                    <td>{{++$no}}</td>
                    <td>{{$item->no_ajuan}}</td>                    
                    <td>{{$item->kategori_ajuan}}</td>
                    <td>{{$item->program}}</td>                
                    <td>{{$item->nama_pengaju}}</td>
                    <td>
                    @if($item->status == 'SAVED')
                        <span class="badge badge-primary">{{$item->status}}</span>
                    @elseif($item->status == 'CONFIRMING1')
                        <span class="badge badge-warning">{{$item->status}}</span>
                    @elseif($item->status == 'CONFIRMING2')
                        <span class="badge badge-info">{{$item->status}}</span>
                    @elseif($item->status == 'APPROVED')
                        <span class="badge badge-success">{{$item->status}}</span>
                    @elseif($item->status == 'REJECTED')
                        <span class="badge badge-danger">{{$item->status}}</span>
                    @endif
                    </td>                                                          
                    <td>
                     
                        @if ((in_array('AMIL',$roles) || (in_array('ADMIN',$roles))))              
                      <a href="{{ route('proposal.edit',$item->id) }}"><button type="button" class="btn bg-gradient-info btn-sm mr-1 my-1"><i class="fas fa-pencil-alt"></i> Edit  </button></a>                      
                      <a onclick="deleted(this)"  data-href="{{ route('proposal.destroy',$item->id) }}"><button type="button" class="btn btn-danger btn-sm my-1 mr-1"><i class="fas fa-trash"></i> Hapus</button></a>                      
                        @endif
                      @if ($item->status == "SAVED" && (in_array('AMIL',$roles)))                          
                      <a class="btn bg-gradient-success btn-sm my-1" href="{{ route('proposal.detail',$item->id) }}">
                       <i class="fa fa-share-square"></i> Ajukan Sekarang
                      </a>                                            
                      @else
                      <a class="btn bg-gradient-primary btn-sm  my-1" href="{{ route('proposal.detail',$item->id) }}">
                        <i class="fas fa-folder"></i> View
                      </a>
                      @endif
                      @if ($item->status == "CONFIRMING1" && (in_array('PENGURUS',$roles)) || $item->status == "CONFIRMING2" && (in_array('KETUA',$roles)))  
                      <a class="btn bg-gradient-success btn-sm my-1" href="{{ route('proposal.detail',$item->id) }}">
                        <i class="fa fa-share-square"></i> Verifikasi
                       </a>                                            
                      @else
                          
                      @endif
                    </td>
                </tr>
                @endforeach
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      </div>
      <!-- /.card -->
     
    </div>
  </div>  

@endsection
    
@section('script')
<script>
  $(document).on('change','select[name="status"]',function(){
    window.location.href = `/proposal?status=${$(this).val()}`;
  });
</script>

@endsection