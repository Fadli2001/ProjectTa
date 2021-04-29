@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')
<div class="row">
  <div class="col-md-12">
      <a  href="{{route('asnaf')}}">
          <button type="button" class="btn bg-gradient-info d-flex align-items-center"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
      </a>
  </div>
</div>
<div class="row mt-2">  
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Edit Kategori </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('asnaf.update',$asnaf_edit['id'])}}" >
            @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama </label>
                  <div class="col-sm-10">                    
                    <input type="text" value="{{ $asnaf_edit['asnaf'] }}" name="asnaf" class="form-control @error('asnaf') is-invalid @enderror" id="exampleInputName1" placeholder="Nama Asnaf">        
                    {{-- <input type="text" value="{{ $kategori_edit['program'] }}" name="program" class="form-control @error('program') is-invalid @enderror" id="exampleInputName1" placeholder="Nama Program">                                                --}}

                    
                  </div>
                </div>                
                @error('asnaf')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
                 @enderror    
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn bg-gradient btn-info">Kirim</button>        

              </div>
              <!-- /.card-footer -->
            </form>
          </div>
    </div>
  </div>  

@endsection
    
