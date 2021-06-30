<?php

namespace App\Http\Controllers;

use App\Aktivitas;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Mobil;
use Alert;

class BackAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Aktivitas::with('user', 'mobil')
                ->whereDay('tanggal', date('d'))
                ->whereHas('user', function ($q) {
                    $q->where('id_cabang', auth()->user()->id_cabang);
                })
                ->get();
        return view('backend.aktivitas.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabang = Auth::user()->id_cabang;
        $staff = User::where('id_cabang', $cabang)->where('roles', 4)->get();
        return view('backend.aktivitas.create', [
            'staff'  => $staff,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user()->id;
        $cabang = Auth::user()->id_cabang;
        $data = $request->all();
        $data['status'] = 'AKTIF';
        $data['km_awal'] = 0;
        $data['km_akhir'] = 0;
        $data['lat'] = 0;
        $data['long'] = 0;

        // Random ID User
        $useroff = Aktivitas::whereDay('tanggal', date('d'))
                    ->where('status', 'AKTIF')
                    ->groupBy('id_user')
                    ->pluck('id_user')
                    ->toArray();
        // dd($useroff);
        $usercount = User::where('id_cabang', $cabang)
                    ->where('roles', 4)
                    ->where('pool', 1)
                    ->count();
            if(count($useroff) < $usercount){
                $userkosong = User::where('id_cabang', $cabang)
                    ->where('roles', 4)
                    ->where('pool', 1)
                    ->whereNotIn('id', $useroff)
                    ->pluck('id')
                    ->random(1)
                    ->first();
            // dd($userkosong);
                $data['id_user'] = $userkosong;
                $data['id_mobil'] = 0;
                Aktivitas::create($data);
                Alert::success('Order Berhasil Ditambahkan!');
            }else{
                Alert::error('Tidak Ada Sopir');
            }
        return redirect()->route('task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Aktivitas::find($id);
        $item->status = 'BATAL';
        $item->save;
        Alert::success('Batalkan Order Berhasil!');
        return redirect()->route('task.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Aktivitas::find($id);
        return view('backend.aktivitas.edit', [
            'data' => $data,
        ]);
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
        $data = $request->all();
        $item = Aktivitas::findOrFail($id);
        $item->rating = $data['rating'];
        $item->komentar = $data['komentar'];
        $item->save();
        Alert::success('Beri Rating Berhasil!');
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (count($useroff) < $usercount) {
        //     $userkosong = User::where('id_cabang', $cabang)->whereNotIn('id', $useroff)->pluck('id')->random(1);
        //     $data['id_user'] = $userkosong->first();
        //     // Random ID Mobil
        //     $mobiloff = Aktivitas::whereDay('tanggal', date('d'))->groupBy('id_mobil')->pluck('id_mobil')->toArray();
        //     $mobilcount = Mobil::where('id_cabang', $cabang)->count();
        //     if (count($mobiloff) < $mobilcount) {
        //         $mobilkosong = Mobil::where('id_cabang', $cabang)->whereNotIn('id', $mobiloff)->pluck('id')->random(1);
        //         $data['id_mobil'] = $mobilkosong->first();
        //         Aktivitas::create($data);
        //         Alert::success('Order Berhasil Ditambahkan!');
        //     } else {
        //         Alert::error('Tidak Ada Mobil yang tersedia!');
        //     }
        // } else {
        //     Alert::error('Tidak Ada Sopir');
        // }
    }
}
