<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Disaster;

class DisasterImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Looping collection excel
        foreach($collection as $key => $data){  
            if ($key >= 3) {
                # code...
                Disaster::create([
                    'namawilayah' => $data[0],                   
                    'jumlahkejadian' => $data[1],                   
                    'jumlahkorban' => $data[2],                   
                    'jumlahkerusakan' => $data[3]                   
                ]);   
            }                                                                             
        }
        //cek isi collection
        //dd($collection); 
    }
}
