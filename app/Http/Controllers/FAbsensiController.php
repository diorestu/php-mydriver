<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Absensi;

use Auth;
use Alert;
use Carbon\Carbon;

class FAbsensiController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $data = User::with('cabang')->where('id', $id)->first();
        $dataabsen = Absensi::with('user')->where('id_user', $id)->whereDay('created_at', date('d'))->first();
        // dd($dataabsen);
        return view('frontend.absen.index', [
            'data' => $data,
            'absen' => $dataabsen,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('frontend.absen.input');
    }


    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $data = $request->all();
        $data['id_user'] = $id;
        $data['hadir'] = Carbon::now()->locale('id')->isoFormat('Y-MM-D H:m:s');
        // dd($data['hadir']);
        Absensi::create($data);
        Alert::success('Absensi Kehadiran Berhasil!');
        return redirect()->route('beranda');
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
        $data = Absensi::where('id_user', Auth::user()->id)->whereDate('created_at', date('Y-m-d'))->first();
        $id = $data->id;
        return view('frontend.absen.pulang', [
            'data' => $data,
            'id' => $id,
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
        $id = auth()->user()->id;
        $data = $request->all();
        $item = Absensi::where('id_user', $id)->whereDay('created_at', date('d'))->first();
        $data['pulang'] = Carbon::now()->locale('id')->isoFormat('Y-MM-D H:m:s');
        $item->update($data);

        $hadir = Carbon::parse($item->hadir);
        $pulang = Carbon::parse($data['pulang']);
        $lamakerja = $pulang->diffInMinutes($hadir) / 60;
        $lembur = floor($lamakerja);
        if($lembur > 9){
            return view('frontend.lembur.input', [

            ]);
        }else{
            Alert::success('Absensi Pulang Berhasil!');
            return redirect()->route('beranda');
        }
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
