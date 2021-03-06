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

function geoclusterGet(){
    $query = DB::table('geocentroids')
            ->select('cluster',DB::raw('count(cluster) as countcluster'))
            ->groupBy('cluster')
            ->get();
    return $query;
}

function correlationGet(){    
    return DB::table('correlations')->where('id',1)->first()->ratioperson;
}

function tenrankkejadiandisaster(){
    $disasterrank = Disaster::all();
    $disasterrank = $disasterrank->sortByDesc('jumlahkejadian')->take(10);
    return $disasterrank;
}

function tenrankkerusakandisaster(){
    $disasterrankrusak = Disaster::all();
    $disasterrankrusak = $disasterrankrusak->sortByDesc('jumlahkerusakan')->take(10);
    return $disasterrankrusak;
}

function countkejadian()
{
    return Disaster::get()->sum('jumlahkejadian');
}

function countkorban()
{
    return Disaster::get()->sum('jumlahkorban');
}