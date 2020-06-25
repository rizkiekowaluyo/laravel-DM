<?php

namespace App\Http\Controllers;

use App\Disaster;
use App\Geographic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;


class CorrelationController extends Controller
{
    //
    public function pearson()
    {
        # code...
        $dataDisaster = Disaster::all();
        $dataGeo = Geographic::all();

        foreach ($dataGeo as $row) {
            $datageo[]=[
                $row['kemiringanlereng'],
                $row['jenistanah'],
                $row['curahhujan'],            
            ];
        }
    
        foreach($dataDisaster as $row){
            $datadisaster[]=[
                $row['jumlahkejadian'],
                $row['jumlahkorban'],
                $row['jumlahkerusakan'],                
            ];            
        }
        //dd($datageo);
        $avgdatadisaster = Disaster::avgDataDisaster()->toArray();
        $avgdatageo = Geographic::avgDataDisaster()->toArray();
        //dd($avgdatadisaster);
        $resultsubtractDisaster = $this->subtractDisasterAvg($datadisaster,$avgdatadisaster);        
        $resultsubtractGeo = $this->subtractGeoAvg($datageo,$avgdatageo);
        $resultmultiDisasterGeo = $this->multisubDisasterGeo($resultsubtractDisaster,$resultsubtractGeo);
        $resultpowDisaster = $this->powResultMultiDisaster($resultsubtractDisaster);
        $resultpowGeo = $this->powResultMultiGeo($resultsubtractGeo);
        
        $resultMultiPow = $this->multiplyPowResult($resultpowDisaster,$resultpowGeo);
        $multiDstGeo = array_sum($resultmultiDisasterGeo);
        $resultpearson = $this->pearsonCorrelation($multiDstGeo,$resultMultiPow);
        //dd($resultsubtractGeo);
        return view('admin.correlationindex');
    }

    public function subtractDisasterAvg($datadisaster,$avgdatadisaster)
    {    
        //dd($datadisaster[0]);
        //dd($datadisaster[0][0]-$avgdatadisaster[0]->avgkejadian);
        $result = [];
        foreach ($datadisaster as $key => $value) {            
            $result[$key] = [
                $x1 = $datadisaster[$key][0]-$avgdatadisaster[0]->avgkejadian,
                $x2 = $datadisaster[$key][1]-$avgdatadisaster[0]->avgkorban,
                $x3 = $datadisaster[$key][2]-$avgdatadisaster[0]->avgkerusakan,
            ];            
            // dd($x2);                        
        }
        //dd($result);
        return $result;
    }

    public function subtractGeoAvg($datageo,$avgdatageo)
    {
        $result = [];
        foreach ($datageo as $key => $value) {            
            $result[$key] = [
                $y1 = $datageo[$key][0]-$avgdatageo[0]->avglereng,
                $y1 = $datageo[$key][1]-$avgdatageo[0]->avgtanah,
                $y1 = $datageo[$key][2]-$avgdatageo[0]->avghujan,                
            ];
        }        
        return $result;
    }

    public function multisubDisasterGeo($resultsubtractDisaster,$resultsubtractGeo)
    {        
        $resulttotal = [];             
        //dd($resultsubtractGeo);
        //dd(array_map($resultsubtractGeo[0]));        
        //(array_($resultsubtractDisaster[0],$resultsubtractGeo[0]));  
        for ($i=0; $i < count($resultsubtractDisaster); $i++) { 
            $resulttotal[] = (array_product($resultsubtractDisaster[$i]))*(array_product($resultsubtractGeo[$i]));
        }
        //dd($resulttotal);  
        return $resulttotal; 
    }

    public function powResultMultiDisaster($resultsubtractDisaster)
    {
        $result = [];
        //dd($resultsubtractDisaster);
        // for ($i=0; $i < count($resultsubtractDisaster) ; $i++) { 
        //     //dd($resultsubtractDisaster[$i]);
        //     for ($j=0; $j < count($resultsubtractDisaster[$i]); $j++) {                                 
        //         // dd($resultsubtractDisaster[$i][1]);
        //         $result[$i] =[
        //             $pwdisaster0 = pow($resultsubtractDisaster[$i][0],2),                    
        //             $pwdisaster1 = pow($resultsubtractDisaster[$i][1],2),                    
        //             $pwdisaster2 = pow($resultsubtractDisaster[$i][2],2),                    
        //         ];                
        //     }
        //     dd($result);
        // }
        foreach ($resultsubtractDisaster as $value) { 
            // dd($value);                   
            $result[] = [
                $pwdisaster1 = pow($value[0],2),
                $pwdisaster2 = pow($value[1],2),
                $pwdisaster3 = pow($value[2],2),                            
            ];
            //dd($result);            
        }   
        //dd($result); 
        // dd(array_sum(array_column($result,1)));                       
        return $result;
    }
    
    public function powResultMultiGeo($resultsubtractGeo)
    {
        $result = [];
        foreach ($resultsubtractGeo as $key => $value) {
            $result[] = [
                $pwgeo1 = pow($value[0],2),
                $pwgeo2 = pow($value[1],2),
                $pwgeo3 = pow($value[2],2),
            ];
        }
        //dd(array_sum(array_column($result,0)));
        return $result;
    }

    public function multiplyPowResult($resultpowDisaster,$resultpowGeo)
    {
        //dd($resultpowDisaster);
        //? MANUAL
        $rpDst1 = array_sum(array_column($resultpowDisaster,0));
        $rpDst2 = array_sum(array_column($resultpowDisaster,1));
        $rpDst3 = array_sum(array_column($resultpowDisaster,2));
        
        $rpGeo1 = array_sum(array_column($resultpowGeo,0));
        $rpGeo2 = array_sum(array_column($resultpowGeo,1));
        $rpGeo3 = array_sum(array_column($resultpowGeo,2));

        $result = $rpDst1*$rpDst2*$rpDst3*$rpGeo1*$rpGeo2*$rpGeo3;
        //?AUTO
        // for ($i=0; $i < count($resultpowDisaster); $i++) {                        
        //     $resultdst[] = array_sum(array_column($resultpowDisaster,$i));
        // }        
        
        //dd($resultdst);
        return $result;
    }

    public function pearsonCorrelation($multiDstGeo,$resultMultiPow)
    {
        //dd($resultMultiPow);
        $result = $multiDstGeo/sqrt($resultMultiPow);
        // dd($result);
        return $result;
    }
}
