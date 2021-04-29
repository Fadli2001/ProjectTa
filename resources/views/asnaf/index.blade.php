@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')

<div class="row">  
    <div class="col-md-6 ">
      <div class="card">
        <div class="card-header">
          <div class="float-right">             
              <a href="{{route('asnaf.create')}}">
                <button type="button" class="btn bg-gradient-info"> <i class="fa fa-plus"></i> Tambah Kategori</button>
              </a>            
          </div>   
          <h3 class="float-left">Kategori Asnaf</h3>                         
        </div>      
        <div class="card-body">
          <table id="datauser" class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Asnaf</th>
                <th>Created_at</th>
                <th>Updated_at</th>
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
                    <td class="pt-3" >{{$item->asnaf}}</td>         
                    <td class="pt-3" >{{$item->created_at}}</td>                    
                    <td class="pt-3" >{{$item->updated_at}}</td>                    
                    <td>
                       <a  href="{{ route('asnaf.edit',$item->id) }}"><button type="button" class="btn bg-gradient-warning mr-1"><i class="fa fa-edit"></i></button></a>                                             
                      <a  onclick="deleted(this)" data-href="{{ route('asnaf.destroy',$item->id) }}"><button type="button" class="btn bg-gradient-danger"><i class="fa fa-trash-alt"></i></button></a>                      
                    </td>
                </tr>
                @endforeach
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
     
    </div>
   
  </div>  



     <!-- Modal -->

@endsection
    
@section('script')
<script>
  function deleted(e) {
    Swal.fire({
      title: 'Anda yakin?',
      text: "tekan tombol oke untuk menghapus data",
      icon: 'warning',
      showCancelButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = $(e).data('href')
      }
    })
  }

</script>

@endsection