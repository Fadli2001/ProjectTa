@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')

<div class="row">  
    <div class="col-md-12">
      <div class="card box_shadow">
        <div class="card-header">
          <div class="float-right">             
              <a href="{{route('asnaf.create')}}">
                <button type="button" class="btn bg-lightblue color-palette"> <i class="fa fa-plus-square"></i> Tambah </button>
              </a>            
          </div>   
          <h3 class="float-left">Kategori Asnaf</h3>                         
        </div>      
        <div class="card-body">
          <table id="datauser" class="table table-striped table-responsive-sm table-bordered">
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
                       <a  href="{{ route('asnaf.edit',$item->id) }}"><button type="button" class="btn bg-gradient-info btn-sm my-1"><i class="fa fa-pencil-alt"></i> Edit</button></a>                                             
                      <a  onclick="deleted(this)" data-href="{{ route('asnaf.destroy',$item->id) }}"><button type="button" class="btn btn-sm bg-gradient-danger my-1"><i class="fas fa-trash"></i> Hapus</button></a>                      
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

@endsection
    
