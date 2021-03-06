<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_user;
    public function __construct()
    {
        parent::__construct();
        $this->new_user = new User();

        $this->middleware(function($request,$next){
            if(Gate::allows('users'))return $next($request);
            abort(403, "Anda tidak memiliki cukup hak akses");                         
         });
    }

    public function index(Request $request)
    {
        // $name = $request->name;
        $data = User::all();

        // dd($data);
        return view ("user.index",[
            'data' => $data
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user.create",[
            "data" => DB::table("users")->where("status")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            "name" => "required|min:4",
            "email" => "required|min:4|max:30|unique:users,email",
            "password"=>"required|string|min:8|confirmed",            
            "role"=>"required",
            "status"=>"required",
            "foto" => "required|max:2000|mimes:png,jpg,jpeg",
            "tandatangan" => "required|max:2000|mimes:png,jpg,jpeg",
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan, .jpeg, .png atau .jpg",            
            'size' => "ukuran :attribute minimal 2MB"
        ];

        $this->validate($request,$rules,$messages);       
        $this->new_user->name = $request->name;
        $this->new_user->email = $request->email;        
        $this->new_user->role= json_encode($request->role);        
        $this->new_user->status = $request->status;
        $this->new_user->password = Hash::make($request->password);
        
        $nm = $request->foto;
        $ttd = $request->tandatangan;
        $fotopp = time() . rand(100, 999) . "." .$nm->getClientOriginalExtension();
        $fotottd = time() . rand(100, 999) . "." .$ttd->getClientOriginalExtension();
        $this->new_user->foto = $fotopp;
        $this->new_user->tandatangan = $fotottd;
        $nm->move(public_path() . '/image', $fotopp);
        $ttd->move(public_path() . '/image/tandatangan', $fotottd);
        $this->new_user->save();
               
        return redirect()->route('user')->with('status', 'User Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $user_detail = User::find($_GET['id']);
        echo json_encode($user_detail);
        // return view('user.index',[
        //     'datashow' => $user_detail

        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_edit = User::find($id);
        return view('user.edit', [
            "datauser" => $user_edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {         
        $rules = [
            "name" => "required|min:4|max:40",
            "email" => "min:4|max:40",                 
            "role"=>"required",
            "status"=>"required",
            "foto" => "max:2000|mimes:png,jpg,jpeg",
            "tandatangan" => "max:1000|mimes:png,jpg,jpeg",
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan, .jpeg, .png atau .jpg",            
            'foto.max' => "ukuran :attribute minimal 2MB",
            'tandatangan.max' => "ukuran :attribute minimal 2MB",
            'unique'=>":attribute telah digunakan"
        ];

        $this->validate($request,$rules,$messages);       

        $user_edit = User::find($id);
        $user_edit->name = $request->name;                
        $user_edit->status = $request->status;
        $user_edit->email = $request->email;        
        $user_edit->role = $request->role;

        if ($request->foto) {
            $nm = $request->foto;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $user_edit->foto = $namaFile;
            $nm->move(public_path() . '/image', $namaFile);
        
        }else if ($request->tandatangan) {
            $nm = $request->tandatangan;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $user_edit->tandatangan = $namaFile;
            $nm->move(public_path() . '/image/tandatangan', $namaFile);
        }


        // if (!$request->foto && !$request->tandatangan) {
        //     $user_edit->foto = $last_fp;
        //     $user_edit->tandatangan = $last_ttd;
        // } else {
        //     if ($request->foto != $last_fp && $request->tandatangan != $last_ttd) {
        //         $nm = $request->foto;
        //         $ttd = $request->tandatangan;
        //         // dd($nm);
        //         dd($ttd);
        //         $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
        //         $filettd = time() . rand(100, 999) . "." . $ttd->getClientOriginalExtension();
        //         $user_edit->foto = $namaFile;
        //         $user_edit ->tandatangan = $filettd;
        //         $nm->move(public_path() . '/image', $namaFile);
        //         $ttd->move(public_path() . '/image/tandatangan', $filettd);

        //     } else {
        //         $request->foto->move(public_path() . '/image', $last_fp);
        //         $request->tandatangan->move(public_path() . '/image/tandatangan', $last_ttd);
        //     }
        // }
        $user_edit->save();        
        return redirect()->route('user')->with('status', 'User Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

        $user_hapus = User::findOrFail($id);        
        $image_path = "image/" . $user_hapus->foto;
        $image_path = "image/tandatangan" . $user_hapus->tandatangan;
        $user_hapus->delete();
        if (file::exists($image_path)) {
            file::delete($image_path);
        }    

        return redirect()->route('user')->with('status', 'User Successfully Deleted');

    }
}
