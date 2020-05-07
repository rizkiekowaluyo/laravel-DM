<?php

namespace App\Http\Controllers;

use App\Geographic;
use Illuminate\Http\Request;

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

        $cluster = 3;
        $centroid = $this->earlyCentroidGeo($data,$cluster);
        $hasil_iterasi=[];
        $hasil_cluster=[];
        $itr=0;

        while(true){
            $iterasi = array();
        }

    }

    public function earlyCentroidGeo($data,$cluster){
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
            ];                           
        }
        return $centroid;
    }

    public function distance(){
        $resultDistance = sqrt(pow(($data[0]-$centroid[0]),2)+pow(($data[1]-$centroid[1]),2)+pow(($data[2]-$centroid[2]),2));             
        return $resultDistance;
    }

    public function newCentroid(){

    }

    public function centroidChange(){
        
    }
}
