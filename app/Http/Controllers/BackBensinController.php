<?php

namespace App\Http\Controllers;

use App\Bensin;
use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\Mobil;
use Carbon\Carbon;

class BackBensinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Auth::user()->id_cabang;
        $staff = Bensin::get();
        $actcount = Bensin::with('user', 'mobil')
        ->whereHas('user', function ($q) {
            $q->where('id_cabang', auth()->user()->id_cabang);
        })
        ->get();
        // dd($staff);
        return view('backend.bensin.index', [
            'cabang' => $cabang,
            'data' => $actcount,
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
        $mobil = Mobil::where('id_cabang', $cabang)->get();
        return view('backend.bensin.create', [
            'staff'  => $staff,
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
        $data['status'] = 'DITERIMA';
        $data['tanggal'] = Carbon::parse($request->tanggal)->format('Y-m-d');
        // dd($data);
        Bensin::create($data);
        Alert::success('Input BBM Berhasil!');
        return redirect()->route('bbm.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Bensin::find($id);
        $item->status = 'DITERIMA';
        $item->save();
        Alert::success('Berhasil Acc Pembelian');
        return redirect()->route('bbm.index');
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
        $data = Bensin::findOrFail($id);
        $data->delete();
        Alert::success('Berhasil Menghapus');
        return redirect('admin/bbm');
    }
}
