@extends('proposal.detail.detail')
@section('content')

  <div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Rincian</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('rincian.update',$data['id'])}}">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Uraian</label>
                  <input type="text" value="{{ $data['uraian'] }}" name="uraian" class="form-control @error('uraian') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
                </div>
                @error('uraian')
                <div class="alert alert-danger mt-2"> 
                    {{ $message }}
                </div>
                 @enderror                  
                 <div class="form-group">
                    <label for="exampleInputEmail1">Qty</label>
                    <input type="number" value="{{ $data['qty'] }}" name="qty" class="form-control @error('qty') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">          
                  </div>
                  @error('qty')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nominal</label>
                    <input type="text" value="{{ $data['nominal'] }}" name="nominal" class="form-control @error('nominal') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
                  </div>
                  @error('nominal')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror                         
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>      
    </div>
  </div>
  

  
  
@endsection
    
