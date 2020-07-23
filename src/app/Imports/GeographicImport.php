<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Geographic;

class GeographicImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
        foreach($collection as $key => $data){  
            if ($key >= 3) {
                # code...
                Geographic::create([
                    'namawilayah' => $data[0],                   
                    'kemiringanlereng' => $data[1],                   
                    'jenistanah' => $data[2],                   
                    'curahhujan' => $data[3],                   
                    'tegal' => $data[4],                   
                    'huma' => $data[5],                   
                    'sementaratidakdiusahakan' => $data[6]                   
                ]);   
            }                                                                             
        }

        //dd($collection)
    }
}
