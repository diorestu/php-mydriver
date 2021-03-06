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
        $data = Aktivitas::whereDate('created_at', date('Y-m-d'))
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
        $validator = Validator::make($data, [
            'deskripsi' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', 'Error : Mohon isikan keterangan Anda.');
        } else {
            $data['id_user'] = Auth::user()->id;
            $data['status'] = 'SELESAI';
            $success = Aktivitas::create($data);
            if ($success) {
                return redirect()->route('aktivitas.index')->withSuccess('Tambah Aktivitas Berhasil!');
            } else {
                return redirect()->route('aktivitas.index')->withToastError('Mohon Ulangi Kembali');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        $deleted = Aktivitas::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('beranda')->withToastSuccess('Data Telah Dihapus');
        } else {
            return redirect()->route('beranda')->withToastError('Data Tidak Ditemukan');
        }
    }
}
