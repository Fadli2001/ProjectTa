@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')
<div class="row">
    <div class="col-md-12 text-muted">
        <h5>Setting/EditProfile</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
        <a  href="{{route('user.setting')}}" class="float-right">
            <button type="button" class="btn btn-md bg-lightblue color-palette d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
</div>
<div class="row mt-2">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
        <div class="card card-lightblue card-outline box_shadow">
            <div class="card-body box-profile">
                <form class="forms-sample " method="POST" enctype="multipart/form-data" action="{{route('user.setting.update')}}">
                @csrf
                <div class="text-center">                    
                    <img class="image_profile" src="{{ asset('image/'.Auth::user()->foto)}}" width="150" height="150"  alt="User profile picture">
                </div>                                    
                <ul class="list-group list-group-unbordered my-3">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputFile"> Foto Profile</label>
                        </div>
                        <div class="col-md-8">                                
                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('foto') is-invalid @enderror" name="foto" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Foto</label>
                                  </div>                    
                                </div>                                              
                              @error('foto')
                                    <div class="alert alert-danger mt-2">
                                      {{ $message }}
                                     </div>
                              @enderror  
                        </div>
                    </div>
                        <div class="row mt-3">

                            <div class="col-md-4">
                                <label for="exampleInputFile"> Nama</label>
                            </div>
                            <div class="col-md-8">
                                {{-- <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Your Name">                             --}}
                             <input type="text" value="{{ Auth::user()->name }}" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName1" placeholder="Your Name">        

                            </div>
                        </div>
                    </ul>
                </div>    
                <div class="card-footer ">
                    <div class="float-right" style="border: none;list-style-type: none;">
                        <button type="submit" class="btn  bg-lightblue color-palette">Submit</button>        
                    </div>                                                                        
                </div>        
            </div>
        </form>                        
    </div>
</div>
@endsection