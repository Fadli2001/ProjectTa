<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class ChangePassword extends Controller
{
    public function edit(){

        return view('user.changepas');
    }
    public function update(Request $request){
        $rules = [
            "old_password" => "required",
            "password" => "required|string|min:8|confirmed",
        ];

        $messages = [
            'required' => "Password tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'confirmed' => 'Konfirmasi Password Tidak Cocok'            
        ];

        $this->validate($request,$rules,$messages);

        $currentpassword = Auth::user()->password;
        $old_password = request('old_password');

        if (Hash::check($old_password,$currentpassword)) {
            auth()->user()->update([
                'password'=> bcrypt(request('password')),
            ]);

            return redirect()->route('user.setting')->with('status', 'Password Berhasil diUbah');
            
        }else{
            return back()->withErrors(['old_password' =>'Password Lama Masih Salah']);
        }

    }
}
