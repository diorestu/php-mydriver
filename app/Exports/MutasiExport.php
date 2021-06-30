<?php

namespace App\Exports;

use App\Aktivitas;
use Maatwebsite\Excel\Concerns\FromCollection;

class MutasiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Aktivitas::all();
    }
}
