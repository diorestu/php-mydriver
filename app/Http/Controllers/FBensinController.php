<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bensin;
use Auth;
use Alert;
use App\Mobil;

class FBensinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = Bensin::whereYear('tanggal', date('Y'))->where('id_user', $id)->get();
        return view('frontend.bensin.index', [
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
        return view('frontend.bensin.create', [
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
        $id = auth()->user()->id;
        $data = $request->all();
        $data['id_user'] = $id;
        $data['status'] = 'PENDING';
        $data['tanggal'] = date('Y-m-d');
        $success = Bensin::create($data);
        if ($success) {
            return redirect()->route('bensin.index')->withSuccess('Catat Pembelian BBM Berhasil!');
        } else {
            return redirect()->route('bensin.index')->withToastError('Terjadi Kesalahan : Mohon Ulangi Kembali');
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
        $deleted = Bensin::where('id', $id)->delete();
        if($deleted){
            return redirect()->route('beranda')->withToastSuccess('Data Telah Dihapus');
        }else{
            return redirect()->route('beranda')->withToastError('Data Tidak Ditemukan');
        }

    }
}
