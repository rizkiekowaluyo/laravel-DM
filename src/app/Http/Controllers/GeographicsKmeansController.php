<?php

namespace App\Http\Controllers;

use App\Geographic;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;

class GeographicsKmeansController extends Controller
{
    public function kmeans(){
        $data = [];
        $name = [];   

        $dataGeographic = Geographic::all();
        foreach($dataGeographic as $row){
            $data[] = $row;
            $name[] = $row['namawilayah'];
        }
        // dd($name);
        $data = [];
        foreach($dataGeographic as $row){
            $data[]=[
                $row['kemiringanlereng'],
                $row['jenistanah'],
                $row['curahhujan'],
                $row['tegal'],
                $row['huma'],
                $row['sementaratidakdiusahakan'],
                $row['namawilayah'],
            ];            
        }                
        $cluster = 3;
        $centroid = $this->earlyCentroidGeo($data,$cluster);
        //dd($centroid);
        $hasil_iterasi=[];
        $hasil_cluster=[];
        $itr=0;

        while(true){
            $iterasi = array();
            foreach ($data as $key => $valuedata) { 
                // dd($valuedata);
                $iterasi[$key]['data']=$valuedata;                
                foreach ($centroid[$itr] as $keycentroid => $valuecentroid) {
                    //dd($valuecentroid);
                    $iterasi[$key]['jarak_centroid'][]=$this->distance($valuedata,$valuecentroid);
                    //dd($iterasi);
                }
                $iterasi[$key]['jarak_terdekat']=$this->nearDistance($iterasi[$key]['jarak_centroid'],$centroid);
                //dd($iterasi);
            }
            array_push($hasil_iterasi, $iterasi);
            $centroid[++$itr]=$this->newCentroid($iterasi,$hasil_cluster);
            //dd($centroid);          
            $lanjutkan=$this->centroidChange($centroid,$itr);
            //dd($centroid);
            $boolval = boolval($lanjutkan) ? 'ya' : 'tidak';        
            if(!$lanjutkan)
            break;
        }

        $result_centroid = last($centroid);        
        $result_iterasi = last($hasil_iterasi); 
        // dd($result_iterasi);       
        Geographic::deleteHelper();

        foreach ($result_iterasi as $key => $value) {        
            $dcentroid1 = $value["jarak_centroid"][0];
            $dcentroid2 = $value["jarak_centroid"][1];
            $dcentroid3 = $value["jarak_centroid"][2];
            $mindistance = $value["jarak_terdekat"]["value"];
            $clusterall = $value["jarak_terdekat"]["cluster"];        
            Geographic::saveHelper($dcentroid1, $dcentroid2, $dcentroid3,$mindistance,$clusterall);
        }

        //------------------------DAVIES BOULDIN INDEX------------------        
        $rs = Geographic::groupClusterHelper()->toArray();                        
        $ssw = $this->sumsquareWithin($rs);        
        $ssb = $this->sumsquareBetween($result_centroid);
        $ratio = $this->ratioDBI($ssw,$ssb);
        //dd($ratio);

        //------------------------PURITY--------------------------
        $puritygeocluster = Geographic::groupingSameValueCluster()->groupBy('cluster')->toArray();
        //dd($puritygeocluster);    
        $puritygeo = $this->purity($puritygeocluster,$data);
        //dd($puritygeo);
        return view('admin.geokmeans',compact('cluster','centroid','data','valuedata','valuecentroid','hasil_iterasi','name','ratio','puritygeo'));

    }

    public function earlyCentroidGeo($data,$cluster){
        //dd($data);
        $randCentroid = [];
        for ($i=0; $i < $cluster; $i++) {             
            $temp=[2,12,23];
            while(in_array($randCentroid, [$temp])){
                $temp=rand(0,(count($data)-1));
            }                        
            $centroid[0][] = [
                $data[$temp[$i]][0],
                $data[$temp[$i]][1],
                $data[$temp[$i]][2],
                $data[$temp[$i]][3],
                $data[$temp[$i]][4],
                $data[$temp[$i]][5],
            ];                           
        }
        return $centroid;
        
    }

