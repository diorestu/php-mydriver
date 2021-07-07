<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Absensi;
use App\Aktivitas;
use App\UnitKerja;
use App\Cabang;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        // dd($data);
        $absen = Absensi::whereDay('created_at', date('d'))->where('id_user', $id)->first();
        $aktivitas = Aktivitas::with('user')
            ->whereDay('tanggal', date('d'))
            ->where('status', 'AKTIF')
            ->where('id_user', $id)
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->first();


        return view('frontend.index', [
            'data'      => $data,
            'absen'     => $absen,
            'aktivitas' => $aktivitas,
        ]);
    }


    public function profil()
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        $unit = UnitKerja::all();
        $cabang = Cabang::all();

        return view('frontend.profile', [
            'data'   => $data,
            'unit'   => $unit,
            'cabang' => $cabang,
        ]);
    }


    public function getCountries()
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);
        $unit = UnitKerja::all();
        $cabang = Cabang::all();
        $countries = Cabang::pluck('cabang', 'id');
        return view('frontend.profile', compact('cabang'), [
            'data'   => $data,
            'unit'   => $unit,
            'cabang' => $cabang,
        ]);
    }

    public function getStates($id)
    {
        $states = UnitKerja::where("id_cabang", $id)->pluck('nama', 'id');
        return json_encode($states);
    }


}
