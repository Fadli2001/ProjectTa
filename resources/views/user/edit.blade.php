@extends('basetemplate.app')
@section('title','Create User')
@section('container') 
  <div class="row">
    <div class="col-md-12">
        <a  href="{{route('user')}}">
            <button type="button" class="btn bg-gradient-info d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
  </div>
  <div class="row">
  <div class="col-md-10">
    <div class="card card-info mt-2 box_shadow">
      <div class="card-header">
        <h3 class="card-title text-bold">Edit Data User </h3>
      </div>                  
      <div class="card-body">            
              <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('user.update',$datauser['id'])}}">
                @csrf
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama</label>      
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-address-card"></i></span>
                        </div>
                         <input type="text" value="{{ $datauser['name'] }}" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Your Name">        
                      </div>              
                    </div>
                    @error('name')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                     @enderror           
                     <div class="form-group">
                       <label>Email</label>              
                       <div class="input-group">
                         <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-at"></i></span>
                         </div>
                         <input type="text" value="{{ $datauser['email'] }}" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputName1" placeholder="Your Email">    
                       </div>              
                     </div>
                     @error('email')
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
                            <option class="p-3" value="ACTIVE" {{ $datauser['status'] == 'ACTIVE' ? 'selected=selected' : '' }}>ACTIVE</option>
                            <option class="p-3" value="INACTIVE" {{ $datauser['status'] == 'INACTIVE' ? 'selected=selected' : '' }}>INACTIVE</option>
                          </select>
                        </div>
                      </div>
                      @error('status')
                      <div class="alert alert-danger mt-2">
                         {{ $message }}
                      </div>
                     @enderror                                                                     
                     <div class="form-group">
                       <label>Roles</label>
                       <div class="row">
                         <div class="col-md-12">                  
                           <div class="icheck-info d-inline mr-4">
                             <input class="custom-control-input " type="checkbox"  name="role[]" {{ in_array("ADMIN",json_decode($datauser['role'])) ? "checked" : ""}} id="admin" value="ADMIN">
                             <label for="admin">Admin</label>
                            </div>
                            <div class="icheck-info d-inline mr-4">
                              <input class="custom-control-input " type="checkbox"  name="role[]" {{ in_array("AMIL",json_decode($datauser['role'])) ? "checked" : ""}} id="amil" value="AMIL">
                              <label for="amil">Amil</label>
                            </div>      
                            <div class="icheck-info d-inline mr-4">
                              <input class="custom-control-input " type="checkbox"  name="role[]" {{ in_array("PENGURUS",json_decode($datauser['role'])) ? "checked" : ""}} id="pengurus" value="PENGURUS">
                              <label for="pengurus">Pengurus
                              </label>
                            </div>   
                            <div class="icheck-info d-inline mr-4">
                              <input class="custom-control-input " type="checkbox"  name="role[]" {{ in_array("BENDAHARA",json_decode($datauser['role'])) ? "checked" : ""}} id="bendahara" value="BENDAHARA">
                              <label for="bendahara">Bendahara
                              </label>
                            </div>   
                            <div class="icheck-info d-inline">
                              <input class="custom-control-input " type="checkbox"  name="role[]" {{ in_array("KETUA",json_decode($datauser['role'])) ? "checked" : ""}} id="ketua" value="KETUA">                    
                              <label for="ketua">Ketua
                              </label>
                            </div>                                      
                          </div>
                        </div>
                      </div>
                      @error('role')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                      @enderror        
                      
                    </div>
                    
                                      
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            @if($datauser['foto'])
                                            <img   src="{{ asset('image/'.$datauser['foto']) }}" width="15%" alt="image">
                                            @else
                                            <span class="text-danger">Tidak Ada Gambar</span>
                                            @endif
                                            <div class="row">
                                              <small class="text-muted my-2">*Kosongkan jika tidak ingin mengubah gambar</small>
                                            </div>                                               
                                            <label for="exampleInputFile">Upload Gambar Profile</label>
                                            <div class="input-group">
                                              <div class="custom-file">
                                                <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto" id="exampleInputFile">
                                                <label class="custom-file-label" for="exampleInputFile">Photo</label>
                                              </div>                    
                                            </div>                  
                                          </div>
                                          @error('foto')
                                                <div class="alert alert-danger mt-2">
                                                  {{ $message }}
                                                 </div>
                                           @enderror  
  
                                           <div class="form-group ">
                                             @if($datauser['tandatangan'])
                                          <img src="{{ asset('image/tandatangan/'.$datauser['tandatangan']) }}" width="15%" alt="image">
                                          @else
                                          <span class="text-danger">Tidak Ada Gambar</span>
                                          @endif
                                          <div class="row my-2">
                                            <small class="text-muted">*Kosongkan jika tidak ingin mengubah gambar</small>
                                          </div>                                               
                                          <label for="exampleInputFile">Upload Gambar Tandatangan</label>
                                          <div class="input-group">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input @error('tandatangan') is-invalid @enderror" name="tandatangan" id="exampleInputFile">
                                              <label class="custom-file-label" for="exampleInputFile">Signature</label>
                                            </div>              
                                          </div>
                                        </div>
                                        @error('tandatangan')
                                        <div class="alert alert-danger mt-2">
                                          {{ $message }}
                                        </div>
                                        @enderror   
                                      </div>
                                    </div>                                      
                                    </div>          
                                    <div class="card-footer">
                                      <button type="submit" class="btn bg-gradient-info">Submit</button>        
                                    </div>                     
                                  </form>      
    </div>
  </div>
  </div>      
</div>
@endsection
  