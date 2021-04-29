<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;



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
    }
    public function index(Request $request)
    {
        // $proposal = $request->id;             
        $data = Proposal::all();
        
        // dd($data);
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
        return view('proposal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->new_proposal->no_ajuan = $request->no_ajuan;
        $this->new_proposal->kategori_ajuan = $request->kategori_ajuan;
        $this->new_proposal->kriteria_penerima = $request->kriteria_penerima;
        $this->new_proposal->kategori_program = $request->kategori_program;
        $this->new_proposal->ket_program = $request->ket_program;
        $this->new_proposal->nama_pengaju = $request->nama_pengaju;
        $this->new_proposal->alamat = $request->alamat;
        $this->new_proposal->no_kontak = $request->no_kontak;
        $this->new_proposal->email = $request->email;
        $this->new_proposal->asnaf = $request->asnaf;
        $this->new_proposal->jenis_program = $request->jenis_program;
        $this->new_proposal->bentuk_penyaluran = $request->bentuk_penyaluran;
        $this->new_proposal->sosmed = $request->sosmed;
        $this->new_proposal->file_pendukung = $request->file_pendukung;
        $this->new_proposal->save();

        // $nm = $request->foto;
        // $ttd = $request->tandatangan;
        // $fotopp = time() . rand(100, 999) . "." .$nm->getClientOriginalExtension();
        // $fotottd = time() . rand(100, 999) . "." .$ttd->getClientOriginalExtension();
        // $this->new_user->foto = $fotopp;
        // $this->new_user->tandatangan = $fotottd;
        // $nm->move(public_path() . '/image', $fotopp);
        // $ttd->move(public_path() . '/image/tandatangan', $fotottd);
               
        return redirect()->route('proposal')->with('status', 'Proposal Successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $proposal_show = Proposal::find($_GET['id']);
        echo json_encode($proposal_show);
        
        // $user_detail = User::find($_GET['id']);
        // echo json_encode($user_detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
