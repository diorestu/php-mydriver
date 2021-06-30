<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Exports\LemburExport;
use App\Exports\BensinExport;
use Excel;

class BackExportController extends Controller
{
    public function lemburExport()
    {
        $filename = 'REKAP LEMBUR ' . date('Y-m-d') . '.xlsx';
        return (new LemburExport)->download($filename);
    }

    public function absenExport()
    {
        // return (new AbsensiExport)->download('absen.xlsx');
        $filename = 'REKAP ABSENSI '. date('Y-m-d').'.xlsx';
        return Excel::download(new AbsensiExport, $filename);
    }

    public function bensinExport()
    {
        // return (new AbsensiExport)->download('absen.xlsx');
        $filename = 'REKAP BENSIN ' . date('Y-m-d') . '.xlsx';
        return Excel::download(new BensinExport, $filename);
    }
}
