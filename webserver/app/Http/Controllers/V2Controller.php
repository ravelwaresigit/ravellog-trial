<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\v2\matrix;
use App\v2\tag_v2;
use App\v2\read_logs_v2;
use Session;
use Illuminate\Support\Facades\Input;
use DB;

class V2Controller extends Controller
{
    public function setMatrix()
    {
    	$matrixset = matrix::where('id','1')->first();
        return view('v2.setmatrix',compact('matrixset'));
    }
    public function storeMatrix(Request $request)
    {
    	matrix::where('id','1')->update([
    			'x' => $request->x,
    			'y' => $request->y,
    			'z' => $request->z
    	]);
        // dd($readkanban);
        // $data = [
        //     'matrix' => $matrixset,
        //     'readkanban' => $readkanban
        // ];
    	Session::flash('message', 'Susunan kanban berhasil diatur');
        return redirect('/v2/setkanban');
    }

    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }

        return $data;
    }

    public function updateMatrix(Request $request)
    {
        $file = Input::file('asset');
        $name = $file->getClientOriginalName();

        if($file->move(public_path('uploads'), $name)) {        
            $this->importCsvMatrix($name);
            // $notification = array('title'=> 'Success!','msg'=>'New asset successfull added!','alert-type'=>'success');
            return redirect()->back();
        }
    }

    function ImportCsvMatrix($filename)
    {
        $file = public_path('uploads/'.$filename);
        $matrixArr = $this->csvToArray($file);
        $tag_v2 = tag_v2::all();

        for ($i = 0; $i < count($matrixArr); $i ++)
        {
            $index_matrix = $matrixArr[$i];
            $x = $index_matrix['x'];
            $y = $index_matrix['y'];
            $z = $index_matrix['z'];
            // dd($x,$y,$z);
            if(count($tag_v2)!=0){
                tag_v2::truncate();
                tag_v2::create([
                    'x' => $x,
                    'y' => $y,
                    'z' => $z
                ]);
            }
            else{
                tag_v2::create([
                    'x' => $x,
                    'y' => $y,
                    'z' => $z
                ]);
            }

        } 
    }
    public function Matrix(){
        return view('v2.creatematrix');
    }
    public function createMatrix(Request $request){
        $x = $request->x;
        $y = $request->y;
        $z = $request->z;

        if($x > 0 & $y > 0 & $z > 0){
            $notification = array('title'=> 'Pembuatan Matrix Berhasil!','msg'=>'Data Matrix berhasil disimpan!','alert-type'=>'success');
            tag_v2::truncate();
            for ($i=1; $i <= $z; $i++) { 
                for ($j=1; $j <= $y; $j++) { 
                    for ($k=1; $k <= $x; $k++) { 
                        tag_v2::create([
                            'x' => $k,
                            'y' => $j,
                            'z' => $i
                        ]);
                    }
                }
            };
        }else{
            $notification = array('title'=> 'Gagal!','msg'=>'Nilai x, y, atau z tidak boleh kurang dari 0 atau kosong','alert-type'=>'error');
        };
        return redirect()->back()->with($notification);
    }
    public function getMatrix()
    {
        $matrixset = matrix::where('id','1')->first();
        $matrix = tag_v2::where([['x', '<=', $matrixset->x],['y', '<=', $matrixset->y],['z', '<=', $matrixset->z]])->get();
        return view('v2.getmatrix');
    }

    public function setKanban()
    {
        $matrixset = matrix::where('id', 1)->first();
        $readkanban = tag_v2::where('z','<=',$matrixset->z)->where('y','<=',$matrixset->y)->where('x','<=',$matrixset->x)->orderBy('z','asc')->orderBy('y','asc')->orderBy('x','asc')->get();
        return view('v2.setkanban',['matrix'=>$matrixset, 'readkanbans'=>$readkanban]);
    }
    public function showResult()
    {
        $matrixset = matrix::where('id','1')->first();
        $idtrial = $matrixset->trial_number;
        return view('v2.result',compact('idtrial'));
    }
    public function getResult()
    {
        //tampilin trial bisa filte rbay waktu atau by id_trial
        $matrixset = matrix::where('id','1')->first();
        $readkanban = tag_v2::where('z','<=',$matrixset->z)->where('y','<=',$matrixset->y)->where('x','<=',$matrixset->x)->orderBy('z','asc')->orderBy('y','asc')->orderBy('x','asc')->get();
        $totalkanbanterbaca = tag_v2::where('z','<=',$matrixset->z)->where('y','<=',$matrixset->y)->where('x','<=',$matrixset->x)->whereNotNull('epc')->where('status',1)->count();
        $totalkanbandipakai = tag_v2::where('z','<=',$matrixset->z)->where('y','<=',$matrixset->y)->where('x','<=',$matrixset->x)->whereNotNull('epc')->count();
        $lastupdate = read_logs_v2::whereRaw('id = (select max(`id`) from read_logs_v2)')->first();
        return view('v2.getresult',compact('readkanban','totalkanbanterbaca','totalkanbandipakai','matrixset','lastupdate'));
    }
    public function clearResult()
    {
        tag_v2::where('status',1)->update([
            'status' => null
        ]);
        return 'OK';
    }
    public function setTrialNumber()
    {
        //get last trial number
        $matrixset = matrix::where('id','1')->first();
        $lastnumber = $matrixset->trial_number;
        $newnumber = $lastnumber+1;
        //set new trial number
        matrix::where('id',1)->update([
            'trial_number' => $newnumber
        ]);
        return $newnumber;
    }

    public function storeKanban(Request $request){
        $matrix = matrix::where('id',1)->first();
        //dd($request->all());
        
        for($a=1; $a<=$matrix->z; $a++){
            for($b=1; $b<=$matrix->y; $b++){
                for($c=1; $c<=$matrix->x; $c++){
                    tag_v2::where([['x',$c],['y',$b],['z',$a]])->update([
                        'epc' => $request['kanban'.$c.$b.$a]
                    ]);
                }
            }
        };
        return redirect('/v2/result');
    }
    public function checkDuplicateKanban(Request $request){
        $kanban = $request->kanban;
        $x = $request->x;
        $y = $request->y;
        $z = $request->z;
        $matrix_terpilih = tag_v2::where('epc', $kanban)->first();
        $matrix = tag_v2::where([['x', $x],['y',$y],['z',$z]])->first();
        // $savedkanban = tag_v2::whereNotNull('epc')->pluck('epc')->toArray();
        $savedkanbans = tag_v2::whereNotIn('id', [$matrix->id])->get();
        foreach ($savedkanbans as $savedkanbanss) {
            $savedkanban[] = $savedkanbanss->epc;
        }

        if($kanban != null or $kanban != ''){
            //jika bukan kanban kosong, check apakah duplicate
            if(in_array($kanban,$savedkanban)){
                return ['epc sudah dipakai', $matrix_terpilih->x, $matrix_terpilih->y, $matrix_terpilih->z, $kanban];
            }else{
                return ['epc tersedia'];
            };
        }else{
            return ['epc kosong'];
        };
    }
    public function resetKanban(){
        tag_v2::whereNotNull('epc')->update(['epc' => null]);
        $notification = array('title'=> 'Reset Berhasil!','msg'=>'Data Kanban berhasil direset!','alert-type'=>'success');
        return redirect()->back()->with($notification);
    }
}
