<?php

namespace App\Exports;

use App\Bensin;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BensinExport implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        return view('backend.bensin.print', [
            'datas' => Bensin::with('user')
            ->whereDay('created_at', date('d'))
                ->whereHas('user', function ($q) {
                    $q->where('id_cabang', auth()->user()->id_cabang);
                })
                ->get(),
        ]);
    }
}
