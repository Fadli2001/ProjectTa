@extends('basetemplate.app')
@section('title','Edit Proposal')
@section('container')
<div class="row">
    <div class="col-md-11 mx-auto">
        <a  href="{{route('proposal')}}">
            <button type="button" class="btn bg-gradient-info d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
  </div>
<div class="row mt-2">
  <div class="col-md-11 col-sm-12 mx-auto">
    <div class="card card-info box_shadow ">
      <div class="card-header">
        <h3 class="card-title">Edit Data Proposal </h3>
      </div>
      <div class="card-body">            
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('proposal.update',$data['id'])}}">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label>No. Ajuan</label>      
                    <div class="input-group">
                      <div class="input-group-prepend"> 
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                      </div>
                           <input type="text" value="{{$data["no_ajuan"]}}" name="no_ajuan" class="form-control @error('no_ajuan') is-invalid @enderror" id="exampleInputName1" placeholder="masukan nama ">        
                    </div>              
                  </div>
                  @error('no_ajuan')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Kategori Ajuan</label>     
                    <div class="input-group"> 
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                      </div>                
                      <select class="form-control" value="" name="kategori_ajuan" >
                        <option hidden value="">pilih kategori</option>
                        <option class="p-3" value="Darurat" {{ $data['kategori_ajuan'] == 'Darurat' ? 'selected=selected' : '' }}>Darurat</option>
                        <option class="p-3" value="Tidak Darurat" {{ $data['kategori_ajuan'] == 'Tidak Darurat' ? 'selected=selected' : '' }}>Tidak Darurat</option>
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
                         <option hidden value="">pilih kriteria</option>
                         <option class="p-3" value="Lembaga" {{ ( $data['kriteria_penerima']) == 'Lembaga' ? 'selected=selected' : '' }}>Lembaga</option>
                         <option class="p-3" value="Individu" {{( $data['kriteria_penerima']) == 'Individu' ? 'selected=selected' : '' }}>Individu</option>
                         <option class="p-3" value="Kelompok" {{( $data['kriteria_penerima']) == 'Kelompok' ? 'selected=selected' : '' }}>Kelompok</option>
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
                          <option hidden>Pilih Program</option>                    
                          @foreach ($program as $item)
                              <option {{ ( $data['kategori_program_id']) == $item->id ? 'selected=selected' : '' }} value="{{$item->id}}">{{$item->program}}</option>
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
                      <input type="text" value="{{ $data['ket_program'] }}" name="ket_program" class="form-control @error('ket_program') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Keterangan program">        
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
                          <input type="text" value="{{$data["nama_pengaju"]}}" name="nama_pengaju" class="form-control @error('nama_pengaju') is-invalid @enderror" id="exampleInputName1" placeholder="masukan nama ">        
                   </div>              
                 </div>
                 @error('nama_pengaju')
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
                          <input type="" value="{{ $data["no_kontak"] }}" name="no_kontak" class="form-control @error('no_kontak') is-invalid @enderror" id="exampleInputName1" placeholder="masukan no kontak ">        
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
                   <label>Email</label>      
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-at"></i></span>
                     </div>
                     <input type="text" value="{{ $data['email'] }}" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputName1" placeholder="email pengaju">    
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
                   <label>Asnaf</label>                    
                   <div class="input-group">
                     <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                     </div>        
                     <select class="form-control" value="" name="asnaf" id="asnaf_id">
                       <option hidden value="">Pilih Asnaf</option>
                       @foreach ($asnaf as $item)
                       <option {{ ( $data['asnaf_id']) == $item->id ? 'selected=selected' : '' }} value="{{$item->id}}">{{$item->asnaf}}</option>
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
                       <option hidden value="">pilih jenis program</option>
                       <option class="p-3" value="Sustainable" {{ $data['jenis_program'] == 'Sustainable' ? 'selected=selected' : '' }}>Sustainable</option>
                       <option class="p-3" value="Charity" {{ $data['jenis_program'] == 'Charity' ? 'selected=selected' : '' }}>Charity</option>
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
                       <option hidden value="">pilih bentuk penyaluran</option>
                       <option class="p-3" value="Rutin" {{ $data['bentuk_penyaluran'] == 'Rutin' ? 'selected=selected' : '' }}>Rutin</option>
                       <option class="p-3" value="Tidak Rutin" {{ $data['bentuk_penyaluran'] == 'Tidak Rutin' ? 'selected=selected' : '' }}>Tidak Rutin</option>
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
                           <input type="text" value="{{ $data['sosmed'] }}" name="sosmed" class="form-control @error('sosmed') is-invalid @enderror" id="exampleInputName1" placeholder="masukan sosmed ">        
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
                   <textarea type="text" rows="4" name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="exampleInputName1" placeholder="Alamat ">{{$data["alamat"]}}</textarea>
                  </div>
                 @error('alamat')
                 <div class="alert alert-danger mt-2">
                     {{ $message }}
                 </div>
                  @enderror   
                </div>
                <div class="col-md-6 pt-4">
                  <div class="form-group ">
                     @if($data['file_pendukung'])
                     <span><a target="blank" href="{{ asset('file_pendukung/'.$data['file_pendukung']) }}">Klik link ini untuk melihat file </a></span>                
                       @else
                       <span class="text-danger">Tidak Ada file</span>
                       @endif
                       <div class="row ">
                         <small class="text-muted">*Kosongkan jika tidak ingin mengubah file</small>
                       </div>                                               
                    <label for="exampleInputFile">Upload file</label>
                    <div class="input-group">
                     <div class="custom-file">
                         <input type="file" value="{{$data['file_pendukung']}}" class="custom-file-input @error('file_pendukung') is-invalid @enderror" name="file_pendukung" id="exampleInputFile">
                         <label class="custom-file-label" for="exampleInputFile">Berkas Persyaratan</label>
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
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</li>
            @endforeach
          </div>          
          <div class="card-footer">
            <button type="submit" class="btn bg-gradient btn-info">Submit</button>        
          </div>
        </form>
    </div>               
  </div>
</div>

  @endsection
    
