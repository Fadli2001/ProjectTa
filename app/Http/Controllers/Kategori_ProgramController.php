<?php

namespace App\Http\Controllers;

use App\Models\Kategori_Pogram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;


class Kategori_ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_kategori;
    public function __construct()
    {   
        parent::__construct();
        $this->new_kategori= new Kategori_Pogram();
        $this->middleware(function($request,$next){
            if(Gate::allows('kategori_program'))return $next($request);
            abort(403, "Anda tidak memiliki cukup hak akses");                         
         });
    }
    public function index(Request $request)
    {
        $program = $request->program;             
        $data = Kategori_pogram::all();

        // dd($data);
        return view ("kategori_program.index",[
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
        return view('kategori_program.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "program"=>"required|min:4|max:20|unique:kategori_program,program",            
           
        ]);

        $this->new_kategori->program = $request->program;
        $this->new_kategori->save();
        return redirect()->route('kategori_program')->with('status','susccess');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori_edit = Kategori_Pogram::find($id);
        return view('kategori_program.edit', [
            "kategori_edit" => $kategori_edit
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
        // $user_edit = User::find($id);

        $kategori_edit = Kategori_Pogram::find($id);
        $kategori_edit->program = $request->program;
        $kategori_edit->save();
        return redirect()->route('kategori_program')->with('status', 'User Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori_hapus = Kategori_Pogram::findOrFail($id);        
        $kategori_hapus->delete();
        

        return redirect()->route('kategori_program')->with('status', 'User Successfully Deleted');
    }
}
