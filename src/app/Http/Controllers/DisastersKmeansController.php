<?php

namespace App\Http\Controllers;

use App\Disaster;
use Illuminate\Http\Request;
use DB;

class DisastersKmeansController extends Controller
{    

    public function kmeans(){

        //$data = DB::table('disasters')->whereIn('id',$request->id)->get();
        

        // $data = Disaster::all();
        error_log($data);
        //dd($data);
    }

    public function distance(){
        $dataDisasters = Disaster::listData();
        //dd($dataDisasters);

        foreach ($dataDisasters as $disaster) {
            $hc1_temp = sqrt(pow(($disaster->jumlahkejadian-45),2)+pow(($disaster->jumlahkorban-230),2)+pow(($disaster->jumlahkerusakan-94),2));
            $hc2_temp = sqrt(pow(($disaster->jumlahkejadian-7),2)+pow(($disaster->jumlahkorban-23),2)+pow(($disaster->jumlahkerusakan-10),2));
            $hc3_temp = sqrt(pow(($disaster->jumlahkejadian-16),2)+pow(($disaster->jumlahkorban-35),2)+pow(($disaster->jumlahkerusakan-28),2));
            //dd($hc1_temp);            
        }

        //$hc1 = sqrt($hc1_temp);
        // $hc2 = sqrt($hc2_temp);
        dd($hc3_temp);

        
    }

    public function centroid(){
        $c1a = 45;
        $c1b = 230;
        $c1c = 94;
        
        $c2a = 7;
        $c2b = 23;
        $c2c = 10;
        
        $c3a = 16;
        $c3b = 35;
        $c3c = 28;
    }
}
