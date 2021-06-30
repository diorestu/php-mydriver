<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Mobil;
use App\Aktivitas;
use Alert;

class FAktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = Aktivitas::whereDay('tanggal', date('d'))
                ->where('id_user', $id)->get();
        return view('frontend.aktivitas.index', [
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
        $mobil = Mobil::where('id_cabang', $cabang)->get();
        // dd($mobil);
        return view('frontend.aktivitas.create', [
            'cabang' => $cabang,
            'mobil'  => $mobil,
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
        $data = $request->all();
        $data['id_user'] = Auth::user()->id;
        $data['status'] = 'ON PROGRESS';
        Aktivitas::create($data);
        Alert::success('Berhasil Menambahkan Data Aktivitas');
        return redirect()->route('aktivitas.index');
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
        $cabang = Auth::user()->id_cabang;
        $item = Aktivitas::findOrFail($id);
        $mobil = Mobil::where('id_cabang', $cabang)->get();
        return view('frontend.aktivitas.edit',[
            'mobil' => $mobil,
            'item'  => $item,
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
        $item = Aktivitas::find($id);
        $data['status'] = 'SELESAI';
        $data['deskripsi'] = $item->deskripsi .'. UPDATE : '.$request->deskripsi ;
        dd($data['deskripsi']);
        $item->update($data);
        Alert::success('Berhasil Menyelesaikan Aktivitas');
        return redirect()->route('aktivitas.index');
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
