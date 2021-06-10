@extends('proposal.detail.detail')
@section('content')

  <div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Ajuan</h3>
            </div>          
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('pengajuan.update',$data["id"])}}">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">PIC</label>
                  <input type="text" value="{{ $data['pic'] }}" name="pic" class="form-control @error('pic') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
                </div>
                @error('pic')
                <div class="alert alert-danger mt-2"> 
                    {{ $message }}
                </div>
                 @enderror  
                <div class="form-group">
                    <label>Metode Pencairan</label>      
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                        </div>                
                        <select class="form-control" value="" name="metode" id="metode">
                          <option hidden value="">Select State</option>
                          <option class="p-3" value="transfer" {{ $data['metode'] == 'transfer' ? 'selected=selected' : '' }}>Transfer</option>
                          <option class="p-3" value="tunai" {{ $data['metode'] == 'tunai' ? 'selected=selected' : '' }}>Tunai</option>
                        </select>
                      </div>
                 </div>
                 @error('metode')
                 <div class="alert alert-danger mt-2"> 
                     {{ $message }}
                 </div>
                  @enderror  
                 <div class="form-group">
                    <label for="exampleInputEmail1">No. Rekening</label>
                    <input type="number" value="{{ $data['no_rekening'] }}" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">          
                    {{-- <input type="hidden" name="proposal_id" value={{$data["proposal_id"]}}> --}}
                  </div>
                  @error('no_rekening')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Nama Bank</label>
                    <input type="text" value="{{ $data['nama_bank'] }}" name="nama_bank" class="form-control @error('nama_bank') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
                  </div>
                  @error('nama_bank')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Pemilik Rekening</label>
                    <input type="text" value="{{ $data['pemilik_rekening'] }}" name="pemilik_rekening" class="form-control @error('pemilik_rekening') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">          
                  </div>
                  @error('pemilik_rekening')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror  
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sumber Dana</label>
                    <input type="text" value="{{ $data['sumber_dana'] }}" name="sumber_dana" class="form-control @error('sumber_dana') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
                  </div>
                  @error('sumber_dana')
                  <div class="alert alert-danger mt-2"> 
                      {{ $message }}
                  </div>
                   @enderror                    
              </div>            
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>      
    </div>
  </div>
  

  
  
@endsection
    
