<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\v1\read_logs_v1;
use App\v1\trial_v1;
use Excel;
use DB;

class V1Controller extends Controller
{
    public function showResult(){
        $trial_v1 = trial_v1::where('id','1')->first();
        $idtrial = $trial_v1->trial_number;
        return view('v1.result',compact('idtrial'));
    }

    public function getResult(){
    	$now = Carbon::now()->subSeconds(30)->toDateTimeString();
        $readkanban = read_logs_v1::where('created_at','>',$now)->get();
        $totalkanban = $readkanban->where('epc','!=','sensor')->count();
        $lastupdate = read_logs_v1::where('created_at','>',$now)->orderBy('created_at','desc')->first();
        return view('v1.getresult',compact('readkanban','totalkanban','lastupdate'));
    }

    public function setTrialNumber(){
        //get last trial number
        $trial_v1 = trial_v1::where('id',1)->first();
        $lastnumber = $trial_v1->trial_number;
        $newnumber = $lastnumber+1;
        //set new trial number
        trial_v1::where('id',1)->update([
            'trial_number' => $newnumber
        ]);
        return $newnumber;
    }

    public function downloadLogV1(Request $request){
        $idtrial = $request->idtrial;
        $file_name = 'Log Trial Sequence '.$idtrial;

        $logs = DB::table('read_logs_v1')->where('trial_number',$idtrial)->orderBy('created_at','asc')->get();
        $log_trial[] = array('SEQUENCE_TRIAL','DATA', 'DATE TIME');

        foreach($logs as $log)
        {
            $log_trial[] = array(
                'SEQUENCE_TRIAL' => $log->trial_number,
                'DATA' => $log->epc,
                'DATE TIME' => $log->created_at
            );
        }         

        Excel::create($file_name, function($excel) use ($log_trial){
            //$excel->setTitle('Supplier Logs');
            $excel->sheet('Log Trial', function($sheet) use ($log_trial){
                $sheet->fromArray($log_trial, null, 'A1', false, false);
            });
        })->download('xlsx');        
    }
}
