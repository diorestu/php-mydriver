<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Absensi;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class BackAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $cabang = Auth::user()->id_cabang;
        $staff = User::where('id_cabang', $cabang)->get();

        $dataon = Absensi::with('user')
            ->whereDay('hadir', date('d'))
            ->whereHas('user', function ($q) {
                $q->where('id_cabang', auth()->user()->id_cabang);
            })
            ->get();

        $useroff = Absensi::whereDay('hadir', date('d'))
            ->groupBy('id_user')
            ->pluck('id_user')
            ->toArray();

        $dataoff = User::where('id_cabang', $cabang)
            ->where('roles', 4)
            ->whereNotIn('id', $useroff)
            ->get();

        // dd($data);
        return view('backend.absensi.index', [
            'data' => $dataon,
            'cabang' => $cabang,
            'staff' => $staff,
            'dataoff' => $dataoff,
        ]);
    }

    public function indexcari(Request $request)
    {
        $dt = $request->all();
        $tanggal = Carbon::parse($dt['tanggal'])->format('Y-m-d');
        $cabang = Auth::user()->id_cabang;
        $staff = User::where('id_cabang', $cabang)->get();
        $data = Absensi::with(['user'])->whereDate('created_at',$tanggal)->orderBy('id_user', 'ASC')->get();

        return view('backend.absensi.indexcari', [
            'tanggal'   => $tanggal,
            'data'      => $data,
            'cabang'    => $cabang,
            'staff'     => $staff,
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
        $staff = User::with(['cabang', 'unitkerja'])->where('id_cabang', $cabang)->where('roles', 4)->get();
        // dd($data);
        return view('backend.absensi.create', [
            'cabang' => $cabang,
            'staff' => $staff,
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
        $item = Absensi::findOrFail($id);
        return view('backend.absensi.detail',[
            'item' => $item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $staff = Absensi::with('user')->find($id);

        // dd($staff);
        return view('backend.absensi.edit', [
            'staff' => $staff,
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
        $item = Absensi::findOrFail($id);
        $item->update($data);
        Alert::success('Edit Data Berhasil')->autoClose(1500);
        return redirect()->route('absensi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Absensi::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('absensi.index')->withToastSuccess('Data Telah Dihapus');
        } else {
            return redirect()->route('absensi.index')->withToastError('Data Tidak Ditemukan');
        }
    }
}
