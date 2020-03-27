<?php

namespace App\Http\Controllers;

use App\Disaster;
use Illuminate\Http\Request;
use DB;

class DisastersKmeansController extends Controller
{    

    public function kmeans(){ 
        //init var data array       
        $earlydata = [];

        $dataDisasters = Disaster::all();
        //dd($dataDisasters);
        //looping change from collection array
        foreach($dataDisasters as $row){
            $earlydata[]=$row;
            $name[] = $row['namawilayah'];
        }
        //dd($earlydata);
        $earlydata = [];
        //looping change array to row(indexing)
        foreach($dataDisasters as $row){
            $earlydata[]=[
                $row['jumlahkejadian'],
                $row['jumlahkorban'],
                $row['jumlahkerusakan'],
                $row['namawilayah'],
            ];            
        }
        dd($earlydata);
        //variabel call method earlyCentroid
        $centroid_awal =$this->earlyCentroid($earlydata,3);
        //dd($centroid_awal);
        $data['earlydata'] = $earlydata;
        $data['centroid_awal'] = $centroid_awal;
        
        // $literasi = $this->distance($earlydata,$centroid_awal);
        // dd($literasi);
        // $data['literasi'] = $literasi;
        
        $hasil_iterasi=[];
        $hasil_cluster=[];
        $itr=0;
        while (true) {
            $iterasi = array();
            foreach ($earlydata as $key => $valuedata) {
                $iterasi[$key]['earlydata']=$valuedata;
                foreach ($centroid_awal as $key => $valuecentroid) {
                    //dd($valuecentroid);
                    $iterasi[$key]['centroid_awal'][]=$this->distance($valuedata,$valuecentroid);
                }
                $iterasi[$key]['jarak_terdekat']=$this->nearDistance($iterasi[$key]['centroid_awal'],$centroid_awal);
            }
            array_push($hasil_iterasi, $iterasi);        
            dd($hasil_iterasi, $iterasi , $hasil_cluster);
            $centroid[++$itr]=$this->newCentroid($iterasi,$hasil_cluster);
            //dd($centroid);
            $lanjutkan=$this->centroidChange($centroid,$itr);
            $boolval = boolval($lanjutkan) ? 'ya' : 'tidak';
            if(!$lanjutkan)
            break;
        }
        dd(end($hasil_iterasi));
    }

    public function earlyCentroid($data,$centroid){
        $randCentroid = [];
        for ($i=0; $i < $centroid; $i++) { 
            # code...            
            $temp = rand(0,(count($data)-1)); 
            $randCentroid[] = $data[$temp];                           
        }
        return $randCentroid;
    }

    public function distance($data = array(),$centroid = array()){        
        $resultDistance = sqrt(pow(($data->{'jumlahkejadian'}-$centroid->{'jumlahkejadian'}),2)+pow(($data->{'jumlahkorban'}-$centroid->{'jumlahkorban'}),2)+pow(($data->{'jumlahkerusakan'}-$centroid->{'jumlahkerusakan'}),2));     
        // $resultDistance = [];
        // foreach ($data as $key => $value) {
        //     foreach ($centroid as $key1 => $cnt) {
        //         $resultDistance[$key][] = sqrt(pow(($value['2']-$cnt['2']),2)+pow(($value['3']-$cnt['3']),2)+pow(($value['4']-$cnt['4']),2));
        //     }            
        // }
        return $resultDistance;        
    }

    public function nearDistance($jarak_ke_centroid=array(),$centroid){
        foreach ($jarak_ke_centroid as $key => $value) {
            if(!isset($minimum)){
                $minimum=$value;
               
                $cluster=($key+1);
                continue;
            }
            else if($value<$minimum){
                $minimum=$value;
                $cluster=($key+1);
            }
        }
        return array(
            'cluster'=>$cluster,
            'value'=>$minimum,
        );
    }    

    public function newCentroid($iterasi,$hasil_cluster){
        $hasil_cluster = [];
        foreach ($iterasi as $key => $value) {
            //dd($value);
            $hasil_cluster[($value['earlydata']['centroid_awal']-1)][0][]= $value['data'][0];
            $hasil_cluster[($value['earlydata']['centroid_awal']-1)][1][]= $value['data'][1];
            $hasil_cluster[($value['earlydata']['centroid_awal']-1)][2][]= $value['data'][2];        
        }
        //dd($hasil_cluster);    
        $new_centroid = [];

        foreach ($hasil_cluster as $key => $value) {
            # code...
            $new_centroid[$key] = [
                array_sum($value[0])/count($value[0]),
                array_sum($value[1])/count($value[1]),
                array_sum($value[2])/count($value[2]),
            ];
        }
        //dd($new_centroid);
    }

    public function centroidChange($centroid,$itr){
        $centroid_lama = $this->flatten_array($centroid[($itr-1)]); //flattern array
        //dd($centroid_lama);
        $centroid_baru = $this->flatten_array($centroid[$itr]); //flatten array
        //dd($centroid_baru);
        //hitbandingkan centroid yang lama dan baru jika berubah return true, jika tidak berubah/jumlah sama=0 return false
        $jumlah_sama=0;
        for($i=0;$i<count($centroid_lama);$i++){
            if($centroid_lama[$i]===$centroid_baru[$i]){
                $jumlah_sama++;
            }
        }
        dd($jumlah_sama);
        return $jumlah_sama===count($centroid_lama) ? false : true; 
    }
}
