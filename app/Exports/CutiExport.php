<?php

namespace App\Exports;

use App\Cuti;
use Maatwebsite\Excel\Concerns\FromCollection;

class CutiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cuti::all();
    }
}
