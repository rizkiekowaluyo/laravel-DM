<?php

namespace App\Exports;

use App\Geographic;
use Maatwebsite\Excel\Concerns\FromCollection;

class GeographicExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Geographic::all();
    }
}
