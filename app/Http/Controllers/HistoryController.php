<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\History;


class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $new_proposal;
    public $new_history;

    public function __construct()
    {        
        $this->new_proposal = new Proposal();
        $this->new_history = new History();
    }

    public function index($id)
    {
        $proposal = $this->new_proposal->getProposal($id);        
        // $rincian = Rincian_Pengajuan::where('proposal_id','=',$id)->get();

        $history = History::select('histori.*','users.name')
        ->where('proposal_id','=',$id)
        ->join('users','users.id','=','histori.created_by')->get();
        // dd($history);

        return view ("proposal.detail.history.history",[
            'data' => $proposal,
            'show' => $history,             
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->new_history->keterangan = $request->keterangan;        
        $this->new_pengajuan->save();

        return redirect()->route('proposal.detail',$request->proposal_id)->with('status', 'Proposal Successfully created');

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
