<?php

namespace App\Http\Controllers;

use App\Models\Asnaf;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class AsnafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $new_asnaf;
    public function __construct()
    {   
        parent::__construct();
        $this->new_asnaf= new Asnaf();

        $this->middleware(function($request,$next){
            if(Gate::allows('asnaf'))return $next($request);
            abort(403, "Anda tidak memiliki cukup hak akses");                         
         });
    }
    public function index(Request $request)
    {        
        $data = Asnaf::all();
        
        return view ("asnaf.index",[
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
        return view('asnaf.create');
        
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
            "asnaf"=>"required|min:4|max:20|unique:asnaf,asnaf",            
           
        ]);

        $this->new_asnaf->asnaf = $request->asnaf;
        $this->new_asnaf->save();
        return redirect()->route('asnaf')->with('status','susccess');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $asnaf_edit = Asnaf::find($id);
        return view('asnaf.edit', [
            "asnaf_edit" => $asnaf_edit
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
        $asnaf_edit = Asnaf::find($id);
        $asnaf_edit->asnaf = $request->asnaf;
        $asnaf_edit->save();
        return redirect()->route('asnaf')->with('status', 'Asnaf Successfully Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asnaf_hapus = Asnaf::findOrFail($id);        
        $asnaf_hapus->delete();
        

        return redirect()->route('asnaf')->with('status', 'Asnaf Successfully Deleted');
    }
}