    public function distance($data = array(),$centroid = array()){
        $resultDistance = sqrt(pow(($data[0]-$centroid[0]),2)+pow(($data[1]-$centroid[1]),2)+pow(($data[2]-$centroid[2]),2)+pow(($data[3]-$centroid[3]),2)+pow(($data[4]-$centroid[4]),2)+pow(($data[5]-$centroid[5]),2));
        // dd($resultDistance);             
        return $resultDistance;
    }

    public function nearDistance($jarak_centroid=array(),$centroid){
        foreach ($jarak_centroid as $key => $value) {
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
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][0][]= $value['data'][0];
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][1][]= $value['data'][1];
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][2][]= $value['data'][2];        
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][3][]= $value['data'][3];        
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][4][]= $value['data'][4];        
            $hasil_cluster[($value['jarak_terdekat']['cluster']-1)][5][]= $value['data'][5];        
        }        
        $new_centroid = [];        
        foreach ($hasil_cluster as $key => $value) {            
            $new_centroid[$key] = [
                array_sum($value[0])/count($value[0]),
                array_sum($value[1])/count($value[1]),
                array_sum($value[2])/count($value[2]),
                array_sum($value[3])/count($value[3]),
                array_sum($value[4])/count($value[4]),
                array_sum($value[5])/count($value[5]),
            ];
        }        
        ksort($new_centroid);
        return $new_centroid;
    }

    public function centroidChange($centroid,$itr){        
        $centroid_lama = $this->flatten_array($centroid[($itr-1)]); //flattern array 
        //dd($centroid_lama);       
        $centroid_baru = $this->flatten_array($centroid[$itr]); //flatten array
        //dd($centroid_baru);
        $jumlah_sama=0;
        for($i=0;$i<count($centroid_lama);$i++){
            if($centroid_lama[$i]===$centroid_baru[$i]){
                $jumlah_sama++;
            }
        }        
        return $jumlah_sama===count($centroid_lama) ? false : true; 
    }

    public function flatten_array($arg){
        return is_array($arg) ? array_reduce($arg, function ($c, $a) { 
            return array_merge($c, Arr::flatten($a)); },[]) : [$arg];
    }

    public function sumsquareWithin($rs){  
        //dd($rs);            
        $result = 0;
        for ($iterate=0; $iterate < count($rs) ; $iterate++) { 
            $result += $rs[$iterate]->average;
        }
        //dd($result);        
        return $result;
    }

    public function sumsquareBetween($result_centroid){        
        $resultc1c2 = sqrt(pow(($result_centroid[0][0]-$result_centroid[1][0]),2)+pow(($result_centroid[0][1]-$result_centroid[1][1]),2)+pow(($result_centroid[0][2]-$result_centroid[1][2]),2)+pow(($result_centroid[0][3]-$result_centroid[1][3]),2)+pow(($result_centroid[0][4]-$result_centroid[1][4]),2)+pow(($result_centroid[0][5]-$result_centroid[1][5]),2));
        $resultc1c3 = sqrt(pow(($result_centroid[0][0]-$result_centroid[2][0]),2)+pow(($result_centroid[0][1]-$result_centroid[2][1]),2)+pow(($result_centroid[0][2]-$result_centroid[2][2]),2)+pow(($result_centroid[0][3]-$result_centroid[2][3]),2)+pow(($result_centroid[0][4]-$result_centroid[2][4]),2)+pow(($result_centroid[0][5]-$result_centroid[2][5]),2));
        $resultc2c3 = sqrt(pow(($result_centroid[1][0]-$result_centroid[2][0]),2)+pow(($result_centroid[1][1]-$result_centroid[2][1]),2)+pow(($result_centroid[1][2]-$result_centroid[2][2]),2)+pow(($result_centroid[1][3]-$result_centroid[2][3]),2)+pow(($result_centroid[1][4]-$result_centroid[2][4]),2)+pow(($result_centroid[1][5]-$result_centroid[2][5]),2));
        $resultall = $resultc1c2+$resultc1c3+$resultc2c3;
        return $resultall;        
    } 
 
    public function ratioDBI($ssw,$ssb){
        $ratiodbi = $ssw/$ssb;
        return $ssw/$ssb;
    }

    public function purity($puritygeocluster,$data){
        $alldata = [];
        for($i = 1 ; $i <= count($puritygeocluster) ; $i++){
            $alldata[$i] = count($puritygeocluster[$i]);
        }
        $puritytotal = array_sum($alldata)/count($data);
        //dd($alldata);
        return $puritytotal;
    }

}
