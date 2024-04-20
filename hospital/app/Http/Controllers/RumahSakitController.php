<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RumahSakit;

class RumahSakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rumahsakits = RumahSakit::all();
        
        return view('rumahsakit', ['rumahsakit' => $rumahsakits]);
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
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|unique:rumah_sakit|max:255',
            'telepon' => 'required|string|max:20',
        ], [
            'email.unique' => 'Email sudah digunakan.',
        ]);
        
        $rumahSakit = new RumahSakit;
        $rumahSakit->nama = $request->nama;
        $rumahSakit->alamat = $request->alamat;
        $rumahSakit->email = $request->email;
        $rumahSakit->telepon = $request->telepon;
        $rumahSakit->save();
    
        // Mengambil ID dari rumah sakit yang baru saja disimpan
        $newRumahSakitId = $rumahSakit->id;
        
        // Mengambil data rumah sakit yang baru saja disimpan
        $newRumahSakit = RumahSakit::find($newRumahSakitId);
        
        $rumahSakits = RumahSakit::all();
        
        return response()->json([
            'message' => 'Data rumah sakit berhasil disimpan.',
            'rumahSakit' => $newRumahSakit // Mengirimkan data rumah sakit yang baru disimpan
        ]);
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
        // Temukan data rumah sakit berdasarkan ID
        $rumahSakit = RumahSakit::find($id);
    
        // Hapus data rumah sakit jika ditemukan
        if ($rumahSakit) {
            $rumahSakit->delete();
    
            // Ambil semua data rumah sakit setelah dihapus
            $rumahSakits = RumahSakit::all();
    
            // Mengembalikan data dalam format JSON
            return response()->json([
                'message' => 'Data rumah sakit berhasil dihapus.',
                'rumahSakits' => $rumahSakits
            ]);
        } else {
            // Jika data rumah sakit tidak ditemukan, kirimkan respons dengan pesan yang sesuai
            return response()->json([
                'message' => 'Data rumah sakit tidak ditemukan.',
                'rumahSakits' => [] // Tidak perlu mengirim data rumah sakit jika tidak ditemukan
            ]);
        }
    }
}
