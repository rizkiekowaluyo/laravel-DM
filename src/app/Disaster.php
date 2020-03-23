<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Disaster extends Model
{
    //
	protected $fillable = ['namawilayah','jumlahkejadian','jumlahkorban','jumlahkerusakan'];
	
	public static function listData(){
		return DB::table('disasters')->get();
	}

    public static function deleteHelper(){
		return DB::select("TRUNCATE Table disasters");
	}

	public static function getMin(){
		return DB::select("Select MIN(jumlahkejadian) as minJmlKejadian, MIN(jumlahkorban) as minJmlKorban, MIN(jumlahkerusakan) as minJmlKerusakan from tblbantu");
	}
}
