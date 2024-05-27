<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index(){
        return view('pages.bahanbaku.index', [
            'title' => 'Bahan Baku',
            'data' => BahanBaku::all(),
        ]);
    }

    public function store(Request $request){
        $pembelian = $request->pembelian;
        $pemakaian = $request->pemakaian;
        $sisa = $pembelian - $pemakaian;

        BahanBaku::create([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pembelian' => $pembelian,
            'pemakaian' => $pemakaian,
            'sisa' => $sisa,
        ]);

        return redirect()->back()->with(['success' => 'Data Bahan Baku Telah Ditambahkan']);
    }

    public function update(Request $request, $id){
        $pembelian = $request->pembelian;
        $pemakaian = $request->pemakaian;
        $sisa = $pembelian - $pemakaian;

        $data = BahanBaku::find($id);

        $data->update([
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'pembelian' => $pembelian,
            'pemakaian' => $pemakaian,
            'sisa' => $sisa
        ]);

        return redirect()->back()->with(['update' => 'Data Bahan Baku Telah Berhasil Diupdate']);
    }

    public function destroy($id) 
    {
        $pupuk = BahanBaku::find($id);
        $pupuk->delete();
        return back()->with(['delete' => 'Data Bahan Baku Telah Berhasil Hapus']);
    }
}
