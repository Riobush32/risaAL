<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiayaPenyimpanan;

class BiayaPenyimpananController extends Controller
{
    public function index(){
        return view('pages.biaya-penyimpanan.index', [
            'title' => 'Biaya Penyimpanan Bahan Baku',
            'data' => BiayaPenyimpanan::all()
        ]);
    }

    public function store(Request $request){
        BiayaPenyimpanan::create([
            'jenis' => $request->jenis,
            'perbulan' => $request->perbulan,
            'pertahun' => $request->perbulan*12,
        ]);

        return redirect()->back()->with(['success' => 'Data Biaya Penyimpanan Telah Ditambahkan']);
    }

    public function update(Request $request, $id){
 
        $data = BiayaPenyimpanan::find($id);

        $data->update([
            'jenis' => $request->jenis,
            'perbulan' => $request->perbulan,
            'pertahun' => $request->perbulan*12,
        ]);

        return redirect()->back()->with(['update' => 'Data Biaya Penyimpanan Telah Berhasil Diupdate']);
    }

    public function destroy($id) 
    {
        $pupuk = BiayaPenyimpanan::find($id);
        $pupuk->delete();
        return back()->with(['delete' => 'Data Biaya Penyimpanan Telah Berhasil Hapus']);
    }
}
