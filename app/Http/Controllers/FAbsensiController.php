<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Absensi;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make($data, [
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', 'Error : Mohon isikan keterangan Anda.');
        }else{
            $data['id_user'] = $id;
            $data['hadir'] = Carbon::now()->locale('id')->isoFormat('Y-MM-DD hh:m:s');
            // dd($data['hadir']);
            $cek = Absensi::where('id_user', $id)->whereDate('hadir', $data['hadir'])->count();
            // dd($cek);
            if($cek > 0){
                return redirect()->route('beranda')->with('toast_error', 'Anda sudah Absen Hadir.');
            }else{
                Absensi::create($data);
                return redirect()->route('beranda')->withSuccess('Absensi Hadir Berhasil');
            }
        }
        // // Rotate Image
        // $photo           = request()->file('img_hadir');
        // $temp            = imagecreatefromjpeg($photo);
        // $rotated         = imagerotate($temp, 270, 0);
        // $extension       = $photo->getClientOriginalExtension();
        // $fileNametoStore = time() . "___" . explode('.', $photo->getClientOriginalName())[0] . '.' . $extension;
        // imagejpeg($rotated,  $fileNametoStore);
        // // Rotate Image


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

        $validator = Validator::make($data, [
            'deskripsi' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', 'Error : Mohon isikan keterangan Anda.');
        } else {
            $item = Absensi::where('id_user', $id)->whereDay('created_at', date('d'))->first();
            $data['pulang'] = Carbon::now()->locale('id')->isoFormat('Y-MM-D H:m:s');
            $item->update($data);
            $hadir = Carbon::parse($item->hadir);
            $pulang = Carbon::parse($data['pulang']);
            $lamakerja = $pulang->diffInMinutes($hadir) / 50;
            $lembur = floor($lamakerja);
            if ($lembur > 9) {
                return view('frontend.lembur.input', []);
            } else {
                return redirect()->route('beranda')->withSuccess('Absensi Pulang Berhasil!');;
            }
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
