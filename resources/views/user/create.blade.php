@extends('basetemplate.app')
@section('title','Create User')
@section('container')
<div class="row">
    <div class="col-md-12">
        <a  href="{{route('user')}}">
            <button type="button" class="btn bg-lightblue color-palette d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
  </div>
<div class="row mt-2 ">
  <div class="col-md-8">  
    <div class="card card-lightblue color-palette box_shadow">
      <div class="card-header">
        <h3 class="card-title">Masukan Data User </h3>
      </div>
      <div class="card-body">            
            <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('user.store')}}">
              @csrf
              <div class="row">

                <div class="col-md-6">
                  <div class="form-group">
                    <label>Nama</label>      
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-address-card"></i></span>
                      </div>
                           <input type="text" value="{{ old('name') }}" name="name" class="form-control  @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Nama">                             
                      </div>              
                  </div>
                  @error('name')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror           
                </div>
                <div class="col-md-6">                
                  <div class="form-group">
                    <label>Email</label>          
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-at"></i></span>
                      </div>
                      <input type="text" value="{{ old('email') }}" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputName1" placeholder="Masukan Email ">    
                    </div>              
                  </div>
                  @error('email')
                  <div class="alert alert-danger mt-2">
                      {{ $message }}
                  </div>
                   @enderror                              
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group" >
                    <label>Password</label>    
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input id="password" type="password" class="form-control @error('paassword') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">                                
                    </div>              
                  </div>
                  @error('password')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
               @enderror            
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Konfirmasi Password</label>            
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Konfirmasi Password">
                    </div>
                  </div>
                  @error('password')
                  <div class="alert alert-danger mt-2">
                     {{ $message }}
                  </div>
               @enderror                  
                </div>                
              </div>
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <label>Roles</label>
                    <div class="row">
                      <div class="col-md-12">           
                        <div class="icheck-info d-inline mr-3">
                          <input class="custom-control-input" type="checkbox"  name="role[]" id="admin" value="ADMIN">                      
                          <label for="admin">Admin
                          </label>
                        </div>                                              
                          <div class="icheck-info d-inline mr-3">
                            <input class="custom-control-input" type="checkbox"  name="role[]" id="amil" value="AMIL">                      
                            <label for="amil">Amil
                            </label>
                          </div>      
                          <div class="icheck-info d-inline mr-3">
                            <input class="custom-control-input" type="checkbox"  name="role[]" id="pengurus" value="PENGURUS">                      
                            <label for="pengurus">Pengurus
                            </label>
                          </div>   
                          <div class="icheck-info d-inline mr-3">
                            <input class="custom-control-input" type="checkbox"  name="role[]" id="bendahara" value="BENDAHARA">
                            <label for="bendahara">Bendahara
                            </label>
                          </div>   
                          <div class="icheck-info d-inline">
                            <input class="custom-control-input" type="checkbox"  name="role[]" id="ketua" value="KETUA">                      
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
                    <label>State</label>     
                    <div class="input-group"> 
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-toggle-off"></i></span>
                      </div>
                      <select class="form-control " value="" name="status" id="status">
                        <option hidden value="">Select State</option>
                        <option class="p-3" value="ACTIVE" {{ old('status') == 'ACTIVE' ? 'selected=selected' : '' }}>ACTIVE</option>
                        <option class="p-3" value="INACTIVE" {{ old('status') == 'INACTIVE' ? 'selected=selected' : '' }}>INACTIVE</option>
                      </select>
                    </div>
                  </div>
                </div>              
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Gambar Profile</label>
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
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Gambar Tandatangan</label>
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
              </div>
          </div>          
          <div class="card-footer">
            <button type="submit" class="btn bg-lightblue color-palette">Submit</button>        
          </div>
        </form>
        </div>     
      </div>
      </div>            
    </div>
  </div>
</div>
  @endsection
    
