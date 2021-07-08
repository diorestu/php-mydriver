<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cuti;
use Auth;
use Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


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

        $validator = Validator::make($data, [
            'mulai' => 'required',
            'selesai' => 'required',
        ]);

        $selesai = new Carbon($data['selesai']);
        $now = date('Y-m-d');
        if($selesai->format('Y-m-d') == $now){
            if ($validator->fails()) {
                return back()->with('toast_error', 'Error : Mohon lengkapi pengajuan Anda terlebih dahulu.');
            } else {
                if ($request->hasFile('photos')) {
                    // Upload Images
                    $name = Str::slug(auth()->user()->name);
                    $originalImage = $request->file('photos');
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailPath = public_path() . '/storage/cuti/';
                    $thumbnailImage->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumbnailImage->save($thumbnailPath . date('d-m-Y') . '-' . $name . '-cuti.jpg');
                    $data['photos'] = date('d-m-Y') . '-' . $name . '-cuti.jpg';
                } else {
                    $data['photos'] = null;
                }
                $data['id_user'] = Auth::user()->id;
                $data['mulai'] = $request->mulai;
                $data['selesai'] = $request->selesai;
                $data['status'] = 'PENDING';
                $success = Cuti::create($data);
                if ($success) {
                    return redirect()->route('cuti.index')->withToastSuccess('Pengajuan Cuti Berhasil! Mohon Tunggu Konfirmasi');
                } else {
                    return redirect()->route('cuti.index')->withToastError('Mohon Ulangi Pengajuan');
                }
            }
        }elseif($selesai->isPast() == false){

            if ($validator->fails()) {
                return back()->with('toast_error', 'Error : Mohon lengkapi pengajuan Anda terlebih dahulu.');
            } else {
                if ($request->hasFile('photos')) {
                    // Upload Images
                    $name = Str::slug(auth()->user()->name);
                    $originalImage = $request->file('photos');
                    $thumbnailImage = Image::make($originalImage);
                    $thumbnailPath = public_path() . '/storage/cuti/';
                    $thumbnailImage->resize(null, 400, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $thumbnailImage->save($thumbnailPath . time() . '-' . $name . '-cuti.jpg');
                    $data['photos'] = time() . '-' . $name . '-cuti.jpg';
                } else {
                    $data['photos'] = null;
                }
                $data['id_user'] = Auth::user()->id;
                $data['mulai'] = $request->mulai;
                $data['selesai'] = $request->selesai;
                $data['status'] = 'PENDING';
                $success = Cuti::create($data);
                if ($success) {
                    return redirect()->route('cuti.index')->withToastSuccess('Pengajuan Cuti Berhasil! Mohon Tunggu Konfirmasi');
                } else {
                    return redirect()->route('cuti.index')->withToastError('Mohon Ulangi Pengajuan');
                }
            }
        }else{
            return back()->with('toast_error', 'Error : Mohon pastikan tanggal pengajuan sudah sesuai');
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
        $deleted = Cuti::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('cuti.index')->withToastSuccess('Data Telah Dihapus');
        } else {
            return redirect()->route('cuti.index')->withToastError('Data Tidak Ditemukan');
        }
    }
}
