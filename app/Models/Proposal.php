<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\at;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposal';

    public function getProposal($id = null)
    {
        $query = $this->join('kategori_program', 'kategori_program.id', '=', 'proposal.kategori_program_id')
                    ->join('asnaf', 'asnaf.id', '=', 'proposal.asnaf_id')             
                    ->select('proposal.*','proposal.id as proposal_id', 'kategori_program.program', 'asnaf.asnaf');
        $roles = json_decode(Auth::user()->role);

        if (isset($_GET['status'])) {
            if (strtoupper($_GET['status']) == 'PROSES') {
                $query->whereIn('status',['CONFIRMING1','CONFIRMING2']);
            }else {
                $query->where('status','=',strtoupper($_GET['status']));
            }
        }

        if(!(in_array('AMIL',$roles) || in_array('ADMIN',$roles))){
            $query->where('proposal.status','!=','SAVED');
        } 
        if (is_null($id)) {
            return $query->get();
        }else {
            return $query->find($id);
        }
    }

    public static function notif(){
        $query = parent::select('no_ajuan','nama_pengaju','status','id');
        $role = json_decode(Auth::user()->role);
        if (in_array("PENGURUS",$role)) {
            $query->where('status','CONFIRMING1');
        }elseif (in_array("KETUA",$role)) {
            $query->where('status','CONFIRMING2');
        }elseif(in_array("AMIL",$role)) {
            $query->whereIn('status',['APPROVED','REJECTED']);
        }else {            
            return [];
        }
        $query->where('notif','=','0');
        return $query->get();
    }

}
    