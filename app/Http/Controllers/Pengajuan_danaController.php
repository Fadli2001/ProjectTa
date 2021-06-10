<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan_dana;
use App\Models\Proposal;



class Pengajuan_danaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_pengajuan;
    public $new_proposal;


    public function __construct()
    {
        $this->new_pengajuan = new Pengajuan_dana();
        $this->new_proposal = new Proposal();

    }
    public function index($id)
    {
        $ajuan = Pengajuan_dana::where('proposal_id','=',$id)->get();
        $proposal = $this->new_proposal->getProposal($id);
        
        // dd($ajuan);
        return view ("proposal.detail.pengajuan.pengajuan_dana",[
            'data' => $proposal,
            'ajuan' => $ajuan
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $proposal = $this->new_proposal->getProposal($id);        
        return view('proposal.detail.pengajuan.tambah_ajuan',[
            'data' => $proposal,
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
            "pic" => "required|min:4|max:30",
            "metode" => "required",
            "no_rekening"=>"required|max:30|",            
            "nama_bank"=>"required",
            "pemilik_rekening"=>"required",
            "sumber_dana" => "required|min:8|max:100",            
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'max' => ":attribute karakter terlalu panjang"            
        ];

        $this->validate($request,$rules,$messages);   

        $this->new_pengajuan->pic = $request->pic;
        $this->new_pengajuan->proposal_id = $request->proposal_id;        
        $this->new_pengajuan->metode = $request->metode;
        $this->new_pengajuan->no_rekening = $request->no_rekening;
        $this->new_pengajuan->nama_bank = $request->nama_bank;
        $this->new_pengajuan->pemilik_rekening = $request->pemilik_rekening;
        $this->new_pengajuan->sumber_dana = $request->sumber_dana;        
        $this->new_pengajuan->save();

        return redirect()->route('pengajuan_dana',$request->proposal_id)->with('status', 'Proposal Successfully created');


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
        // dd(Pengajuan_dana);
        $pengajuan_edit = Pengajuan_dana::find($id);
        // $proposal = $this->new_proposal->getProposal($id);
        // dd($proposal);
        return view('proposal.detail.pengajuan.edit_ajuan', [
            "data" => $pengajuan_edit,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {

        $rules = [
            "pic" => "required",
            "metode" => "required",
            "no_rekening" => "required",
            "nama_bank" => "required|max:15|",            
            "pemilik_rekening" => "required|max:20",
            "sumber_dana" => "required|min:8|max:50",                       
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",                                    
            'unique' => ":attribute telah digunakan"
            
        ];

        $this->validate($request,$rules,$messages);

        $pengajuan_edit = Pengajuan_dana::find($id);        
        // dd($request);
        $pengajuan_edit->pic = $request->pic;
        $pengajuan_edit->metode = $request->metode;
        $pengajuan_edit->no_rekening = $request->no_rekening;
        $pengajuan_edit->nama_bank = $request->nama_bank;
        $pengajuan_edit->pemilik_rekening = $request->pemilik_rekening;
        $pengajuan_edit->sumber_dana = $request->sumber_dana;        

        $pengajuan_edit->save();        
        return redirect()->route('pengajuan_dana',$pengajuan_edit->proposal_id)->with('status', 'Data Ajuan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
