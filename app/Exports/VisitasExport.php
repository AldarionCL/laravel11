<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Modules\Recepcion\Entities\Visitas;

class VisitasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Visitas::all();
    }
}
