@extends('basetemplate.app')
@section('title','Dashboard')
@section('container')
@php                          
$roles = json_decode(Auth::user()->role)                    
@endphp 
<div class="row">
    <div class="col-md-12 text-muted">
        <h5>SettingProfile/</h5>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
        <a  href="{{route('dashboard')}}" class="float-right">
            <button type="button" class="btn btn-md bg-lightblue color-palette d-flex align-items-center box_shadow"> <i class="fa fa-arrow-alt-circle-left mr-1"></i> Kembali</button>
        </a>
    </div>
</div>
<div class="row mt-2">
    <div class="col-lg-6 col-md-8 col-sm-12 mx-auto">
        <div class="card card-lightblue card-outline box_shadow">            
            <div class="card-body box-profile">
                @foreach ($roles as $item)
                <a class="badge  bg-lightblue">                    
                    
                        <i class="fas fa-user-tag"></i>{{$item}}                        
                    
                </a>       
                @endforeach    
                 <div class="text-center">
                       <img class="image_profile " src="{{ asset('image/'.Auth::user()->foto)}}"  width="150" height="150" alt="User profile picture">
                </div>                                                
                <ul class="list-group list-group-unbordered my-3">                    
                    <li class="list-group-item">
                        <b>Nama</b> <span class="float-right">{{Auth::user()->name}}</span>
                    </li>
                    <li class="list-group-item">
                        <b>Email</b> <span class="float-right">{{Auth::user()->email}}</span>
                    </li>
                    <li style="list-style-type: none" class="mt-2">
                        <a href="{{route('user.setting.edit')}}" class="btn btn-sm bg-lightblue ">
                            <i class="fas fa-edit"></i> Edit Profile
                        </a> 
                        {{-- <span class="float-right"><a href="{{route('user.password.edit')}}"><span>Ubah Password </span></a></span> --}}
                        <a href="{{route('user.password.edit')}}" class="btn btn-sm bg-lightblue float-right">
                            <i class="fas fa-unlock"></i> Ubah Password
                        </a> 
                    </li>
                                  
                </ul>        
                
            </div>            
        </div>
    </div>
</div>


@endsection