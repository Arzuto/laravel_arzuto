<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pasien;
use App\Models\RumahSakit;


class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasiens = Pasien::with('rumahSakit')->get();
        $rumahsakit = RumahSakit::all();
    
        return view('pasien', ['pasien' => $pasiens, 'rumahsakit' => $rumahsakit]);
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
        // Validasi data
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'idrs' => 'required',
        ]);
    
        // Simpan data pasien
        $pasien = new Pasien();
        $pasien->nama = $request->nama;
        $pasien->alamat = $request->alamat;
        $pasien->no_telepon = $request->telepon;
        $pasien->rumah_sakit_id = $request->idrs;
        $pasien->save();
    
        // Mengembalikan data pasien yang baru disimpan
        return response()->json(['pasien' => $pasien]);
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
        $pasien = Pasien::find($id);
    
        if ($pasien) {
            $pasien->delete();
    
            return response()->json([
                'message' => 'Data Pasien berhasil dihapus.'
            ]);
        } else {
            return response()->json([
                'message' => 'Data Pasien tidak ditemukan.'
            ]);
        }
    }
    
}
