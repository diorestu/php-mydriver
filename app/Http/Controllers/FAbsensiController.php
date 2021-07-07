<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Absensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class FAbsensiController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        $data = User::with('cabang')->where('id', $id)->first();
        $dataabsen = Absensi::with('user')->where('id_user', $id)->whereDay('created_at', date('d'))->first();
        if($dataabsen->hadir != null && $dataabsen->pulang != null){
            return redirect()->route('beranda')->withToastWarning('Anda sudah selesai absensi hari ini!');
        }else{
            return view('frontend.absen.index', [
                'data' => $data,
                'absen' => $dataabsen,
            ]);
        }

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
            'img_hadir' => 'required|mimes:jpeg,jpg,png,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', 'Error : Mohon lengkapi absensi Anda.');
        }else{
            $data['id_user'] = $id;
            $data['hadir'] = Carbon::now()->locale('id')->isoFormat('Y-MM-DD H:m:s');
            if ($request->hasFile('img_hadir')) {
                // Upload Images
                $name = Str::slug(auth()->user()->name);
                $originalImage = $request->file('img_hadir');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path() . '/storage/absensi/';
                $thumbnailImage->fit(320)->rotate(90);
                $thumbnailImage->save($thumbnailPath . time() . '-' . $name . 'hadir.jpg');
            } else {
                $data['img_hadir'] = null;
            }
            $cek = Absensi::where('id_user', $id)->whereDate('hadir', date('Y-m-d'))->count();
            if($cek > 0){
                return redirect()->route('beranda')->with('toast_error', 'Anda sudah Absen Hadir.');
            }else{
                Absensi::create($data);
                return redirect()->route('beranda')->withSuccess('Absensi Hadir Berhasil');
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
            $item = Absensi::where('id_user', $id)->whereDate('created_at', date('Y-m-d'))->first();
            $data['pulang'] = Carbon::now()->locale('id')->isoFormat('Y-MM-D H:m:s');
            if ($request->hasFile('img_hadir')) {
                // Upload Images
                $name = Str::slug(auth()->user()->name);
                $originalImage = $request->file('img_hadir');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path() . '/storage/absensi/';
                $thumbnailImage->fit(320)->rotate(90);
                $thumbnailImage->save($thumbnailPath . time() . '-' . $name . 'pulang.jpg');
                $item->img_pulang = time() . '-' . $name . '.jpg';
            } else {
                $item->img_pulang = null;
            }
            $success = $item->update($data);
            if($success){
                $hadir = Carbon::parse($item->hadir);
                $pulang = Carbon::parse($data['pulang']);
                $lamakerja = $pulang->diffInMinutes($hadir) / 50;
                $lembur = floor($lamakerja);
                if ($lembur > 9) {
                    return view('frontend.lembur.input', []);
                } else {
                    return redirect()->route('beranda')->withSuccess('Absensi Pulang Berhasil!');
                }
            }else{
                return redirect()->route('beranda')->withErro('Mohon Ulangi Kembali!');
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
