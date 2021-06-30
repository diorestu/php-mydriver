<?php

namespace App\Exports;

use App\Lembur;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class LemburExport implements FromQuery, WithHeadings
{
    use Exportable;

    public function query()
    {
        $data =
        Lembur::with('user')
            ->whereMonth('lemburs.hadir', date('m'))
            ->join('users', 'users.id', '=', 'lemburs.id_user')
            ->orderBy('users.name', 'DESC')
            ->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nomor',
            'Nama',
        ];
    }
}
