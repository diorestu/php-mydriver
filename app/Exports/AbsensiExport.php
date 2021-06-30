<?php

namespace App\Exports;

use App\Absensi;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AbsensiExport implements  FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view('backend.absensi.print', [
            'datas' => Absensi::with('user')
            ->whereDay('hadir', date('d'))
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->get(),
        ]);
    }
}
