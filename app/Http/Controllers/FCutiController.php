<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cuti;
use Auth;
use Alert;

class FCutiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = Cuti::with('user')->whereMonth('mulai', date('m'))->whereYear('mulai', date('Y'))->where('id_user', $id)->get();
        return view('frontend.cuti.index', [
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
        return view('frontend.cuti.create');
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
        $data['mulai'] = $request->mulai;
        $data['selesai'] = $request->selesai;
        $data['photos'] = 'img.src';
        $data['status'] = 'PENDING';
        Cuti::create($data);
        Alert::alert('Berhasil', 'Pengajuan Cuti Berhasil', 'success')->autoClose(1000);
        return redirect()->route('cuti.index');
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
