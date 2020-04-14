<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Disaster extends Model
{
    //! Fillable column
	protected $fillable = ['namawilayah','jumlahkejadian','jumlahkorban','jumlahkerusakan'];

	//! saveHelper func saving to database
	public static function saveHelper($dcentroid1, $dcentroid2, $dcentroid3, $clusterall){
		return DB::table('centroids')->insert([
	    	'distancecentroid1'		=> $dcentroid1,
	    	'distancecentroid2'		=> $dcentroid2,
	    	'distancecentroid3'		=> $dcentroid3,
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
}
