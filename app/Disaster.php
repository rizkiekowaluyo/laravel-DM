<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disaster extends Model
{
    //
    protected $fillable = ['namawilayah','jumlahkejadian','jumlahkorban','jumlahkerusakan'];
}
