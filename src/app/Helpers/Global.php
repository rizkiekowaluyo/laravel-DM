<?php
use App\Disaster;
use App\Geographic;

function disasterTotal(){
    return Disaster::count();
}

function geoTotal(){
    return Geographic::count();
}

function clusterGet(){
    $querycount  = DB::table('centroids')
				->select('cluster',DB::raw('count(cluster) as countcluster'))
				->groupBy('cluster')
                ->get();    
    return $querycount;
}