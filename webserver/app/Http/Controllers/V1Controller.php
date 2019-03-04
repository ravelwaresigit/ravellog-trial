<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\v1\read_logs_v1;

class V1Controller extends Controller
{
    public function showResult()
    {
        return view('v1.result');
    }
    public function getResult()
    {
    	$now = Carbon::now()->subSeconds(30)->toDateTimeString();
        $readkanban = read_logs_v1::where('created_at','>',$now)->get();
        $totalkanban = $readkanban->count();
        $lastupdate = read_logs_v1::where('created_at','>',$now)->orderBy('created_at','desc')->first();
        return view('v1.getresult',compact('readkanban','totalkanban','lastupdate'));
    }
}
