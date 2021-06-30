<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Absensi;
use App\Lembur;
use App\Libur;
use Carbon\Carbon;
use Alert;

class FLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $d1 = Auth::user()->cabang->cabang_lembur1;
        $d2 = Auth::user()->cabang->cabang_lembur2;
        $d9 = Auth::user()->cabang->cabang_lembur9;
        $d10 = Auth::user()->cabang->cabang_lembur10;
        $deskripsi = $request->deskripsi;
        // Absensi
        $id = Auth::user()->id;
        $data = Absensi::where('id_user', $id)
                        ->whereDay('hadir', date('d'))
                        ->first();
        $hadir = Carbon::parse($data->hadir);
        $pulang = Carbon::parse($data->pulang);
        // Absensi

        // Cek Hari Libur
        $libur = Libur::where('status', 'Aktif')->where('libur', date('Y-m-d'))->get();
        $hari = $hadir->locale('id')->isoFormat('dddd');
            if(count($libur) < 1){
                $status = 0;
            }else{
                $status = 1;
            }
        $lamakerja = $pulang->diffInMinutes($hadir)/60;

        // Cek Hari Libur
        if ($hari == 'Sabtu' || $hari == 'Minggu' || $status == 1) {
            $lembur = floor($lamakerja);
            if ($lembur <= 8) {
                $harga = $d2;
            } elseif ($lembur == 9) {
                $harga = $d2 + $d9;
            }else{
                $sisa = $lembur - 9;
                $harga = $d2 + $d9 + ($sisa * $d10);
            }
        }else{
            $lembur = floor($lamakerja) - 9;
            if ($lembur>1) {
                $sisa = $lembur - 1;
                if($sisa >2){
                    $harga = $d1 + (2 * $d2);
                }else{
                    $harga = $d1 + ($sisa * $d2);
                }
            } else {
                $harga = $d1;
            }
        }
        Lembur::create([
            'id_user' => $id,
            'hadir' => $data->hadir,
            'pulang' => $data->pulang,
            'keterangan' => $deskripsi,
            'harga' => $harga,
            'status' => 'PENDING',
            'lamakerja' => $lamakerja,
            'jam' => floor($lembur)
        ]);

        Alert::success('Berhasil')->autoClose(2000);
        return redirect()->route('beranda');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
