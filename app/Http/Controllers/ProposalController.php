<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use App\Models\Asnaf;
use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Kategori_Pogram;
use App\Models\Rincian_Pengajuan;
use App\Models\Pengajuan_dana;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_proposal;

    public function __construct()
    {

        $this->new_proposal= new Proposal();
        $this->middleware(function($request,$next){
            if(Gate::allows('proposal'))return $next($request);
            abort(403, "Anda tidak memiliki cukup hak akses"); 
         });
    }
    public function index(Request $request)
    {        
        
        $data = $this->new_proposal->getProposal();                   
        return view ("proposal.index",[
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
        $program = Kategori_Pogram::all();        
        $asnaf = Asnaf::all();        
        return view('proposal.create',compact('program','asnaf'));

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
            "kategori_ajuan" => "required",
            "kriteria_penerima" => "required",
            "kategori_program" => "required",
            "ket_program" => "required|min:15",
            "nama_pengaju"=> "required|min:5",
            "alamat" => "required|min:15",
            "no_kontak" => "required|min:8|max:20",
            "email" => "required|min:5|max:30|unique:proposal,email",
            // "asnaf"=>"required",
            // "jenis_program" => "required",
            // "bentuk_penyaluran" => "required",            
            "file_pendukung" => "required|max:2000|mimes:pdf"
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan format file pdf",            
            'size' => "ukuran :attribute minimal 5MB",
            'unique' => ":attribute telah digunakan, gunakan yang lain"
            
        ];

        $this->validate($request,$rules,$messages);

        // $this->new_proposal->no_ajuan = $request->no_ajuan . '/YBMPLN/UITJBT/III/2021';
        $last = $this->new_proposal->orderBy('created_at', 'desc')->first();
        if (is_null($last)) {
            $no = "001";
        }else {
            $ajuan = explode('/',$last->no_ajuan);
            $no = (int)$ajuan[0]+1;
            if ($no > 9 ) {
                $no = "0$no";
            }else {
                $no = "00$no";
            }
        }

        $this->new_proposal->no_ajuan = "$no/YBMPLN/UITJBT/". $this->getRomawi(date('m')) ."/".date('Y');
        $this->new_proposal->kategori_ajuan = $request->kategori_ajuan;
        $this->new_proposal->kriteria_penerima = $request->kriteria_penerima;
        $this->new_proposal->kategori_program_id = $request->kategori_program;
        $this->new_proposal->ket_program = $request->ket_program;
        $this->new_proposal->nama_pengaju = $request->nama_pengaju;
        $this->new_proposal->alamat = $request->alamat;
        $this->new_proposal->no_kontak = $request->no_kontak;
        $this->new_proposal->email = $request->email;
        $this->new_proposal->asnaf_id = $request->asnaf;
        $this->new_proposal->jenis_program = $request->jenis_program;
        $this->new_proposal->bentuk_penyaluran = $request->bentuk_penyaluran;
        $this->new_proposal->sosmed = $request->sosmed;        

        $file = $request->file_pendukung;                
        $simpan = time() . rand(100, 999) . "." .$file->getClientOriginalExtension();        
        $this->new_proposal->file_pendukung = $simpan;        
        $file->move(public_path() . '/file_pendukung', $simpan);
        $this->new_proposal->save();            
               
        return redirect()->route('proposal')->with('status', 'Proposal Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $proposal = Proposal::find($id);
        return view('proposal.detail.show',[
            'data' => $proposal
        ]);


        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposal_edit = Proposal::find($id);
        $program = Kategori_Pogram::all();        
        $asnaf = Asnaf::all();              
        return view('proposal.edit', [
            "data" => $proposal_edit
        ],compact('program','asnaf'));
    }

    public function read($id)
    {
        $proposal = $this->new_proposal->findOrFail($id);
        if ($proposal->notif == 0) {
            $proposal->notif = 1;
            $proposal->save();
        }
        return redirect()->route('proposal.detail',$id);
    }

    public function detail($id)
    {
        $rincian = Rincian_Pengajuan::where('proposal_id','=',$id);
        $pengajuan = Pengajuan_dana::where('proposal_id','=',$id);
        $history = History::where('proposal_id','=',$id);
        $proposal = $this->new_proposal->getProposal($id);        
        return view('proposal.detail.show', [
            "data" => $proposal,
            "rincian" => $rincian,
            "Pengajuan" => $pengajuan,
            "history" => $history
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
            "no_ajuan" => "required",
            "kategori_ajuan" => "required",
            "kriteria_penerima" => "required",
            "kategori_program" => "required",
            "ket_program" => "required|min:15",
            "nama_pengaju"=> "required|min:5",
            "alamat" => "required|min:13|max:200",
            "no_kontak" => "required|min:8|max:20",
            "email" => "required|min:5|max:30",
            "asnaf"=>"required",
            "jenis_program" => "required",
            "bentuk_penyaluran" => "required",
            "sosmed"=>"max:50",
            "file_pendukung" => "max:5000|mimes:pdf"
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong!",
            'min' => ":attribute karakter terlalu pendek",            
            'mimes' => ":attribute Ekstensi errors, silahkan gunakan format file pdf",            
            'size' => "ukuran :attribute minimal 5MB",
            'unique' => ":attribute telah digunakan"
            
        ];

        $this->validate($request,$rules,$messages);

        $proposal_edit = Proposal::find($id);
        $proposal_edit->no_ajuan = $request->no_ajuan;
        $proposal_edit->kategori_ajuan = $request->kategori_ajuan;
        $proposal_edit->kriteria_penerima = $request->kriteria_penerima;
        $proposal_edit->kategori_program_id = $request->kategori_program;
        $proposal_edit->ket_program = $request->ket_program;
        $proposal_edit->nama_pengaju = $request->nama_pengaju;
        $proposal_edit->alamat = $request->alamat;
        $proposal_edit->no_kontak = $request->no_kontak;
        $proposal_edit->email = $request->email;
        $proposal_edit->asnaf_id = $request->asnaf;
        $proposal_edit->jenis_program = $request->jenis_program;
        $proposal_edit->bentuk_penyaluran = $request->bentuk_penyaluran;
        $proposal_edit->sosmed = $request->sosmed;
        $proposal_edit->file_pendukung = $request->file_pendukung;                
        
        if ($request->file_pendukung) {                        
            $simpan = $request->file_pendukung;
            $namaFile = time() . rand(100, 999) . "." . $simpan->getClientOriginalExtension();
            $proposal_edit->file_pendukung = $namaFile;
            $simpan->move(public_path() . '/file_pendukung', $namaFile);            
        }
        
        $proposal_edit->save();        
        return redirect()->route('proposal')->with('status', 'Proposal berhasil diubah');
            

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposal_hapus = Proposal::findOrFail($id);        
        $file = "file_pendukung/" . $proposal_hapus->foto;        
        $proposal_hapus->delete();
        if (file::exists($file)) {
            file::delete($file);
        }    

        return redirect()->route('proposal')->with('status', 'Proposal Berhasil Di hapus');

    }

    public function changeStatus(Request $request, $id)
    {        
        $proposal = Proposal::findOrFail($id);
        $rincian = DB::table('rincian_pengajuan')->where('proposal_id','=',$id)->count();
        $ajuan = DB::table('pengajuan_dana')->where('proposal_id','=',$id)->count();
        if ($rincian == 0 || $ajuan == 0) {
            return redirect()->route('proposal.detail',$id)->with('error', 'Data masih Kurang lengkap!!');
        }
        $history = [
            'proposal_id' => $id,
            'title' => 'null',
            'keterangan' => $request->ket                        
        ];

        if ($request->status == 'DISETUJUI' || $request->status == null || $request->status == 'DITOLAK') {
            if ($proposal->status == 'SAVED'|| $proposal->status == 'REJECTED') {
                if ($proposal->kategori_ajuan == 'Darurat') {
                    $proposal->status = 'CONFIRMING2';
                    $history['title'] = ' Mengirim ke ketua';
                }else {
                    $proposal->status = 'CONFIRMING1';
                    $history['title'] = ' Mengirim ke Pengurus';
                }

            }elseif($proposal->status == 'CONFIRMING1') {
                $proposal->status = 'CONFIRMING2';
                if( $request->status == 'DITOLAK'){
                    $history['title'] = ' Mengirim ke Ketua (masih mempertimbangkan)';
                } else {
                    $history['title'] = ' Mengirim ke Ketua';
                }

            }elseif($proposal->status == 'CONFIRMING2') {
                if ($request->status == 'DISETUJUI') {
                    $proposal->status = 'APPROVED';
                    $history['title'] = ' Proposal Telah Tervalidasi';                    
                }elseif ($request->status == 'DITOLAK'){
                    $proposal->status = 'REJECTED';
                    $history['title'] = ' Proposal diTolak';                    
                }
            }
        }

        $history['created_by'] = Auth::user()->id;
        $proposal->notif = 0;
        try {
            $proposal->save();
            History::insert($history);
            return redirect()->route('proposal.detail',$id)->with('status', 'Pengajuan Proposal Berhasil Di Kirim');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function report($id)
    {
        $rincian = Rincian_Pengajuan::where('proposal_id','=',$id)->get();
        $ajuan = Pengajuan_dana::where('proposal_id','=',$id)->get();
        $pdf = new Mpdf(['format' => 'Legal']);
        $view = view('proposal.report',[
            'proposal' => $this->new_proposal->getProposal($id),
            'rincian' => $rincian,
            'ajuan'=>$ajuan
        ]);        
        $pdf->WriteHTML($view);
        $pdf->Output();
    }

    public function dashboard(){
        
        $proposal = Proposal::all();        
        $proposal_valid = Proposal::select(DB::raw("sum(CASE WHEN status = 'APPROVED' THEN 1 ELSE 0 END) as valid"))->first();
        $proposal_rejected = Proposal::select(DB::raw("sum(CASE WHEN status = 'REJECTED' THEN 1 ELSE 0 END) as rejected"))->first();
        $proposal_confirming = Proposal::select(DB::raw("sum(CASE WHEN status = 'CONFIRMING1' THEN 1 ELSE 0 END) as confirming"))->first();
        $proposal_confirming2 = Proposal::select(DB::raw("sum(CASE WHEN status = 'CONFIRMING2' THEN 1 ELSE 0 END) as confirming2"))->first();
        $total = Rincian_Pengajuan::select(DB::raw("sum(qty*nominal)  as total"))
        ->join('proposal','proposal.id','=','rincian_pengajuan.proposal_id')
        ->where('proposal.status','=','APPROVED')
        ->first();
        $kategori = Proposal::select(DB::raw('count(proposal.kategori_program_id) as jumlah'),'kategori_program.program')
        ->leftJoin('kategori_program','kategori_program.id','=','proposal.kategori_program_id')
        ->groupBy('kategori_program.id')
        ->get();

        

        return view ("dashboard",[
            'data' => $proposal,
            'proposal_valid' => $proposal_valid,
            'proposal_rejected' =>$proposal_rejected,
            'kategori' => $kategori,
            'proposal_confirming' => $proposal_confirming,
            'proposal_confirming2' => $proposal_confirming2,
            'total' => $total
        ]);
    }

    private function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }
 
}
