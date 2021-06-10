<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengajuan_dana;
use App\Models\Rincian_Pengajuan;
use App\Models\Proposal;

class Rincian_pengajuanController extends Controller
{
    public $new_pengajuan;
    public $new_rincian;
    public $new_proposal;

    public function __construct()
    {
        $this->new_pengajuan = new Pengajuan_dana();
        $this->new_rincian = new Rincian_Pengajuan();
        $this->new_proposal = new Proposal();

    }

    public function index($id)
    {
        $rincian = Rincian_Pengajuan::where('proposal_id','=',$id)->get();
        $proposal = $this->new_proposal->getProposal($id);
        // dd($rincian);                                        
        return view ("proposal.detail.rincian_pengajuan.rincian_pengajuan",[
            'rincian' => $rincian,
            'data' => $proposal,
            // 'ajuan' => $pengajuan
            ]);
    }

    public function create($id)
    {
        
        $proposal = $this->new_proposal->getProposal($id);        
        return view('proposal.detail.rincian_pengajuan.tambah_rincian',[
            'data' => $proposal,
        ]);
    }

    public function store(Request $request)
    {        
        $rules = [
            "uraian" => "required|min:7|max:100",
            "qty" => "required",
            "nominal" => "required",            
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan format file pdf",            
            'size' => "ukuran :attribute minimal 5MB",
            'unique' => ":attribute telah digunakan"
            
        ];

        $this->new_rincian->proposal_id = $request->proposal_id;        
        $this->new_rincian->uraian = $request->uraian;
        $this->new_rincian->qty = $request->qty;        
        $this->new_rincian->nominal = $request->nominal;
        // $this->new_rincian->total = $request->total;
        
        $this->new_rincian->save();

        return redirect()->route('rincian_pengajuan',$request->proposal_id)->with('status', 'Rincian dana Successfully created');


    }

    public function edit($id)
    {        
        $rincian_edit = Rincian_Pengajuan::find($id);        
        return view('proposal.detail.rincian_pengajuan.edit_rincian', [
            "data" => $rincian_edit

        ]);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            "uraian" => "required|min:8|max:100",
            "qty" => "required",
            "nominal" => "required|max:200",                            
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan format file pdf",            
            'size' => "ukuran :attribute minimal 5MB",
            'unique' => ":attribute telah digunakan"
            
        ];

        $this->validate($request,$rules,$messages);


        $rincian_edit = Rincian_Pengajuan::find($id);        
        $rincian_edit->uraian = $request->uraian;
        $rincian_edit->qty = $request->qty;
        $rincian_edit->nominal = $request->nominal;        
        
        $rincian_edit->save();        
        return redirect()->route('rincian_pengajuan',$rincian_edit->proposal_id)->with('status', 'Data Rincian Dana berhasil diubah');
    }

    public function destroy($id)
    {
        $proposal_hapus = Rincian_Pengajuan::findOrFail($id);                
        $proposal_hapus->delete();    

        return redirect()->route('rincian_pengajuan',$proposal_hapus->proposal_id)->with('status', 'Rincian Berhasil Di hapus');

    }

}
