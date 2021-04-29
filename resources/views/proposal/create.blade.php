@extends('basetemplate.app')
@section('title','Create User')
@section('container')
<div class="row">
    <div class="col-md-12">
        <a  href="{{route('proposal')}}">
            <button type="button" class="btn bg-gradient-info d-flex align-items-center"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
  </div>
<div class="row mt-2">
  <div class="col-md-12">
  
    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title">Masukan Data Proposal </h3>
      </div>
      <div class="card-body">            
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('proposal.store')}}">
              @csrf
              <div class="form-group">
                <label>Kategori Ajuan</label>     
                <div class="input-group"> 
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                  </div>                
                  <select class="form-control" value="" name="kategori_ajuan" id="status">
                    <option hidden value="">Select Kategori</option>
                    <option class="p-3" value="Darurat" {{ old('kategori_ajuan') == 'Darurat' ? 'selected=selected' : '' }}>Darurat</option>
                    <option class="p-3" value="Tidak Darurat" {{ old('kategori_ajuan') == 'Tidak Darurat' ? 'selected=selected' : '' }}>Tidak Darurat</option>
                  </select>
                </div>
              </div>
            @error('kategori_ajuan')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
             @enderror           
             <div class="form-group">
                 <label>Kriteria Penerima</label>     
                <div class="input-group"> 
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                  </div>                
                  <select class="form-control" value="" name="kriteria_penerima" id="status">
                    <option hidden value="">Select Kriteria</option>
                    <option class="p-3" value="Lembaga" {{ old('kategori_ajuan') == 'Lembaga' ? 'selected=selected' : '' }}>Lembaga</option>
                    <option class="p-3" value="Individu" {{ old('kategori_ajuan') == 'Individu' ? 'selected=selected' : '' }}>Individu</option>
                    <option class="p-3" value="Kelompok" {{ old('kategori_ajuan') == 'Kelompok' ? 'selected=selected' : '' }}>Kelompok</option>
                  </select>
                </div>
              </div>
            @error('kategori_ajuan')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
             @enderror                          
                  
            
            <div class="form-group">
              <label>State</label>      
              
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                </div>        
                <select class="form-control" value="" name="status" id="status">
                  <option hidden value="">Select State</option>
                  <option class="p-3" value="ACTIVE" {{ old('status') == 'ACTIVE' ? 'selected=selected' : '' }}>ACTIVE</option>
                  <option class="p-3" value="INACTIVE" {{ old('status') == 'INACTIVE' ? 'selected=selected' : '' }}>INACTIVE</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Upload Profile Image</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto" id="exampleInputFile">
                  <label class="custom-file-label" for="exampleInputFile">Foto</label>
                </div>                    
              </div>                  
            </div>
            @error('foto')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                   </div>
             @enderror  
            <div class="form-group">
              <label for="exampleInputFile">Upload Signature</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="tandatangan" class="custom-file-input form-control @error('tandatangan') is-invalid @enderror">
  
                  <label class="custom-file-label" for="exampleInputFile">Foto</label>
                </div>            
              </div>
            </div>
            @error('tandatangan')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror   
          </div>          
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient btn-info">Submit</button>        
          </div>
        </form>
        </div>     
      </div>
      </div>            
    </div>
  </div>
</div>
  @endsection
    
