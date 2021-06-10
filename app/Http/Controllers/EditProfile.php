<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EditProfile extends Controller

{    

    public function view(){
        return view('user.set_profile',[

        ]);
    }

    public function edit(){                                    
        
        return view('user.profileupdate',[                        
        ]);
    }

    public function update(Request $request){

        $rules = [
            "name" => "min:5|max:20",           
            "foto" => "max:2000|mimes:png,jpeg",
                    
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan, .png atau .jpg",            
            'size' => "ukuran :attribute minimal 2MB",
            'unique'=>":attribute telah digunakan"
        ];

        $this->validate($request,$rules,$messages);       


            $profile_update = User::find( Auth::user()->id);                                   
            $profile_update->name = $request->name;                     
            
           if( $request->foto){
               $nm = $request->foto;
               $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
               $profile_update->foto = $namaFile;
               $nm->move(public_path() . '/image', $namaFile);               
            }
            
            $profile_update->save();        
            return redirect()->route('user.setting')->with('status', 'Profile Berhasil diUbah');
    }
}
