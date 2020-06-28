<?php

namespace App\Exports;

use App\Disaster;
use Maatwebsite\Excel\Concerns\FromCollection;

class DisasterExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Disaster::all();
    }
}
