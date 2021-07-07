<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class FUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data = $request->all();
        $validator = Validator::make($data, [
            'phone' => 'required|min:8|max:14',
            'name' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return back()->with('toast_error', 'Error : Mohon melengkapi data Anda');
        }else{
            $user = User::findOrFail($id);
            // cek gambar yang diupload
            if ($request->hasFile('img_hadir')){
                // Upload Images
                $name = Str::slug(auth()->user()->name);
                $originalImage = $request->file('photos');
                $thumbnailImage = Image::make($originalImage);
                $thumbnailPath = public_path() . '/storage/uploads/';
                $thumbnailImage->fit(320);
                $thumbnailImage->save($thumbnailPath . time() . '-' . $name . '.jpg');
                $user->photos = time() . '-' . $name . '.jpg';
            }else{
                $user->photos = null;
            }

            if ($data['id_unit'] == 0) {
                $user->id_unit = null;
            } else {
                $user->id_unit = $data['id_unit'];
            }


            $user->name = $data['name'];
            $user->phone = $data['phone'];
            $user->id_cabang = $data['id_cabang'];
            $user->pool = $data['pool'];

            $user->save();
            return redirect()->route('profil')->withSuccess('Profil Telah Diperbarui');
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
