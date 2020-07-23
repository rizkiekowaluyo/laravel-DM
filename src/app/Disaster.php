<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Disaster extends Model
{
    //! Fillable column
	protected $fillable = ['namawilayah','jumlahkejadian','jumlahkorban','jumlahkerusakan'];

	//! saveHelper func saving to database
	public static function saveHelper($dcentroid1, $dcentroid2, $dcentroid3, $mindistance, $clusterall){
		return DB::table('centroids')->insert([
	    	'distancecentroid1'		=> $dcentroid1,
	    	'distancecentroid2'		=> $dcentroid2,
	    	'distancecentroid3'		=> $dcentroid3,
	    	'mindistance'		=> $mindistance,
	    	'cluster'		=> $clusterall,	    			
    	]);
	}
	//! count disaster data
	public static function countdisastersHelper(){
		return DB::table('disasters')->count();
	}
	//! deleteHelper func to truncate row centroids table
    public static function deleteHelper(){
		return DB::select("TRUNCATE Table centroids");
	}
	//! get min value from row centroids table
	public static function getMinHelper(){
		return DB::select("Select MIN(jumlahkejadian) as minJmlKejadian, MIN(jumlahkorban) as minJmlKorban, MIN(jumlahkerusakan) as minJmlKerusakan from centroids");
	}
	//! groupby
	public static function groupClusterHelper(){
		//return DB::table('centroids')->groupBy('cluster',2);
		return DB::table('centroids')
					->select(DB::raw('cluster as cluster'), DB::raw('avg(mindistance) as average'))
					->groupBy(DB::raw('cluster') )
					->get();
		//return DB::select('select distancecentroid2,cluster from centroids group by cluster');	 
	}
	//! geouping count same value on cluster
	public static function groupingSameValueCluster(){				
		return DB::table('centroids')
					->select('cluster',DB::raw('mindistance as "mindistance"'),DB::raw('count(*) as count'))					
					->groupBy('cluster',\DB::raw('mindistance'))					
					->get();
	}
	//! avg all data
	public static function avgDataDisaster(){
		return DB::table('disasters')
					->select(DB::raw("AVG(jumlahkejadian) as avgkejadian"),DB::raw("AVG(jumlahkorban) as avgkorban"),DB::raw("AVG(jumlahkerusakan) as avgkerusakan"))
					->get();
	}
	//! helper saver correlation
	public static function helperCorrelation($result)
	{
		return DB::table('correlations')->insert([
	    	'ratioperson'		=> $result,	    		    			
    	]);
	}
	//! helper delete correlation
	public static function helperDeleteCorrelation()
	{
		return DB::select("TRUNCATE Table correlations");
	}
}
