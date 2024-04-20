<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\RumahSakit;

class RumahSakitController extends Controller
{
    public function index()
    {
        $rumahsakits = RumahSakit::all();
        
        return view('rumahsakit', ['rumahsakit' => $rumahsakits]);
    }
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
    
        $newRumahSakitId = $rumahSakit->id;
        
        $newRumahSakit = RumahSakit::find($newRumahSakitId);
        
        $rumahSakits = RumahSakit::all();
        
        return response()->json([
            'message' => 'Data rumah sakit berhasil disimpan.',
            'rumahSakit' => $newRumahSakit
        ]);
    }
    public function destroy($id)
    {
        $rumahSakit = RumahSakit::find($id);
    
        if ($rumahSakit) {
            $rumahSakit->delete();
    
            $rumahSakits = RumahSakit::all();
    
            return response()->json([
                'message' => 'Data rumah sakit berhasil dihapus.',
                'rumahSakits' => $rumahSakits
            ]);
        } else {
            return response()->json([
                'message' => 'Data rumah sakit tidak ditemukan.',
                'rumahSakits' => []
            ]);
        }
    }
}
