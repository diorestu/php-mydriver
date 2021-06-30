<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Bensin;
use App\Aktivitas;
use App\Cuti;
use App\CheckList;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;

class BackIndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->roles;
        $cabang = Auth::user()->id_cabang;

        if ($user > 1) {
            $driver = User::where('roles', 4)->where('id_cabang', $cabang)->count();
            $bensin = Bensin::whereMonth('created_at', date('m'))->sum('harga');
        } else {
            $driver = User::where('roles', 4)->count();
            $bensin = Bensin::whereMonth('created_at', date('m'))->sum('harga');
        }

        $c = Bensin::leftJoin('users', function ($join) {
            $join
                ->on('bensins.id_user', '=', 'users.id');
        })
            ->leftJoin('mobils', function ($join) {
                $join
                    ->on('bensins.id_mobil', '=', 'mobils.id');
            })
            ->where('users.id_cabang', $cabang)
            ->sum('harga');


        $chart = (new LarapexChart)->areaChart()
            ->setTitle('Users')
            ->addData('Active users', DB::table('users')
                ->select('id_cabang', DB::raw('count(*) as total'))
                ->where('roles', 4)
                ->groupBy('id_cabang')
                ->pluck('total')->toArray())
            ->setXAxis(['Pusat', 'Renon', 'Denpasar', 'Badung', 'Mangupura', 'Tabanan', 'Negara', 'Singaraja', 'Seririt', 'Bangli', 'Gianyar', 'Ubud', 'Klungkung', 'Karangasem'])
            ->setColors(['#ffc63b', '#ff6384']);

        $act = Aktivitas::with('user', 'mobil')
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->whereDay('created_at', date('d'))
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        $actcount = Aktivitas::where('tanggal', date('Y-m-d'))
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })

            ->count();

        $cuticount = Cuti::with('user')
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->count();

        $ceklis = CheckList::with('user', 'mobil')
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->whereDate('created_at', date('Y-m-d'))
            ->orderBy('created_at', 'DESC')
            ->limit(6)
            ->get();

        return view('backend.index', compact('chart'), [
            'user'      => $user,
            'cabang'    => $cabang,
            'driver'    => $driver,
            'bensin'    => $bensin,
            'c'         => $c,
            'act'       => $act,
            'count'     => $actcount,
            'cuti'      => $cuticount,
            'ceklis'    => $ceklis,
        ]);
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
        //
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
