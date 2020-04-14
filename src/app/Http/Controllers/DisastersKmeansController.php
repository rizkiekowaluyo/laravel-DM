<?php

namespace App\Http\Controllers;

use App\Disaster;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;

class DisastersKmeansController extends Controller
{    

    public function kmeans(){ 
        //init var data array       
        $data = [];
        $name = [];

        $dataDisasters = Disaster::all();
        //dd($dataDisasters);
        //looping change from collection array
        foreach($dataDisasters as $row){
            $data[]=$row;
            $name[] = $row['namawilayah'];
        }
        //dd($name);
        //dd($earlydata);
        $data = [];
        //looping change array to row(indexing)
        foreach($dataDisasters as $row){
            $data[]=[
                $row['jumlahkejadian'],
                $row['jumlahkorban'],
                $row['jumlahkerusakan'],
                $row['namawilayah'],
            ];            
        }
        //dd($earlydata);

        //cluster yang dibentuk
        $cluster = 3;
        //variabel call method earlyCentroid
        $centroid=$this->earlyCentroid($data,$cluster);
        //dd($centroid[0]);                
        
        $hasil_iterasi=[];
        $hasil_cluster=[];
        $itr=0;
        //dd($earlydata);
        while (true) {
            $iterasi = array();
            foreach ($data as $key => $valuedata) {
                $iterasi[$key]['data']=$valuedata;
                //dd($valuedata);
                foreach ($centroid[$itr] as $key_centroid => $valuecentroid) {
                    //dd($valuecentroid);
                    $iterasi[$key]['jarak_ke_centroid'][]=$this->distance($valuedata,$valuecentroid);
                }
                $iterasi[$key]['jarak_terdekat']=$this->nearDistance($iterasi[$key]['jarak_ke_centroid'],$centroid);
            }
            array_push($hasil_iterasi, $iterasi);        
            //dd($hasil_iterasi, $iterasi , $hasil_cluster);
            $centroid[++$itr]=$this->newCentroid($iterasi,$hasil_cluster);
            //dd($centroid[$itr]);
            $lanjutkan=$this->centroidChange($centroid,$itr);
            $boolval = boolval($lanjutkan) ? 'ya' : 'tidak';        
            if(!$lanjutkan)
            break;
        }
        $result_iterasi = last($hasil_iterasi);
        Disaster::deleteHelper();
        foreach ($result_iterasi as $key => $value) {
            # code...
            $dcentroid1 = $value["jarak_ke_centroid"][0];
            $dcentroid2 = $value["jarak_ke_centroid"][1];
            $dcentroid3 = $value["jarak_ke_centroid"][2];
            $clusterall = $value["jarak_terdekat"]["cluster"];
            Disaster::saveHelper($dcentroid1, $dcentroid2, $dcentroid3,$clusterall);
        }
        // dd(end($hasil_iterasi));
        
        return view('admin.disasterkmeans',compact('cluster','centroid','data','valuedata','valuecentroid','hasil_iterasi','name'));
    }

    public function earlyCentroid($data,$cluster){
        $randCentroid = [];
        for ($i=0; $i < $cluster; $i++) { 
            # code...
            $temp=[2,12,23];
            while(in_array($randCentroid, [$temp])){
                $temp=rand(0,(count($data)-1));
            }                        
            $centroid[0][] = [
                $data[$temp[$i]][0],
                $data[$temp[$i]][1],
                $data[$temp[$i]][2],
            ];                           
        }
        return $centroid;
    }

    public function distance($data = array(),$centroid = array()){        
        $resultDistance = sqrt(pow(($data[0]-$centroid[0]),2)+pow(($data[1]-$centroid[1]),2)+pow(($data[2]-$centroid[2]),2));             
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
        //looping untuk mengelompokan sesuai cluster
        foreach ($iterasi as $key => $value) {
            //dd($value);
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][0][]= $value['data'][0];
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][1][]= $value['data'][1];
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][2][]= $value['data'][2];        
        }
        //dd($hasil_cluster);    
        $new_centroid = [];
        //looping untuk mencari nilai centroid baru dengan cara mencari rata2 dari masing2 data
        foreach ($hasil_cluster as $key => $value) {
            # code...
            $new_centroid[$key] = [
                array_sum($value[0])/count($value[0]),
                array_sum($value[1])/count($value[1]),
                array_sum($value[2])/count($value[2]),
            ];
        }
        //dd($new_centroid);
        ksort($new_centroid);
        return $new_centroid;
    }

    public function centroidChange($centroid,$itr){
        $centroid_lama = $this->flatten_array($centroid[($itr-1)]); //flattern array
        //dd($centroid_lama);
        $centroid_baru = $this->flatten_array($centroid[$itr]); //flatten array
        //dd($centroid[$itr]);
        // membandingkan centroid yang lama dan baru jika berubah return true, jika tidak berubah/jumlah sama=0 return false
        $jumlah_sama=0;
        for($i=0;$i<count($centroid_lama);$i++){
            if($centroid_lama[$i]===$centroid_baru[$i]){
                $jumlah_sama++;
            }
        }
        //dd($jumlah_sama);
        return $jumlah_sama===count($centroid_lama) ? false : true; 
    }

    function flatten_array($arg) {
        //dd($arg);
        return is_array($arg) ? array_reduce($arg, function ($c, $a) { 
            return array_merge($c, Arr::flatten($a)); },[]) : [$arg];
    }
    
    //TODO1 : Fungsi Sum Square Within (SSW)
    //TODO2 : Fungsi Sum Square Within (SSB)
    //TODO3 : Fungsi Ratio(Output DBI) (%)
    
}
