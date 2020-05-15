<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Geographic extends Model
{
    //
    protected $fillable = ['namawilayah','kemiringanlereng','jenistanah','curahhujan'];

    //! saveHelper func saving to database
	public static function saveHelper($dcentroid1, $dcentroid2, $dcentroid3, $mindistance, $clusterall){
		return DB::table('geocentroids')->insert([
	    	'distancecentroid1'		=> $dcentroid1,
	    	'distancecentroid2'		=> $dcentroid2,
	    	'distancecentroid3'		=> $dcentroid3,
	    	'mindistance'		=> $mindistance,
	    	'cluster'		=> $clusterall,	    			
    	]);
    }

    //! deleteHelper func to truncate row centroids table
    public static function deleteHelper(){
		return DB::select("TRUNCATE Table geocentroids");
	}
    
    //! groupby
	public static function groupClusterHelper(){		
		return DB::table('centroids')
					->select(DB::raw('cluster as cluster'), DB::raw('avg(mindistance) as average'))
					->groupBy(DB::raw('cluster') )
					->get();		
	}
    
}
