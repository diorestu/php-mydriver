<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Auth;
use App\User;
use App\UnitKerja;
use App\Cabang;
use Alert;
use Hash;

class BackUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabang = Auth::user()->id_cabang;
        $staff = User::with(['cabang', 'unitkerja'])->get();
        // dd($data);
        return view('backend.user.index', [
            'cabang' => $cabang,
            'staff' => $staff,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unit = UnitKerja::with('cabang')->get();
        $cabang = Cabang::all();

        return view('backend.user.create', [
            'unit' => $unit,
            'cabang' => $cabang,
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

        $request->validate([
            'name'      => 'required',
            'password'  => 'required|confirmed',
            'username'     => 'required',
            'phone'     => 'required'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $cr = User::create($data);
        Alert::success('Simpan Data Berhasil!')->autoClose(2000);
        return redirect()->route('user.index');

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
        $unit = UnitKerja::with('cabang')->get();
        $cabang = Cabang::all();
        $data = User::find($id);
        return view('backend.user.edit',[
            'data' => $data,
            'unit' => $unit,
            'cabang' => $cabang,
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
        $item = User::findOrFail($id);
        $data['password'] = Hash::make($request->password);
        $item->update($data);
        Alert::success('Ubah Data Berhasil!')->autoClose(2000);
        return redirect()->route('user.index');

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
