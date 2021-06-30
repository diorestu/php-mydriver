<?php

namespace App\Http\Controllers;

use App\CheckList;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use App\Mobil;

class FCeklisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = Checklist::where('id_user', $id)->whereDay('created_at', date('d'))->get();

        return view('frontend.ceklis.index', [
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
        $id = Auth::user()->id_cabang;
        $mobil = Mobil::where('id_cabang', $id)->get();
        return view('frontend.ceklis.create', [
            'mobil' => $mobil,
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
        $id = Auth::user()->id;
        $data = $request->all();
        $data['id_user'] = $id;
        if($request->tisu){
            $data['tisu'] = 'Ada';
        }else{
            $data['tisu'] = 'Tidak Ada';
        }

        if ($request->box) {
            $data['box'] = 'Ada';
        } else {
            $data['box'] = 'Tidak Ada';
        }

        if ($request->masker) {
            $data['masker'] = 'Ada';
        } else {
            $data['masker'] = 'Tidak Ada';
        }

        if ($request->parfum) {
            $data['parfum'] = 'Ada';
        } else {
            $data['parfum'] = 'Tidak Ada';
        }

        if ($request->sanitizer) {
            $data['sanitizer'] = 'Ada';
        } else {
            $data['sanitizer'] = 'Tidak Ada';
        }

        if ($request->washed) {
            $data['washed'] = 'Ya';
        } else {
            $data['washed'] = 'Tidak';
        }

        CheckList::create($data);
        Alert::success('Input Check List Berhasil');
        return redirect()->route('ceklis.index');
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
