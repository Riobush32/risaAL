<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiayaPemesanan;

class BiayaPemesananController extends Controller
{
    public function index(){
        return view('pages.biaya-pemesanan.index', [
            'title' => 'Biaya Pemesanan Bahan Baku',
            'data' => BiayaPemesanan::all()
        ]);
    }

    public function store(Request $request){
        BiayaPemesanan::create([
            'jenis_biaya' => $request->jenis,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->back()->with(['success' => 'Data Biaya Pemesanan Telah Ditambahkan']);
    }

    public function update(Request $request, $id){
 
        $data = BiayaPemesanan::find($id);

        $data->update([
            'jenis_biaya' => $request->jenis,
            'jumlah' => $request->jumlah,
        ]);

        return redirect()->back()->with(['update' => 'Data Biaya Pemesanan Telah Berhasil Diupdate']);
    }

    public function destroy($id) 
    {
        $pupuk = BiayaPemesanan::find($id);
        $pupuk->delete();
        return back()->with(['delete' => 'Data Biaya Pemesanan Telah Berhasil Hapus']);
    }
}
