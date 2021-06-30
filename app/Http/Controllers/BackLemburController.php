<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Lembur;
use Alert;

class BackLemburController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles      = Auth::user()->roles;
        $cabang     = Auth::user()->cabang;
            if ($roles == 1) {
                $staff = User::where('roles', 4)->get();
            }else{
                $staff = User::where('roles', 4)->where('id_cabang', $cabang);
            }
        $absensi = Lembur::with('user')
                ->whereMonth('lemburs.hadir', date('m'))
                ->whereHas('user', function ($q) {
                    $q->where('id_cabang', auth()->user()->id_cabang);
                })

                ->get();
        // dd($absensi);
        return view('backend.lembur.index',[
            'staff'     => $staff,
            'absensi'   => $absensi,
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
        $item = Lembur::find($id);
        $item->status = 'DITERIMA';
        // dd($item->status);
        $item->save();
        Alert::success('Berhasil!');
        return redirect()->route('lembur.index');

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
