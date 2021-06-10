@extends('basetemplate.app')
@section('title','Create User')
@section('container')
<div class="row">
    <div class="col-md-11 mx-auto ">
        <a  href="{{route('proposal')}}">
            <button type="button" class="btn bg-lightblue color-palette d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
  </div>
<div class="row mt-2">
  <div class="col-md-11 col-sm-12 mx-auto">
       <div class="card card-lightblue color-palette box_shadow" >
      <div class="card-header">
        <h3 class="card-title">Masukan Data Proposal </h3>
      </div>
      <div class="card-body">            
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('proposal.store')}}">
              @csrf
              <div class="row">
      
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kategori Ajuan</label>     
                    <div class="input-group"> 
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                      </div>                
                      <select class="form-control" value="" name="kategori_ajuan" >
                        <option hidden value="">-- Pilih Kategori --</option>
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
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label>Kriteria Penerima</label>     
                     <div class="input-group"> 
                       <div class="input-group-prepend">
                         <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                       </div>                
                       <select class="form-control" value="" name="kriteria_penerima" >
                         <option hidden value="">-- Pilih Kriteria --</option>
                         <option class="p-3" value="Lembaga" {{ old('kriteria_penerima') == 'Lembaga' ? 'selected=selected' : '' }}>Lembaga</option>
                         <option class="p-3" value="Individu" {{ old('kriteria_penerima') == 'Individu' ? 'selected=selected' : '' }}>Individu</option>
                         <option class="p-3" value="Kelompok" {{ old('kriteria_penerima') == 'Kelompok' ? 'selected=selected' : '' }}>Kelompok</option>
                       </select>
                     </div>
                   </div>
                 @error('kriteria_penerima')
                 <div class="alert alert-danger mt-2">
                     {{ $message }}
                 </div>
                  @enderror                                                        
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kategori Program</label>                    
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                      </div>        
                      <select class="form-control" value="" name="kategori_program"  id="kategori_program_id">
                        <option hidden value="">-- Pilih Program --</option>
                        @foreach ($program as $item)
                            <option value="{{$item->id}}">{{$item->program}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  @error('kategori_program')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror       
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Keterangan Program</label>                    
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                      </div>        
                      <input type="text" value="{{ old('no_ajuan') }}" name="ket_program" class="form-control @error('ket_program') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan Program">        
                    </div>
                  </div>
                  @error('ket_program')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                   <label>Nama Penanggung jawab</label>      
                   <div class="input-group">
                     <div class="input-group-prepend"> 
                       <span class="input-group-text"><i class="far fa-address-card"></i></span>
                     </div>
                          <input type="text" value="{{old('nama_pengaju')}}" name="nama_pengaju" class="form-control @error('nama_pengaju') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Nama ">        
                   </div>              
                 </div>
                 @error('nama_pengaju')
                 <div class="alert alert-danger mt-2">
                     {{ $message }}
                 </div>
                  @enderror
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Email</label>      
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                      </div>
                      <input type="text" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputName1" placeholder="Email Pengaju">    
                    </div>              
                  </div>
                  @error('email')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                   <label>No Kontak</label>      
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fa fa-phone-square-alt"></i></span>
                     </div>
                          <input type="" value="{{ old('no_kontak') }}" name="no_kontak" class="form-control @error('no_kontak') is-invalid @enderror" id="exampleInputName1" placeholder=" No. Kontak ">        
                   </div>              
                 </div>
                 @error('no_kontak')
                 <div class="alert alert-danger mt-2">
                     {{ $message }}
                 </div>
                  @enderror
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                   <label>Asnaf</label>                    
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                     </div>        
                     <select class="form-control" value="" name="asnaf" id="asnaf_id">
                       <option hidden value="">-- Pilih Asnaf --</option>
                       @foreach ($asnaf as $item)
                           <option value="{{$item->id}}">{{$item->asnaf}}</option>
                       @endforeach
                     </select>
                   </div>
                 </div>
                 @error('asnaf')
                 <div class="alert alert-danger mt-2">
                     {{ $message }}
                 </div>
                  @enderror
                </div>
                <div class="col-md-4">                  
                  <div class="form-group">
                   <label>Jenis Program</label>     
                   <div class="input-group"> 
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                     </div>                
                     <select class="form-control" value="" name="jenis_program" id="status">
                       <option hidden value="">Pilih Jenis Program</option>
                       <option class="p-3" value="Sustainable" {{ old('jenis_program') == 'Sustainable' ? 'selected=selected' : '' }}>Sustainable</option>
                       <option class="p-3" value="Charity" {{ old('jenis_program') == 'Charity' ? 'selected=selected' : '' }}>Charity</option>
                     </select>
                   </div>
                 </div>
               @error('jenis_program')
               <div class="alert alert-danger mt-2">
                   {{ $message }}
               </div>
                @enderror
                </div> 
                <div class="col-md-4">
                  <div class="form-group">
                   <label>Bentuk Penyaluran</label>     
                   <div class="input-group"> 
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                     </div>                
                     <select class="form-control" value="" name="bentuk_penyaluran" id="status">
                       <option hidden value="">-- Pilih Bentuk Penyaluran --</option>
                       <option class="p-3" value="Rutin" {{ old('bentuk_penyaluran') == 'Rutin' ? 'selected=selected' : '' }}>Rutin</option>
                       <option class="p-3" value="Tidak Rutin" {{ old('bentuk_penyaluran') == 'Tidak Rutin' ? 'selected=selected' : '' }}>Tidak Rutin</option>
                     </select>
                   </div>
                 </div>
                   @error('bentuk_penyaluran')
                   <div class="alert alert-danger mt-2">
                       {{ $message }}
                   </div>
                   @enderror
                  </div>
                  <div class="col-md-4">                  
                    <div class="form-group">
                      <label>Sosmed</label>      
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                        </div>
                             <input type="text" value="{{ old('sosmed') }}" name="sosmed" class="form-control @error('sosmed') is-invalid @enderror" id="exampleInputName1" placeholder=" Sosmed Bersangkutan ">        
                      </div>              
                    </div>
                    @error('sosmed')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                     @enderror        
                  </div>
                  <div class="col-md-6">                  
                    <div class="form-group">
                     <label for="exampleFormControlTextarea1">Alamat</label>
                     <textarea class="form-control" value="{{ old('alamat') }}" name="alamat" id="exampleFormControlTextarea1" rows="4"></textarea>
                    </div>
                    @error('alamat')
                    <div class="alert alert-danger mt-2">
                      {{ $message }}
                    </div>
                    @enderror            
                  </div>
                  <div class="col-md-6">                  
                    <div class="form-group">
                      <label for="exampleInputFile">Upload File Pendukung</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input @error('file_pendukung') is-invalid @enderror" name="file_pendukung" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Upload Berkas Proposal</label>
                        </div>                    
                      </div>                  
                    </div>
                    @error('file_pendukung')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                           </div>
                    @enderror            
                  </div>      
              </div>            
            {{-- @foreach ($errors->all() as $error)
                <p>{{ $error }}</li>
            @endforeach --}}
          </div>          
          <div class="card-footer">
            <button type="submit" class="btn bg-lightblue color-palette">Submit</button>        
          </div>
        </form>
    </div>           
  </div>                  
</div>
  @endsection
    
